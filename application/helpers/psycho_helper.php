<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('generate_header'))
{
	function generate_header(&$data)
	{
		$ci = &get_instance();
		$ci->load->model('database');
		$ci->load->library('tank_auth');
		$ci->load->library('cart');
		$ci->load->helper('url');

		//Login Info
		$data['user_id'] = 0;
		$data['user_name'] = null;

		if($ci->tank_auth->is_logged_in())
		{
			$data['user_id'] 	= $ci->tank_auth->get_user_id();
			$data['user_name'] 	= $ci->tank_auth->get_username();
		}

		//Cart Info
		$data['num_items'] = $ci->cart->total_items();
		$data['total_price'] = $ci->cart->total();

		//Game search Links
		$data['supported_games'] = $ci->database->GetAllSuportedGames();

		//Meta tags
		$data['url'] = current_url();
		$data['favico'] = $ci->config->item('favico');
		if(isset($data['product']))
		{			
			//Title
			$data['title'] = $data['product']['product_name'].' '.$data['product']['product_game'].' '.$data['product']['product_type'].' | Psycho Store';
			//Description			
			$data['description'] = 'Psycho Store | '.$data['product']['product_intro'];
			//Keywords
			$data['keywords'] = $ci->config->item('keywords').str_replace(' ', ', ', $data['product']['product_url']);

			$data['image'] = site_url($data['product']['product_image_path']);
		}
		else
		{
			$data['title'] = $ci->config->item('title');
			$data['description'] = $ci->config->item('description');
			$data['keywords'] = $ci->config->item('keywords');
			$data['image'] = base_url($ci->config->item('favico'));
		}
	}

}

if(!function_exists('generate_product_table_for_email'))
{
	function generate_product_table_for_order($order_id)
	{
		$ci =& get_instance();

		$ci->load->library('table');
		$ci->load->model('database');
		$ci->table->set_heading('Name','Size','Qty','Price', 'Total');
		$final_total = 0;
		$order = $ci->database->GetOrderById($order_id);

		foreach ($order['order_items'] as $item)
		{
			$product = $item['product'];
			$name = $product['product_name'];
			$size = $item['size'];
			$qty = $item['count'];
			$price = $product['product_price'];
			$total = $price * $qty;
			$ci->table->add_row($name,$size,$qty,$price,$total );
			$final_total += $total;
		}
		
		$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="5" cellspacing="0" >' );
		$ci->table->set_template($tmpl);

		$cell = array('data'=>'Sub Total :', 'colspan'=>4, 'align'=>'right');
		$ci->table->add_row($cell, $final_total );

		$cell = array('data'=>'Discount :', 'colspan'=>4, 'class'=>'highlight', 'align'=>'right');
		$ci->table->add_row($cell, $final_total - $order['order_amount'] );

		$cell = array('data'=>'Shipping :', 'colspan'=>4, 'class'=>'highlight', 'align'=>'right');
		$ci->table->add_row($cell, 'Always Free' );

		$cell = array('data'=>'Final Price :', 'colspan'=>4, 'class'=>'highlight', 'align'=>'right');
		$ci->table->add_row($cell, $order['order_amount'] );

		return $ci->table->generate();
	}
}

if(!function_exists('format_address'))
{
	function format_address($address)
	{
		$complete_add = $address['first_name'].' '.$address['last_name'].'<br>'.$address['address_1'] .',<br>';
				if(isset($address['address_2']) &&  $address['address_2'] != NULL)
				{
					$complete_add = $complete_add.$address['address_2'].', ';
				}				 	
				 $complete_add = $complete_add.$address['city'].'<br>'.$address['state'].' '.$address['pincode'].', '.$address['country'].'<br>'. $address['phone_number'];

		return $complete_add;
	}
}

if(!function_exists('product_url'))
{
	function product_url($product)
	{		
		$id = $product['product_id'];
		$url = url_title($product['product_url']);
		$final_url = "product/"."$id/$url";
		return $final_url;
	}
}

if(!function_exists('always_refresh'))
{
	function always_refresh()
	{
		header("Cache-Control: no-store, no-cache, must-revalidate"); 
 		header("Cache-Control: post-check=0, pre-check=0", false);
 	}
}

if(!function_exists('try_domain_discount'))
{
	function try_domain_discount()
	{
		$ci = &get_instance();
		$ci->load->model('database');
		$ci->load->library('tank_auth');
		$ci->load->library('cart');

		$user = $ci->database->GetUserById($ci->tank_auth->get_user_id());		
		if(count($user))
		{
			$user_email = $user['email'];
			$email_info = explode('@', $user_email);
			$domain = $email_info[1];
			$discount_domain = $ci->database->GetDiscountDomain($domain);
			
			if(count($discount_domain))
			{
				$ci->cart->apply_discount($discount_domain['how_much']);
			}
		}
 	}
}

if(!function_exists('get_current_user_discount_domain_info'))
{
	function get_current_user_discount_domain_info()
	{		
		$ci = &get_instance();
		$ci->load->model('database');
		$ci->load->library('tank_auth');		

		$user = $ci->database->GetUserById($ci->tank_auth->get_user_id());		
		if(count($user))
		{
			$user_email = $user['email'];
			$email_info = explode('@', $user_email);
			$domain = $email_info[1];
			$discount_domain = $ci->database->GetDiscountDomain($domain);
		}

		return $discount_domain;
	}
}

if(!function_exists('trigger_event'))
{
	function notify_event($event_name)
	{
		echo "Trigerring event";
		$ci = &get_instance();
		$ci->load->library('session');
		$events = $ci->session->userdata('events');
		$events[] = $event_name;
		$ci->session->set_userdata('events', $events);
 	}
}

if(!function_exists('execute_events'))
{
	function execute_events(&$data)
	{
		$ci = &get_instance();
		$ci->load->library('session');
		$events = $ci->session->userdata('events');
		if($events)
		{
			foreach ($events as $key => $event)
			{
				switch ($event)
				{
					case 'login_done':
						$discount_domain = get_current_user_discount_domain_info();
						if(count($discount_domain))
						{
							$data['show_modal'] = true;
							$data['domain']	= $discount_domain['domain'];
							$data['scripts'][] = 'events/modal';
						}
						break;

					case 'apply_discount':
						$data['show_modal'] = true;
						$data['modal_title'] = 'title';
						$data['modal_body'] = 'body';						
						$data['scripts'][] = 'events/modal';
						break;
					default:
						# code...
						break;
				}
			}			
			$ci->session->set_userdata('events', null);
		}
 	}
}

if(!function_exists('display'))
{
	function display($page, $data)
	{
		$ci = &get_instance();
		$ci->load->library('session');

		generate_header($data);
		
		//Show header based on page
		$header = stristr($page, 'admin') ? $ci->load->view('admin/admin_header', $data, true) : $ci->load->view('header', $data, true);

		//Show body		
		switch ($page)
		{
			case 'search':
				$body = $ci->load->view('view_search', $data, true);
			break;
			case 'browse':
				$body = $ci->load->view('home', $data, true);	
			break;
			case 'product':	
				$body = $ci->load->view('view_product', $data, true);
			break;
			case 'feedback_wall':
				$body = $ci->load->view('feedback_wall', $data, true);
				break;
			case 'contact':
				$body = $ci->load->view('view_contact', $data, true);
				break;
			case 'cart':
				$body = $ci->load->view('view_cart',$data, true);
				break;
			case 'login':
				$body = $ci->load->view('auth/login_form', $data, true);
				break;
			case 'post_login':
				$body = $ci->load->view('auth/surprise', $data, true);
				break;
			case 'register_user_address':
				$body = $ci->load->view('auth/register', $data, true);
				break;
			case 'forgot_password':
				$body = $ci->load->view('auth/forgot_password_form', $data, true);
				break;
			case 'add_address':
				$body = $ci->load->view('auth/add_address', $data, true);
				break;
			case 'message':
				$body = $ci->load->view('auth/general_message', $data, true);
				break;
			case 'reset_password':
				$body = $ci->load->view('auth/reset_password_form', $data, true);
				break;
			case 'send_again':
				$body = $ci->load->view('auth/send_again_form', $data, true);
				break;
			case 'feedback_form':
				$body = $ci->load->view('auth/feedback_form', $data, true);
				break;
			case 'admin_orders':
				$body = $ci->load->view('admin/admin_orders', $data, true);
				break;
			case 'admin_products':
				$body = $ci->load->view('admin/admin_products', $data, true);
				break;
			case 'admin_product_add_edit':
				$body = $ci->load->view('admin/product_add_edit', $data, true);
				break;
			case 'admin_feedback':
				$body = $ci->load->view('admin/admin_feedbacks', $data, true);
				break;
			case 'admin_mail':
				$body = $ci->load->view('admin/admin_mails', $data, true);
				break;
			case 'admin_shipments':
				$body = $ci->load->view('admin/admin_shipments', $data, true);
				break;
			case 'admin_logistics':
				$body = $ci->load->view('admin/admin_logistics', $data, true);
				break;
			case 'admin_users':
				$body = $ci->load->view('admin/admin_users', $data, true);
				break;
			case 'admin_discount_domains':
				$body = $ci->load->view('admin/admin_discount_domains', $data, true);
				break;
			case 'address':
				$body = $ci->load->view('view_address', $data, true);
				break;
			case 'review':
				$body = $ci->load->view('view_review_order', $data, true);
				break;
			case 'message':
				$body = $ci->load->view('basic_view', $data, true);
				break;
			case 'insights':
				$body = $ci->load->view('view_insights', $data, true);
				break;
			case 'basic':
				$body = $ci->load->view('basic_view', $data, true);
				break;
			default:
				show_404();
			break;
		}		

		//Show footer
		$footer = $ci->load->view('footer', $data, true);
		$data['header'] = $header;
		$data['body'] = $body;
		$data['footer'] = $footer;
		$data['show_discount_popup'] = false;

		execute_events($data);
		

		$ci->load->view('main_view', $data);
	}
}	

?>