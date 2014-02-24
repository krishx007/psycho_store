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
		$this->latest();
	}

	function View($page = "welcome")
	{
		echo $filename = "application/views/".$page.".php"; 

		if(!file_exists($filename))
			show_404();

		//passing data to views page
		$data['title'] = $page;

		$this->load->view($page, $data);
	}

	function product($id)
	{
		$result = $this->database->GetProductById($id);
		if($result)
		{
			$path = "/" . $result['tshirt_image_path'];			
			$data['tshirt_img'] = $path;
			$data['product'] = $result;

			$this->display('product', $data);
		}
		else
			echo "No product available";
	}

	function latest()
	{		
		$data['products'] = $this->database->GetProductLatest();

		$this->display('latest', $data);
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
			{
				$data['products'] = $result;
				$this->display('search', $data);
			}			
		}		
	}

	function GenerateLoginHeader(&$data)
	{
		$data['user_id'] = 0;
		$data['user_name'] = null;

		if($this->tank_auth->is_logged_in())
		{
			$data['user_id'] 	= $this->tank_auth->get_user_id();
			$data['user_name'] 	= $this->tank_auth->get_username();
		}

		echo "User ID : {$data['user_id']}<br>";
	}

	function GenerateCartHeader()
	{
		$num_items = $this->cart->total_items();
		$total_price = $this->cart->total();
		echo "<br>$num_items item(s) in ";
		echo anchor('cart/','Cart');
		echo "  / Price : $total_price";
	}

	function display($page, $data)
	{
		$this->GenerateLoginHeader($data);
		$this->GenerateCartHeader();	
		switch ($page)
		{
			case 'search' : 
				$this->load->view('header', $data);
				$this->load->view('view_products_link', $data);	
			break;
			case 'product' : 
				$this->load->view('header', $data);
				$this->load->view('view_product', $data);	
			break;
			case 'latest' : 
				$this->load->view('header', $data);
				$this->load->view('view_products_link', $data);	
			break;
		}
	}
}
?>  