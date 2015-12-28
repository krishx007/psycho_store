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
		$this->load->helper('form');
		$this->load->helper('psycho_helper');
		$this->load->helper('mailgun_helper');
		$this->load->library('tank_auth');
		$this->load->library('cart');
		$this->load->helper('email');
	}

	function index()
	{
		$this->latest('all');
	}

	function launch_signup()
	{
		$email_id = strtolower($this->input->post('subscribe_email'));
		$data = array();

		if(valid_email($email_id))
		{
			$this->database->Subscribe($email_id);
			$data['site_name'] = 'Psycho Store';
			$params = mg_create_mail_params('subscribe', $data);
			mg_send_mail($email_id, $params);
		}		

		redirect('');
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
			$id = $id + 1;
			if($id > $total_products )
				$id = 1;
			$result = $this->database->GetProductById($id);						
		}

		$next = $result['product_id'];		
		
		//reset
		$result = null;
		$id = $current_id;
		while(count($result) < 1)
		{
			$id = $id - 1;
			if($id < 1 )
				$id = $total_products;
			$result = $this->database->GetProductById($id);
		}
		$prev = $result['product_id'];	
	}

	function AddToRecentlyViewed($product)
	{
		$recently_viewed = $this->session->userdata('recently_viewed');
				
		//Make sure no duplicate entries are there
		if(is_array($recently_viewed))
		{
			foreach ($recently_viewed as $key => $value)
			{
				if($value['product_id'] == $product['product_id'])
					return;
			}
		}
		
		//Make sure at a time there are only 6 recent prods
		if(count($recently_viewed) >= 6)
		{
			$recently_viewed = array_reverse($recently_viewed);
			array_pop($recently_viewed);
			$recently_viewed = array_reverse($recently_viewed);
		}

		$recently_viewed[] = $product;		
		$this->session->set_userdata('recently_viewed', $recently_viewed);
	}

	function GetRecentlyViewed()
	{
		return $this->session->userdata('recently_viewed');
	}

	function giveaways()
	{
		display('view_giveaway', null);
	}

	function feedback()
	{
		$feedback = $this->database->GetFeedback(TRUE);
		$feedback = array_reverse($feedback);
		
		$data['feedbacks'] = $feedback;
		
		display('feedback_wall', $data);
	}

	function product($id, $url = null)
	{
		$total_products = $this->database->GetMaxProductID();
		$url = $this->beautify($url,'_');
		$result = $this->database->GetProductById($id);		
		if($result)
		{
			$next = $prev = 0;
			$this->GetNextPreviousIds($result['product_id'], $next, $prev, $total_products);
			$data['product'] = $result;
			$data['total_products'] = $total_products;
			$data['product_state'] = $result['product_state'];
			$data['next_id'] = product_url( $this->database->GetProductById($next), false );
			$data['prev_id'] = product_url( $this->database->GetProductById($prev), false );
			$data['small_stock']="";
			$data['medium_stock']="";
			$data['large_stock']="";
			$data['xl_stock']="";
			$data['size_chart'] = site_url($this->config->item('size_chart'));
			$data['images'] = get_product_image($result['product_id']);

			if($result['product_count_small'] <= 0)
				$data['small_stock'] = 'disabled';
			if($result['product_count_medium'] <= 0)
				$data['medium_stock'] = 'disabled';
			if($result['product_count_large'] <= 0)
				$data['large_stock'] = 'disabled';
			if($result['product_count_xl'] <= 0)
				$data['xl_stock'] = 'disabled';
			
			//Generate Suggestions
			$data['suggested_products'] = $this->GenerateSuggestions($result, 3);

			$data['recently_viewed'] = $this->GetRecentlyViewed();
			$this->AddToRecentlyViewed($result);

			display('product', $data);
		}
		else
		{
			$data['heading'] = 'No Products Found';
			$data['content'] = "I am sure, this has something to do with G-Man, anyways just go somewhere else, try some other product";
			display('basic', $data);
		}
	}

	function latest()
	{
		$data['products'] = $this->database->GetProducts('all', 'latest', 'all');
		$data['latest_link_state'] = 'active';
		$data['popular_link_state'] = 'none';		
		display('browse', $data);
	}

	function popular()
	{		
		$data['products'] = $this->database->GetProducts('all', 'popular', 'all');
		$data['popular_link_state'] = 'active';
		$data['latest_link_state'] = 'none';
		display('browse', $data);
	}
	
	//Removes spaces from a url
	function beautify($string, $replace_char)
	{
		return str_replace($replace_char,' ',$string);
	}


	function like($game = "")
	{
		$name = ($this->input->post('search_query') != false) ? trim($this->input->post('search_query')) : $this->beautify($game,'-');

		$data['search_result'] = 0;
		$data['search_text'] = $name;
		$data['products'] = array();
		if(strlen($name))
		{			
			$result = $this->database->GetProducts('all','latest', $name);
			$count = count($result);
			$data['search_result'] = $count;

			if($result)
				$data['products'] = $result;			
		}		

		display('search', $data);
	}

	function subscribe()
	{
		$email_id = strtolower($this->input->post('subscribe_email'));
		$data = array();

		if(valid_email($email_id))
		{			
			if($this->database->Subscribe($email_id))
			{
				$data['site_name'] = 'Psycho Store';
				mg_add_subscriber($email_id);
				$params = mg_create_mail_params('subscribe', $data);
				mg_send_mail($email_id, $params);

				$data['heading'] = "<small>Greetings</small> ".$email_id;
				$data['content'] = "We dont know who you are. We dont know what you want. If you are looking for toilet brushes, We can tell you we dont have any. But what we do have are a very particular set of gaming stuff. Stuff that we have made with a lot of hardwork. Stuff that can make people like you very happy. If you buy that stuff from us, that will be the end of it. We will not look for you, We will not pursue you. But if you dont, we will look for you, we will find you, and we will keep updating you.";
			}
			else
			{
				$data['heading'] = $email_id;
				$data['content'] = "We understand you love us, and you love playing around our website and subscribing to Psycho Store newsletter. But you are already in our list you know. Dont fret we wont forget you, you know. Adding your name once is enough you know. Just so you know.";
			}
		}
		else
		{
			$data['email_id'] = $email_id;
			$data['heading'] = "Damn, you cant even type an email correctly";
			$data['content'] = "Just dont disappoint this time, try again";
		}

		display('basic', $data);
	}

	function unsubscribe()
	{
		$email_id = strtolower($this->input->post('subscribe_email'));
		$data = array();

		if(valid_email($email_id))
		{
			$this->database->Unsubscribe($email_id);
			mg_unsubscribe($email_id);
			$data['email_id'] = $email_id;
			$data['heading'] = "You have been Unsubscribed";
			$data['content'] = "So this is the end of us. Take care and stay Psycho anyways.";
		}

		display('basic', $data);
	}

	function shipping_returns()
	{
		$data['heading'] = "Shipping and Returns";
		$data['ret_address'] = format_address($this->config->item('return_address'));
		$data['content'] = $this->load->view('view_shipping', $data, true);
		display('basic', $data);
	}

	function contact()
	{
		$data['return_address'] = format_address($this->config->item('return_address'));
		display('contact', $data);
	}

	function media()
	{
		$data['heading'] = "Who's talking about us";
		$data['content'] = $this->load->view('view_media', null, true);
		display('basic', $data);
	}

	function about()
	{
		$data['heading'] = "Who are We";
		$data['content'] = $this->load->view('view_about', null, true);
		display('basic', $data);
	}
}
?>