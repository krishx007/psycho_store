<?php 
/**
* 	
*/
class Pages extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('database');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('tank_auth');
		$this->load->library('cart');
		$this->load->helper('email');
	}

	function index()
	{
		//$this->load->view('header');
		$this->latest('all');
	}

	function GenerateSuggestions($product, $howmany)
	{		
		$exception[] = $product;
		$suggested_products = $this->database->GetRandomProducts($howmany,'all', 'all', $exception);
		return $suggested_products;
	}

	function GetNextPreviousIds($current_id, &$next, &$prev, $total_products)
	{		
		$result = array();
		$id = $current_id;		
		while(count($result) < 1)
		{
			$id = $id + 1; if($id > $total_products ) $id = 1;
			$result = $this->database->GetProductById($id);						
		}		
		$next = $result['product_id'];		
		
		//reset
		$result = null;
		$id = $current_id;
		while(count($result) < 1)
		{
			$id = $id - 1; if($id < 1 ) $id = $total_products;
			$result = $this->database->GetProductById($id);		
		}
		$prev = $result['product_id'];	
	}

	function product($id)
	{
		$total_products = $this->database->GetMaxProductID();

		$result = $this->database->GetProductById($id);
		if($result)
		{
			$next = $prev = 0;
			$this->GetNextPreviousIds($result['product_id'], $next, $prev, $total_products);
			$data['product'] = $result;
			$data['total_products'] = $total_products;			
			$data['next_id'] = $next;
			$data['prev_id'] = $prev;
			
			//Generate Suggestions
			$data['suggested_products'] = $this->GenerateSuggestions($result, 6);
			$this->display('product', $data);			
		}
		else
			echo "No product available";
	}

	function latest()
	{		
		$data['products'] = $this->database->GetProducts('all', 'latest', 'all');
		$data['latest_link_state'] = 'active';
		$data['popular_link_state'] = 'none';
		$this->display('browse', $data);
	}

	function popular()
	{		
		$data['products'] = $this->database->GetProducts('all', 'popular', 'all');
		$data['popular_link_state'] = 'active';
		$data['latest_link_state'] = 'none';
		$this->display('browse', $data);
	}
	
	//Removes spaces from a url
	function beautify($string, $search_char)
	{
		return str_replace($search_char,' ',$string);
	}


	function search($game = "")
	{
		$name = ($this->input->post('search_query') != false) ? trim($this->input->post('search_query')) : $this->beautify($game,'_');

		$data['search_result'] = 0;
		$data['search_text'] = $name;
		if(strlen($name))
		{			
			$result = $this->database->GetProducts('all','latest', $name);
			$count = count($result);			
			$data['search_result'] = $count;
			$data['extra_text'] = '';

			if($result)
				$data['products'] = $result;
			else
			{
				$data['extra_text'] = 'Try another game search, meanwhile check these out';
				$data['products'] = $this->database->GetRandomProducts(6,'all','all',null);
			}
		}
		else
		{
			$data['extra_text'] = 'Try actually searching for something, meanwhile check these';
			$data['products'] = $this->database->GetRandomProducts(6,'all','all',null);
		}
			

		$this->display('search', $data);
	}

	function subscribe()
	{
		$email_id = $this->input->post('subscribe_email');
		$data = array();

		if(valid_email($email_id))
		{			
			$this->database->Subscribe($email_id);
			$data['email_id'] = $email_id;
			$data['heading'] = "All right ";
			$data['small_heading'] = "We dont know who you are. We dont know what you want. If you are looking for toilet brushes, We can tell you We dont have any. But what we do have are a very particular set of gaming stuff. Stuff that we have made with a lot of hardwork. Stuff that can make people like you very happy. If you buy that stuff from us, that will be the end of it. We will not look for you, We will not pursue you. But if you dont, we will look for you, we will find you, and we will keep updating you.";
		}
		else
		{
			$data['email_id'] = $email_id;
			$data['heading'] = "Damn, you cant even type an email correctly";
			$data['small_heading'] = "Just dont disappoint this time, try again";
		}			

		$this->display('newsletter', $data);
	}

	function GenerateHeader(&$data)
	{
		//Login Info
		$data['user_id'] = 0;
		$data['user_name'] = null;

		if($this->tank_auth->is_logged_in())
		{
			$data['user_id'] 	= $this->tank_auth->get_user_id();
			$data['user_name'] 	= $this->tank_auth->get_username();
		}

		//Cart Info
		$data['num_items'] = $this->cart->total_items();
		$data['total_price'] = $this->cart->total();		
	}

	function display($page, $data)
	{
		$this->GenerateHeader($data);

		//Show header
		$this->load->view('header', $data);

		//Show body		
		switch ($page)
		{
			case 'search':
			$this->load->view('view_search', $data);
			break;
			case 'browse':
				$this->load->view('home', $data);	
			break;
			case 'product': 				
				$this->load->view('view_product', $data);
			break;		
			case 'newsletter':
				$this->load->view('newsletter', $data);
			break;
			default:
				show_404();
			break;		
		}		

		//Show footer
		$this->load->view('footer', $data);
	}
}
?>  