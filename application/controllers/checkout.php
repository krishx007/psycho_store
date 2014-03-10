<?php 
/**
* 
*/
class checkout extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		$this->load->library('cart');
		$this->load->helper('url');
		$this->load->model('database');
	}

	function index()
	{
		$this->login();
	}

	function login()
	{
		if(!$this->tank_auth->is_logged_in())
			redirect('auth');
		else
			redirect('checkout/address');
	}

	function address()
	{
		$userid = $this->tank_auth->get_user_id();
		//Get relevant addresses
		$result = $this->database->GetAddressesForUser($userid);
		
		if($result)		
			$data['addresses'] = $result;
		
		$this->load->view('view_address',$data);
	}

	function payment()
	{
		if($this->input->post('address_id'))
			$address_id = $this->input->post('address_id');
		else
			redirect('checkout/address');
		
		$order = array
				(
					'user_id'	=>	$this->tank_auth->get_user_id(),
					'address_id' => $address_id,
				);

		$this->database->AddOrder($order);

		$num_orders = $this->database->GetNumOrders();

		foreach ($this->cart->contents() as $item)
		{
			$order_item = array
						(
							'order_id' 		=> $num_orders,
							'product_id'	=> $item['id'],
							'count'			=> $item['qty'],
							'size'			=> $item['options']['size']
						);

			//Update product info
			$size = $item['options']['size'];
			$size = 'product_count_'.$size;			
			$product = $this->database->GetProductById($item['id']);			
			$product['product_qty_sold'] += $item['qty'];
			$product[$size] -= $item['qty'];			

			//Update database
			$this->database->ModifyProduct($product);
			$this->database->AddOrderItem($order_item);
		}

		//Destroy the cart now
		$this->cart->destroy();
		redirect('checkout/success');
	}

	function success()
	{
		echo "Your order has been placed, Cheers !!";
	}
}
?>