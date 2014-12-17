<?php 

class admin extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->library('table');
		$this->load->model('database');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('tank_auth');
	}

	function index()
	{		
		$this->orders();
	}

	function _validate_user()
	{
		$current_user = $this->database->GetUserById($this->tank_auth->get_user_id());		
		if( $current_user['email'] != $this->config->item('admin_email') )
		{
			redirect('');
		}
	}

	function orders($order_id = null)
	{
		$this->_validate_user();
		
		//If no order_id is given show pending/returned orders
		if($order_id)
		{			
			$order = $this->database->GetOrderById($order_id);
			var_dump($order);
		}
		else
		{		
			$pending_orders = $this->database->GetPendingReturnedOrders();
			var_dump($pending_orders);
		}		
	}

	function products()
	{

	}
}

?>