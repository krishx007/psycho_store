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
		$this->load->helper('mailgun_helper');
		$this->load->library('session');
	}

	function index()
	{		
		$this->orders();
	}

	function _validate_user()
	{
		$current_user = $this->database->GetUserById($this->tank_auth->get_user_id());
		$valid_user = false;
		$admin_emails = $this->config->item('admin_email');

		foreach ($admin_emails as $key => $email)
		{
			if($current_user)
			{
				if( $current_user['email'] == $email )
				{
					$valid_user = true;
				}
			}
		}

		if($valid_user == false)
		{
			redirect('');
		}
	}

	function display($page, $data)
	{
		generate_header($data);

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
			case 'feedback':
				$this->load->view('admin/admin_feedbacks', $data);
				break;
			case 'mail':
				$this->load->view('admin/admin_mails', $data);
				break;
			default:
				show_404();
			break;		
		}		

		//Show footer
		$this->load->view('footer', $data);
	}

	function mails()
	{
		$data['site_name'] = "Psycho Store";
		$data['username'] = 'codinpsycho';
		$data['order_id'] = '5XTGH567';
		$type = $this->input->post('mail_type');

		if($this->input->post('email') != false)
		{
			$params = mg_create_mail_params($type, $data);
			mg_send_mail($this->input->post('email'), $params);
		}
		
		$this->display('mail', null);
	}

	function test_mass_mail()
	{
		if($this->input->post('subject') != false)
		{			
			$data['site_name'] = "Psycho Store";
			$data['subscribers'] = $this->database->GetTestEmails();
			$data['num_subscribers'] = count($data['subscribers']);
			$data['subject'] = $this->input->post('subject');
		
			$this->_send_mass_mail($data);
		}
		else
		{
			echo "At least enter somethigng dumbass.";
		}
	}

	function mass_mail()
	{
		if($this->input->post('subject') != false)
		{
			$data['site_name'] = "Psycho Store";
			$data['subscribers'] = $this->database->GetSubscribers(false);
			$data['num_subscribers'] = count($data['subscribers']);			

			$data['subject'] = $this->input->post('subject');
		
			$this->_send_mass_mail($data);
		}
		else
		{
			echo "At least enter something dumbass.";
		}
	}

	function _send_mass_mail($data)
	{
		$params = $this->_create_params_for_newsletter($data['subject']);
		
		if($params)
		{
			$data['params'] = $params;
		}
		else
		{
			die("No such file exists. Please check subject");
		}

		$this->load->view('admin/mass_mail', $data);
	}

	function _create_params_for_newsletter($subject)
	{		
		$params = null;

		if(file_exists(APPPATH."views/email/$subject-html.php"))
		{
			//Mail params
			$params['subject'] = $subject;
			$params['from'] = 'Psycho Store Updates<email@news.psychostore.in>';
			$params['domain'] = 'news.psychostore.in';
			$params['campaign_id'] = 'psycho_campaign';
			$params['reply_to'] = 'contact@psychostore.in';
			$params['txt'] = $this->load->view("email/$subject-txt", $data, TRUE);
			$params['html'] = $this->load->view("email/$subject-html", $data, TRUE);	
		}

		return $params;
	}

	function webhooks()
	{
		//Manage mailgun callbacks
		$mailgun_post = $this->input->post();

		switch ($mailgun_post['event'])
		{
			case 'unsubscribed':
				$email = $mailgun_post['recipient'];
				$this->database->Unsubscribe($email);
				mg_unsubscribe($email);
				break;
			
			default:
				# code...
				break;
		}
	}

	function feedback()
	{
		//Get all feedbacks from the user, since a certain time
		$feedbacks = $this->database->GetFeedback(false);
		$data['feedbacks_table'] = $this->_generate_feedback_table($feedbacks);
		$data['num_feedbacks'] = count($feedbacks);

		$this->display('feedback', $data);

	}

	function publish_state($id, $value)
	{
		$this->database->SetPublishState($id,$value);
		redirect('admin/feedback');
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
		if(count($orders) && $orders[0] != null)
		{
			//Get user details and address in the array
			foreach ($orders as $key => $value)
			{
				$user = $this->database->GetUserById($value['user_id']);				
				$orders[$key]['email'] = $user['email'];
				$orders[$key]['address'] = $this->database->GetAddressById($value['address_id']);
			}
		}
		
		$data['orders'] = $orders;	
		$data['num_orders']	= count($orders);
		$data['orders_table'] = $this->_generate_orders_table($orders);

		$this->display('orders', $data);

	}

	function products($product_id = null)
	{
		$this->_validate_user();
		$products = null;
		$data['supported_games'] = $this->database->GetAllSuportedGames();	

		if($product_id)
		{
			$products[] = $this->database->GetProductById($product_id);
		}
		else
		{
			$product_type = $this->input->post('type') != false ? $this->input->post('type') : 'all' ;
			$game = $this->input->post('game') != false ? $this->input->post('game') : 'all' ;
			$sort = $this->input->post('sort') != false ? $this->input->post('sort') : 'latest';
			
			$products = $this->database->GetProducts($product_type, $sort, $game);
		}
		
		if( count($products) && ($products[0] != null) )
		{
			$data['products'] = $products;			
			$data['num_prods'] = count($products);
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
		$this->_set_product_form_rules();

		if($this->form_validation->run())
		{
			$product = $this->_get_product_form_post($this->input->post());

			$this->database->AddProduct($product);
			redirect('admin/products');
		}
		else
		{
			$data = $this->_fill_data_var_for_view(null);
			$data['action'] = site_url('admin/add_product');
			$this->display('product_add_edit', $data);
		}
	}

	function edit_product($product_id)
	{
		$product = $this->database->GetProductById($product_id);

		if(count($product))
		{
			$this->_set_product_form_rules();

			if($this->form_validation->run())
			{
				$product = $this->_get_product_form_post($this->input->post());
				$product['product_id'] = $product_id;

				$this->database->ModifyProduct($product);
				redirect('admin/products');
			}
			else
			{
				$data = $this->_fill_data_var_for_view($product);
				$data['action'] = site_url('admin/edit_product/'.$product_id);
				$this->display('product_add_edit', $data);
			}
		}
		else
		{
			$this->display('404', null);
		}
		
	}

	function _get_product_form_post($input)
	{
		//All data ok, add this product to database
		$product['product_id'] = $input['id'];
		$product['product_type'] =$input['type'];
		$product['product_game'] = $input['game_name'];
		$product['product_name'] = $input['product_name'];
		$product['product_url'] = strtolower($input['url']);
		$product['product_intro'] = $input['intro'];
		$product['product_desc'] = $input['desc'];
		$product['product_image_path'] = $input['image_path'];
		$product['product_price'] = $input['price'];
		$product['product_count_small'] = $input['s_qty'];
		$product['product_count_medium'] = $input['m_qty'];
		$product['product_count_large'] = $input['l_qty'];
		$product['product_count_xl'] = $input['xl_qty'];

		return $product;
	}

	function _set_product_form_rules()
	{
		$this->form_validation->set_rules('type', 'Product type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('game_name', 'Game Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'URL Keywords', 'trim|required|xss_clean');
		$this->form_validation->set_rules('intro', 'Product Intro', 'trim|required|xss_clean');
		$this->form_validation->set_rules('desc', 'Product Desc', 'trim|required|xss_clean');
		$this->form_validation->set_rules('image_path', 'Image Path', 'trim|required|xss_clean');
		$this->form_validation->set_rules('price', 'Product Price', 'is_numeric|trim|required|xss_clean');
		$this->form_validation->set_rules('s_qty', 'Small Qty', 'is_numeric|trim|required|xss_clean');
		$this->form_validation->set_rules('m_qty', 'Medium Qty', 'is_numeric|trim|required|xss_clean');
		$this->form_validation->set_rules('l_qty', 'Large Qty', 'is_numeric|trim|required|xss_clean');
		$this->form_validation->set_rules('xl_qty', 'XL Qty', 'is_numeric|trim|required|xss_clean');
	}

	function _fill_data_var_for_view($product)
	{		
		$data['type'] = is_null($product) ? '' : $product['product_type'];
		$data['game'] = is_null($product) ? '' : $product['product_game'];
		$data['name'] = is_null($product) ? '' : $product['product_name'];
		$data['product_url'] = is_null($product) ? '' : $product['product_url'];
		$data['intro'] = is_null($product) ? '' : $product['product_intro'];
		$data['desc'] = is_null($product) ? '' : $product['product_desc'];		
		$data['image_path'] = is_null($product) ? '' : $product['product_image_path'];
		$data['price'] = is_null($product) ? '' : $product['product_price'];
		$data['s_qty'] = is_null($product) ? '' : $product['product_count_small'];
		$data['m_qty'] = is_null($product) ? '' : $product['product_count_medium'];
		$data['l_qty'] = is_null($product) ? '' : $product['product_count_large'];
		$data['xl_qty'] = is_null($product) ? '' : $product['product_count_xl'];

		return $data;
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
		$this->table->set_heading('id', 'type', 'game', 'name', 'url', 'intro', 'description', 'image', 'price', 'small', 'med', 'lrg', 'xl', 'sold');

		$tmpl = array ( 'table_open'  => '<table class="table " >' );
		$this->table->set_template($tmpl);

		foreach ($products as $key => $prod)
		{
			//Edit link
			$product_id = $prod['product_id'];
			$prod_edit_link = site_url('admin/edit_product/'.$product_id);
			$prod_id_cell = "<a href=$prod_edit_link> $product_id </a>";

			//Product Image
			$img_path = site_url($prod['product_image_path']);
			$image_cell = "<a href= $img_path><img class='img-responsive' src = $img_path></img></a>";

			//Product Link			
			$prod_url = product_url($prod);
			$prod_name_cell = anchor($prod_url, $prod['product_name']);

			$this->table->add_row($prod_id_cell, $prod['product_type'], $prod['product_game'], $prod_name_cell, $prod['product_url'], $prod['product_intro'], $prod['product_desc'], $image_cell, $prod['product_price'], $prod['product_count_small'], $prod['product_count_medium'], $prod['product_count_large'], $prod['product_count_xl'], $prod['product_qty_sold']);
		}

		return $this->table->generate();
	}

	function _generate_feedback_table($feedbacks)
	{
		$this->load->library('table');
		$this->table->set_heading('id', 'name', 'email', 'message', 'Publish');

		$tmpl = array ( 'table_open'  => '<table class="table " >' );
		$this->table->set_template($tmpl);

		foreach ($feedbacks as $key => $fb)
		{
			//Edit link
			$fb_id = $fb['id'];			
			$pub_val = !$fb['publish'];

			if($fb['publish'])
			{
				$publish_link = site_url('admin/publish_state/'.$fb_id.'/0');
				$fb_pub_link = "<a class ='btn btn-warning' href=$publish_link> Unpublish </a>";
			}
			else
			{
				$publish_link = site_url('admin/publish_state/'.$fb_id.'/1');
				$fb_pub_link = "<a class ='btn btn-primary' href=$publish_link> Publish </a>";
			}
			

			
			$this->table->add_row($fb_id, $fb['name'], $fb['email'], $fb['message'], $fb_pub_link);
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
}

?>
