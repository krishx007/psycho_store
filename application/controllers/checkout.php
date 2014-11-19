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
			case 'success':
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
				redirect('checkout/success');
				break;

			case 'online':
				redirect('checkout/payment_gateway');
				break;
			
			default:
				redirect('checkout/review');
				break;
		}
		
		
		// if( ($this->input->post('payment_mode') != (string)FALSE) && ($this->input->post('payment_mode') === "cod" || $this->input->post('payment_mode') === "online") )
		// {

		// 	$payment_mode = $this->input->post('payment_mode');
		// }
		// else
		// {			
		// 	redirect('checkout/review');
		// }
	}

	function payment_gateway()
	{
		$gateway_params = array();

		//Gateway config
		$gateway_params['key'] = $this->config->item('merchant_key');
		$gateway_params['salt'] = $this->config->item('salt');			
		$gateway_params['surl'] = $this->config->item('success_url');
		$gateway_params['furl'] = $this->config->item('failure_url');
		$gateway_params['txnid'] = $this->generate_txnid();
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
		
		# Create a connection		
		$ch = curl_init($url);

		# Form post string
		$postString = http_build_query($gateway_params);	

		# Setting our options		
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);				

		# Get the response
		$res = curl_exec($ch);
		$info = curl_getinfo($ch);		
		curl_close($ch);		
		

		redirect($info['redirect_url']);

		
	}

	function generate_txnid()
	{
		return substr(hash('sha256', mt_rand() . microtime()), 0, 20);
	}

	function place_order()
	{
		$this->validate_cart();

		//Check for payment mode and address
		$address = $this->session->userdata('shipping_address');

		$order = array
				(
					'user_id'		=>	$this->tank_auth->get_user_id(),
					'address_id' 	=> 	$address['address_id'],
					'payment_mode'	=>	$payment_mode,
					//'order_status'=>	Default set as pending
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
							'size'			=> $item['options']['Size'],
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

		//Destroy the cart/address now
		$this->cart->destroy();
		$this->session->unset_userdata('shipping_address');
	}

	function success()
	{
		//$this->place_order();	
		//Mail to be sent
		//Verify checksum and note txnID and then place order
		$msg =sprintf("<h1>Thank you</h1> <br> Your order has been placed and is up for processing. A mail has been sent to you confirming the same along with order details.<br><br> <a class= \"btn btn-primary\" href= %s>Continue Shopping</a> ", site_url('')) ;
		$data = array('message' => $msg );
		$this->display('success', $data);
	}
}
?>