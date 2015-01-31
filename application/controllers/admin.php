<?php 

class admin extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->library('tank_auth');
		$this->load->library('table');
		$this->load->library('form_validation');
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
				$this->load->view('admin/admin_products', $data);
			break;
			case 'product_add_edit':
				$this->load->view('admin/product_add_edit', $data);
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
			$data['num_items']	= count($orders);
			$data['orders_table'] = $this->_generate_orders_table($orders);

			$this->display('orders', $data);
		}
		else
			$this->display('404', null);
	}

	function products($product_id = null)
	{
		$this->_validate_user();
		$products = null;		

		if($product_id)
		{
			$products[] = $this->database->GetProductById($product_id);
		}
		else
		{
			$product_type = $this->input->post('product_type') != false ? $this->input->post('product_type') : 'all' ;
			$game = $this->input->post('game') != false ? $this->input->post('game') : 'all' ;
			$sort = $this->input->post('sort') != false ? $this->input->post('latest') : 'latest';
			
			$products = $this->database->GetProducts($product_type, $sort, $game);
		}		

		if($products[0] != null)
		{
			$data['products'] = $products;
			$data['num_items'] = count($products);			
			$data['products_table'] = $this->_generate_products_table($products);
			$this->display('products', $data);
		}
		else
		{
			$this->display('404', null);
		}
	}

	function add_product()
	{
		$this->form_validation->set_rules('type', 'Product type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('game_name', 'Game Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'URL Keywords', 'trim|required|xss_clean');
		$this->form_validation->set_rules('desc', 'Product Desc', 'trim|required|xss_clean');
		$this->form_validation->set_rules('image_path', 'Image Path', 'trim|required|xss_clean');
		$this->form_validation->set_rules('price', 'Product Price', 'is_numeric|trim|required|xss_clean');
		$this->form_validation->set_rules('s_qty', 'Small Qty', 'is_numeric|trim|required|xss_clean');
		$this->form_validation->set_rules('m_qty', 'Medium Qty', 'is_numeric|trim|required|xss_clean');
		$this->form_validation->set_rules('l_qty', 'Large Qty', 'is_numeric|trim|required|xss_clean');
		$this->form_validation->set_rules('xl_qty', 'XL Qty', 'is_numeric|trim|required|xss_clean');

		if($this->form_validation->run())
		{
			//All data ok, add this product to database
			$product['product_type'] = $this->input->post('type');
			$product['product_game'] = $this->input->post('game_name');
			$product['product_name'] = $this->input->post('product_name');
			$product['product_url'] = strtolower($this->input->post('url'));
			$product['product_desc'] = $this->input->post('desc');
			$product['product_image_path'] = $this->input->post('image_path');
			$product['product_price'] = $this->input->post('price');
			$product['product_count_small'] = $this->input->post('s_qty');
			$product['product_count_medium'] = $this->input->post('m_qty');
			$product['product_count_large'] = $this->input->post('l_qty');
			$product['product_count_xl'] = $this->input->post('xl_qty');

			$this->database->AddProduct($product);
			redirect('admin/products');
		}
		else
		{
			$this->display('product_add_edit', null);
		}
	}

	function edit_product($product_id)
	{

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
			$txn_id = $order['txn_id'];
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

	function _generate_products_table($products)
	{
		$this->load->library('table');
		$this->table->set_heading('id', 'type', 'game', 'name', 'url', 'description', 'image', 'price', 'small', 'med', 'lrg', 'xl', 'sold');

		$tmpl = array ( 'table_open'  => '<table class="table " >' );
		$this->table->set_template($tmpl);

		foreach ($products as $key => $prod)
		{
			$this->table->add_row($prod['product_id'], $prod['product_type'], $prod['product_game'], $prod['product_name'], $prod['product_url'], $prod['product_desc'], $prod['product_image_path'], $prod['product_price'], $prod['product_count_small'], $prod['product_count_medium'], $prod['product_count_large'], $prod['product_count_xl'], $prod['product_qty_sold']);
		}

		return $this->table->generate();
	}

	function search()
	{
		$search_option = $this->input->post('search_option');
		$search_query = trim($this->input->post('search_query'));

		switch ($search_option)
		{
			case 'orders':
				redirect("admin/orders/$search_query");
				break;

			case 'products':
				redirect("admin/products/$search_query");
				break;
			
			default:
				# code...
				break;
		}
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