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

	function product($id)
	{
		$result = $this->database->GetProductById($id);
		if($result)
		{
			$path = "/" . $result['product_image_path'];			
			$data['product_img'] = $path;
			$data['product'] = $result;

			$this->display('product', $data);
		}
		else
			echo "No product available";
	}

	function latest($type)
	{		
		$data['products'] = $this->database->GetProduct($type, 'latest');

		$this->display('browse', $data);
	}

	function popular($type)
	{		
		$data['products'] = $this->database->GetProduct($type, 'popular');

		$this->display('browse', $data);
	}


	function search()
	{
		$name = $this->input->post('searchQuery');	

		if(strlen($name))
		{
			$result = $this->database->GetProductByName($name);

			$data['searchResult'] = count($result);
			$data['searchText'] = $name;

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
			case 'browse':
				$this->load->view('view_products_link', $data);	
			break;
			case 'product': 				
				$this->load->view('view_product', $data);
			break;			
			default:
				show_404();
			break;		
		}		

		//Show footer
		//$this->load->view->('footer', $data);
	}
}
?>  