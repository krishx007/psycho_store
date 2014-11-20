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
		$this->load->helper('html');		
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

		//Meta tags
		$data['title'] = $this->config->item('title');
		$data['description'] = $this->config->item('description');
		$data['keywords'] = $this->config->item('keywords');
		$data['image'] = $this->config->item('favico');
		$data['url'] = current_url();
		$data['favico'] = $this->config->item('favico');
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
			case 'review':
				$this->load->view('view_review_order', $data);
			break;
			case 'message':
				$this->load->view('auth/general_message', $data);
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
		$this->validate_cart();

		if(!$this->tank_auth->is_logged_in())
		{			
			redirect('auth/login?redirect_url='.rawurlencode('checkout/address'));
		}
		else
			redirect('checkout/address');
	}

	function address()
	{
		$this->validate_cart();		

		$userid = $this->tank_auth->get_user_id();		
		
		if(strlen($userid) > 0)
		{
			$result = $this->database->GetAddressesForUser($userid);
			$data['addresses'] = $result;
			$this->display('address',$data);
		}
		else
		{
			redirect('checkout/login');
		}
		
	}

	function validate_cart()
	{
		$out_of_stock = false;		

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
			{
				$out_of_stock = true;
				break;
			}
		}

		if($this->cart->total_items() <= 0 || $out_of_stock)
			redirect('cart/');

	}

	function review()
	{
		$this->validate_cart();

		if($this->session->userdata('shipping_address') === false)
			redirect('checkout/');		

		foreach ($this->cart->contents() as $items)
		{			
			$prod_id = $items['id'];
			$product = $this->database->GetProductById($prod_id);
			$data['products'][$prod_id] = $product;
		}

		$data['address'] = $this->session->userdata('shipping_address');
		
		$this->display('review', $data);
	}

	//Store the address in session as user can refresh the page
	//Also makes sure that address passed is valid for current signed-in user
	function save_address()
	{
		$address_id = $this->input->post('address_id');		
		$address = $this->database->GetAddressById($address_id);

		//We also need to make sure address belongs to the currently signed-in user		
		$current_users_addresses = $this->database->GetAddressesForUser($this->tank_auth->get_user_id());
		$address_valid = FALSE;
		foreach ($current_users_addresses as $key => $address)
		{
			if($address['address_id'] == $address_id)
			{
				$address_valid = TRUE;
				break;
			}			
		}

		if($address_valid)
		{
			//We need to be here to show the review page, else we go again to address page
			//to get correct address
			$this->session->set_userdata('shipping_address',$address);
			redirect('checkout/review');
		}

		redirect('checkout/address');
	}

	function payment()
	{
		$this->validate_cart();

		$payment_mode = $this->input->post('payment_mode');

		//Check payment mode
		switch ($payment_mode)
		{
			case 'cod':
				$this->session->set_flashdata('ok_to_order', true);
				redirect('checkout/success');
				break;

			case 'online':
				redirect('checkout/payment_gateway');
				break;
			
			default:
				redirect('checkout/review');
				break;
		}
	}

	function payment_gateway()
	{
		$gateway_params = array();

		//Gateway config
		$gateway_params['key'] = $this->config->item('merchant_key');
		$gateway_params['salt'] = $this->config->item('salt');			
		$gateway_params['surl'] = $this->config->item('success_url');
		$gateway_params['furl'] = $this->config->item('failure_url');
		$gateway_params['txnid'] = $this->_generate_txnid();
		$gateway_params['service_provider'] = $this->config->item('service_provider');

		//Site specific info
		$address = $this->session->userdata('shipping_address');	//Should be there
		$user_id = $this->tank_auth->get_user_id();
		$user = $this->database->GetUserById($user_id);

		$gateway_params['amount'] = $this->cart->final_price();
		$gateway_params['firstname'] = $address['first_name'];
		$gateway_params['lastname'] = $address['last_name'];
		$gateway_params['address1'] = $address['address_1'];
		$gateway_params['address2'] = $address['address_2'];
		$gateway_params['city'] = $address['city'];
		$gateway_params['state'] = $address['state'];
		$gateway_params['country'] = $address['country'];
		$gateway_params['zipcode'] = $address['pincode'];
		$gateway_params['email'] = $user['email'];
		$gateway_params['phone'] = $address['phone_number'];
		$gateway_params['productinfo'] = "Psycho Store Merchandise";


		//Generate hash		
		//key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10
		$hash_string = $gateway_params['key'].'|'.$gateway_params['txnid'].'|'.$gateway_params['amount'].'|'.$gateway_params['productinfo'].'|'.$gateway_params['firstname'].'|'.$gateway_params['email'].'|'.'||||||||||'.$gateway_params['salt'];

		$gateway_params['hash'] = strtolower(hash('sha512', $hash_string));		
		
		//Do a post request
		$url = $this->config->item('gateway_url');	
		
		// Create a connection		
		$ch = curl_init($url);

		// Form post string
		$postString = http_build_query($gateway_params);

		// Setting our options		
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);				

		// Get the response
		$res = curl_exec($ch);
		$info = curl_getinfo($ch);		
		curl_close($ch);		

		redirect($info['redirect_url']);
	}

	function _generate_txnid()
	{
		return substr(hash('sha256', mt_rand() . microtime()), 0, 20);
	}

	function _place_order($order_info)
	{
		$this->validate_cart();

		//Check for payment mode and address
		$address = $this->session->userdata('shipping_address');

		$order = array
				(
					'txn_id'		=>	$order_info['txnid'],
					'user_id'		=>	$this->tank_auth->get_user_id(),
					'address_id' 	=> 	$address['address_id'],
					'payment_mode'	=>	$order_info['payment_mode'],
					'order_amount'	=>	$order_info['amount'],
					//'order_status'=>	Default set as pending
				);

		$this->database->AddOrder($order);

		foreach ($this->cart->contents() as $item)
		{
			$order_item = array
						(
							'txn_id'		=>	$order_info['txnid'],
							'product_id'	=> 	$item['id'],
							'count'			=> 	$item['qty'],
							'size'			=> 	$item['options']['Size'],
						);

			//Update product info
			$size = $item['options']['Size'];
			$size = 'product_count_'.strtolower($size);
			$product = $this->database->GetProductById($item['id']);
			$product['product_qty_sold'] += $item['qty'];
			$product[$size] -= $item['qty'];	//To be done for products with no size

			//Update database
			$this->database->ModifyProduct($product);
			$this->database->AddOrderItem($order_item);
		}

		//Destroy the cart/address now
		$this->cart->destroy();
		$this->session->unset_userdata('shipping_address');
	}

	function success()
	{
		//var_dump($this->input->post());

		$ok_to_place_order = false;		

		//Verify checksum (not sure abt this, might be unnecessary)
		if($this->input->post( 'key' ) != (string)false )
		{
			//We came here through online transaction
			$returned_hash	 	= $this->input->post( 'hash' );
			$status 			= $this->input->post('status');
			
			//<SALT>|status||||||udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key
			$hash_string = $this->input->post('salt').'|'.$status.'|'.'||||||||||'.'|'.$this->input->post('email').'|'.'ishkaran.singh@hotma'.'|'.$this->input->post('productinfo').'|'.$this->input->post('amount').'|'.$this->input->post('txnid').'|'.$this->input->post('key');

			$hash = strtolower(hash('sha512', $hash_string));
			
			if($this->input->post( 'status' ) === "success")
			{
				$ok_to_place_order = true;
			}
		}
		else
		{
			$ok_to_place_order = $this->session->flashdata('ok_to_order');
		}

		if($ok_to_place_order)
		{
			$order_info = $this->_generate_orderinfo($this->input->post());

			$this->_place_order($order_info);
			$msg =sprintf("<h1>Minions, assemble now</h1> <br> All right minions, theres work to do, theres stuff to create, people are counting on us, psycho gamers and geeks have high hopes from us and we need to deliver. So stop hunting for bananas and get to work so that this person right here watching us can get what he deserves.<br>
				For laymans (seriusly, what are you doing on our site) : Your order has been placed and is up for processing. We do our best to provide you with quality stuff as quickly as possible. A mail has been sent to you confirming the same along with order details.<br><br> <a class= \"btn btn-primary\" href= %s>Continue Shopping</a> ", site_url('cart')) ;
			$data = array('message' => $msg );
			$this->display('message', $data);
		}
		else
		{
			redirect('checkout/');
		}		
	}

	function failure()
	{
		$msg =sprintf("<h1>Uh Oh ... Damnit</h1> <br> Looks like G-Man is interfering with your transaction, but dont worry Gordon Freeman is on his way to sort things out. Meanwhile just try again.<br> For laymans (seriusly, what are you doing on our site) : There was some technial fault in processing your transaction, due to which it failed. If you have been charged, dont worry we will auto-refund your your money.<br><br> <a class= \"btn btn-primary\" href= %s>Try Again</a> ", site_url('cart')) ;
			$data = array('message' => $msg );
			$this->display('message', $data);
	}

	function _generate_orderinfo($post_back_params)
	{		
		$order_info = array();

		//Payment Mode
		if( isset($post_back_params['mode']) )
		{
			$order_info['payment_mode'] =	'online';
		}
		else
		{
			$order_info['payment_mode'] =	'cod';
		}
		
		//Transaction ID
		if( isset($post_back_params['txnid']) )
		{
			$order_info['txnid'] = $post_back_params['txnid'];
		}
		else
		{
			$order_info['txnid'] = $this->_generate_txnid();
		}

		//Order Amount
		if( isset($post_back_params['amount']) )
		{
			$order_info['amount'] = $post_back_params['amount'];
		}
		else
		{
			$order_info['amount'] = $this->cart->final_price();
		}


		return $order_info;
	}
}
?>