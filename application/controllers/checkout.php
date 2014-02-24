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
		{
			$data['addresses'] = $result;
			$this->load->view('view_address',$data);
		}			
		else
			'No address';
	}

	function payment()
	{
		$address_id = $this->input->post('address_id');
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