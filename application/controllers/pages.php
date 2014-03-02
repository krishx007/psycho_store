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
	}

	function index()
	{
		//$this->load->view('header');
		$this->latest('all');
	}

	function GenerateSuggestions($product)
	{		
		$exception[] = $product;
		$suggested_products = $this->database->GetRandomProducts(5,'all', 'all', $exception);		
		return $suggested_products;
	}

	function product($id)
	{
		$total_products = $this->database->GetProductCount();

		//Safety Check, revert to first product when dont know what to do
		if($id <= 0 || $id > $total_products)
			$id = 1;		

		$result = $this->database->GetProductById($id);
		if($result)
		{			
			$data['product'] = $result;
			$data['total_products'] = $total_products;
			
			//Generate Suggestions
			$data['suggested_products'] = $this->GenerateSuggestions($result);
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

	function search($game = "")
	{
		$name = ($this->input->post('search_query') != false) ? trim($this->input->post('search_query')) : trim($game);

		$data['search_result'] = 0;
		$data['search_text'] = $name;
		if(strlen($name))
		{			
			$result = $this->database->GetProducts('all','latest', $name);
			$count = count($result);			
			$data['search_result'] = $count;			

			if($result)
				$data['products'] = $result;
		}		

		$this->display('search', $data);
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
			default:
				show_404();
			break;		
		}		

		//Show footer
		$this->load->view('footer', $data);
	}
}
?>  