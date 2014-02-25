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
		$this->load->helper('form');
		$this->load->library('session');
	}

	function index()
	{		
		$this->view();
	}

	//Show items in cart
	function view()
	{
		$num_items = $this->cart->total_items();
		$this->load->view('header');
		$this->load->view('view_cart');
		//$this->load->view('footer');
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
						'price' => $product['tshirt_price'],
						'name'  => $product['tshirt_name'],
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
		$id = $this->input->post('row_id');
		$quant = $this->input->post('quantity');
		$data = array('rowid' => $id, 'qty' => $quant);
		$this->cart->update($data);
		redirect('cart');	
	}

	function checkout()
	{}
}
?>