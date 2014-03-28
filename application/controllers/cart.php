<?php 
/**
* 
*/
class cart extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('database');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('tank_auth');
	}

	function index()
	{		
		$this->view();
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

		//Game search Links
		$data['supported_games'] = $this->database->GetAllSuportedGames();		
	}

	//Show items in cart
	function view()
	{
		$data[] = 0;
		$num_items = $this->cart->total_items();
		$this->GenerateHeader($data);
		
		//make sure user cant enter more than available tshirts qty
		foreach ($this->cart->contents() as $items)
		{
			$prod_id = $items['id'];
			$product = $this->database->GetProductById($prod_id);			
			$key = 'product_count_'.$items['options']['size'];
			$data['max'.$items['rowid']] = $product[$key];
		}

		$this->load->view('header',$data);
		$this->load->view('view_cart',$data);
		$this->load->view('footer');
	}

	function createKey($id, $size)
	{
		$key = 0;
		switch($size)
		{
			case "small" 	: $key = (string)$id . "s";	break;
			case "medium" 	: $key = (string)$id . "m";	break;
			case "large" 	: $key = (string)$id . "l";	break;
			case "x-large" 	: $key = (string)$id . "x";	break;
		}
		
		return $key;
	}

	function add($productID)
	{		
		//Get the product using id
		$product = $this->database->getProductbyId($productID);
		if($product)
		{			
			$size = $this->input->post('size');			
			$cart_item = array
					(
						'id' 	=> $productID,
						'qty'	=> '1',
						'price' => $product['product_price'],
						'name'  => $product['product_name'],
						'options'=> array('size' => $size),
					);

			$row_id = $this->cart->insert($cart_item);
			
			if($row_id)
			{			
				$key = $this->createKey($productID, $size);
				$this->session->set_userdata($key, $row_id);
			}	
		}
		
		redirect('cart');
	}

	function remove($row_id)
	{		
		$data = array('rowid' => $row_id, 'qty' => 0);
		$this->cart->update($data);

		redirect('cart');
	}

	function update()
	{
		$i = 1;
		foreach ($this->cart->contents() as $items)
		{
			if( $this->input->post($i.$items['rowid']) )
			{
				$id = $items['rowid'];
				$quant = (int)$this->input->post($i.$items['rowid']);				
				//Update Cart				
				$data = array('rowid' => $id, 'qty' => $quant);
				$this->cart->update($data);
			}

			$i++;		
		}

		redirect('cart');	
	}

	function checkout()
	{}
}
?>