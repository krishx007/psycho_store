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
		$this->load->helper('psycho_helper');
		$this->load->library('session');
		$this->load->library('tank_auth');
	}

	function index()
	{		
		$this->view();
	}

	//make sure user cant enter more than available stock qty
	function _set_stock_info(&$data)
	{
		foreach ($this->cart->contents() as $items)
		{
			$prod_id = $items['id'];
			$product = $this->database->GetProductById($prod_id);

			//Check stock and set stock info
			$data['products'][$items['rowid'].'stock_state'] = "";

			if( $product['product_type'] == "Tshirt" || $product['product_type'] == "Hoodie")
			{
				$size = $items['options']['Size'];
				$size_in_stock = $product['product_count_'.strtolower($size)];
			}
			else
			{
				//For product woth no size info like action figures .. later on
			}

			
			if($items['qty'] > $size_in_stock)
				$data['products'][$items['rowid'].'stock_state'] = "Out Of Stock";				

			$data['products'][$prod_id] = $product;
		}
	}

	//Show items in cart
	function view()
	{
		$data[] = 0;
		$num_items = $this->cart->total_items();
		generate_header($data);		
		$this->_set_stock_info($data);
		try_domain_discount();
		
		display('cart',$data);		
	}	

	function add($productID)
	{		
		//Get the product using id
		$product = $this->database->getProductbyId($productID);
		if($product)
		{			
			$size = $this->input->post('size');
			if($size)
			{
				$cart_item = array
					(
						'id' 	=> $productID,
						'qty'	=> '1',
						'price' => $product['product_price'],
						'name'  => $product['product_name'],
						'options'=> array('Size' => $size),
					);
				
				$row_id = $this->cart->insert($cart_item);
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
		foreach ($this->cart->contents() as $items)
		{
			if( $this->input->post($items['rowid']) != (string)FALSE)
			{				
				$id = $items['rowid'];
				$quant = (int)$this->input->post($items['rowid']);

				//Update Cart
				$data = array('rowid' => $id, 'qty' => $quant);
				$this->cart->update($data);
			}
		}

		redirect('cart');
	}

	function _getDiscount($coupon)
	{		
		$discount = $this->database->GetDiscountCoupon($coupon);
		
		if(count($discount) > 0)
		{
			//Make sure it hasnt expired yet
			if( strtotime($discount['expiry']) > strtotime(date("Y-m-d")) )
			{
				return $discount['how_much'];
			}
		}
		return 0;	
	}

	function applyDiscount()
	{
		if($this->input->post('coupon') != (string)FALSE)
		{
			$coupon = trim($this->input->post('coupon'));
			$this->cart->apply_discount($this->_getDiscount($coupon));
		}

		redirect('cart');
	}
}
?>