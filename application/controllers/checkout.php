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
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('database');
	}

	function index()
	{
		$this->login();
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

	function display($page, $data)
	{
		$this->GenerateHeader($data);

		//Show header
		$this->load->view('header', $data);

		//Show body		
		switch ($page)
		{
			case 'address':
				$this->load->view('view_address', $data);
			break;
			default:
				show_404();
			break;		
		}		

		//Show footer
		$this->load->view('footer', $data);
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
		
		$result = $this->database->GetAddressesForUser($userid);		
		$data['addresses'] = $result;
		$this->display('address',$data);
	}

	function payment()
	{
		if($this->input->post('address_id') != (string)FALSE)
			$address_id = $this->input->post('address_id');			
		else
		{			
			redirect('checkout/address');
		}
			
		
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
							'size'			=> $item['options']['Size']
						);

			//Update product info
			$size = $item['options']['Size'];
			$size = 'product_count_'.strtolower($size);			
			$product = $this->database->GetProductById($item['id']);			
			$product['product_qty_sold'] += $item['qty'];
			$product[$size] -= $item['qty'];			

			//Update database
			$this->database->ModifyProduct($product);
			$this->database->AddOrderItem($order_item);
		}

		//Destroy the cart now
		$this->cart->destroy();
		$this->session->unset_userdata('discount_coupon');
		redirect('checkout/success');
	}

	function success()
	{
		echo "Your order has been placed, Cheers !!";
	}
}
?>