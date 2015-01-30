<?php 

class admin extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->library('tank_auth');
		$this->load->library('table');
		$this->load->model('database');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->helper('psycho_helper');
		$this->load->library('session');		
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

	function display($page, $data)
	{
		$this->GenerateHeader($data);

		//Show header
		$this->load->view('admin/admin_header', $data);

		//Show body
		switch ($page)
		{
			case 'orders':
				$this->load->view('admin/admin_orders', $data);
			break;
			case 'products':
				$this->load->view('view_review_order', $data);
			break;
			case 'emails':
				$this->load->view('auth/general_message', $data);
			break;
			default:
				show_404();
			break;		
		}		

		//Show footer
		$this->load->view('footer', $data);
	}

	function orders($order_id = null)
	{
		$this->_validate_user();
		$orders = null;

		if($order_id)
		{
			$orders[] = $this->database->GetOrderById($order_id);
		}
		else
		{
			//If no order_id is given show pending/returned orders
			$orders = $this->database->GetPendingReturnedOrders();
		}
		
		//As $orders is an array
		if($orders[0] != null)
		{
			//Get user details and address in the array
			foreach ($orders as $key => $value)
			{
				$user = $this->database->GetUserById($value['user_id']);
				$orders[$key]['email'] = $user['email'];
				$orders[$key]['address'] = $this->database->GetAddressById($value['address_id']);
			}
			
			$data['orders'] = $orders;	
			$data['num_orders']	= count($orders);
			$data['order_table'] = $this->_generate_orders_table($orders);

			$this->display('orders', $data);
		}
		else
			$this->display('404', null);
	}


	//code to be shifted to view for more flexibility
	function _generate_orders_table($orders)
	{		
		$this->load->library('table');		
		$this->table->set_heading('#','Txn_id','Date','Email','Address', 'Mode', 'Amount', 'Status');

		$tmpl = array ( 'table_open'  => '<table class="table table-condensed" >' );
		$this->table->set_template($tmpl);

		$num = 1;
		foreach ($orders as $order)
		{
			$txn_id = "<a href= site_url('')>".$order['txn_id']."</a>";
			$email = $order['email'];
			$address = format_address($order['address']);
			$date = $order['date_created'];
			$mode = $order['payment_mode'];
			$amount = $order['order_amount'];
			$status = $order['order_status'];
			$this->table->add_row($num, $txn_id,  $date, $email, $address, $mode, $amount, $status);

			foreach ($order['order_items'] as $key => $item) 
			{
				$product = $item['product'];
				$product_name = array('data'=> $product['product_name'], 'colspan'=>4, 'align'=>'right');
				$size = array('data' => $item['size'], 'colspan'=>2, 'align'=>'right');
				$count = array('data' => $item['count'], 'colspan'=>2, 'align'=>'right');
				$this->table->add_row( $product_name, $size, $count);
			}			
			++$num;
		}
		
		return $this->table->generate();
	}

	function search()
	{
		switch ($search_option)
		{
			case 'orders':
				redirect("admin/orders/$search_query");
				break;
			
			default:
				# code...
				break;
		}
	}

	function products()
	{

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

		//Meta tags
		$data['url'] = current_url();
		$data['favico'] = $this->config->item('favico');
		if(isset($data['product']))
		{			
			//Title
			$data['title'] = 'Psycho Store | '.$data['product']['product_game'].' '.$data['product']['product_type'].' '.$data['product']['product_name'];
			//Description			
			$data['description'] = 'Psycho Store | '.$data['product']['product_desc'];
			//Keywords
			$data['keywords'] = "t-shirt, tshirt, t shirt, shirt, tee, t, t-shirts, tshirts, t shirts, shirts, tees, ts, clothing, clothes, threads, wear, gift, gifts, hats, hat, beanies, beanie, gear, sweatshirt, hoodie, sweatshirts, hoodies, gamer, geek, hacker, nerd, computer, gamers, geeks, hackers, nerds, coder, coders, ".str_replace(' ', ', ', $data['product']['product_url']);

			$data['image'] = site_url($data['product']['product_image_path']);
		}
		else
		{
			$data['title'] = $this->config->item('title');
			$data['description'] = $this->config->item('description');
			$data['keywords'] = $this->config->item('keywords');
			$data['image'] = $this->config->item('favico');
		}
	}

}

?>