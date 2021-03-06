<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// if(!function_exists('generate_header'))
// {
// 	function generate_header(&$data)
// 	{
// 		//Login Info
// 		$data['user_id'] = 0;
// 		$data['user_name'] = null;

// 		if($this->tank_auth->is_logged_in())
// 		{
// 			$data['user_id'] 	= $this->tank_auth->get_user_id();
// 			$data['user_name'] 	= $this->tank_auth->get_username();
// 		}

// 		//Cart Info
// 		$data['num_items'] = $this->cart->total_items();
// 		$data['total_price'] = $this->cart->total();

// 		//Game search Links
// 		$data['supported_games'] = $this->database->GetAllSuportedGames();

// 		//Meta tags
// 		$data['url'] = current_url();
// 		$data['favico'] = $this->config->item('favico');
// 		if(isset($data['product']))
// 		{			
// 			//Title
// 			$data['title'] = 'Psycho Store | '.$data['product']['product_game'].' '.$data['product']['product_type'].' '.$data['product']['product_name'];
// 			//Description			
// 			$data['description'] = 'Psycho Store | '.$data['product']['product_desc'];
// 			//Keywords
// 			$data['keywords'] = "t-shirt, tshirt, t shirt, shirt, tee, t, t-shirts, tshirts, t shirts, shirts, tees, ts, clothing, clothes, threads, wear, gift, gifts, hats, hat, beanies, beanie, gear, sweatshirt, hoodie, sweatshirts, hoodies, gamer, geek, hacker, nerd, computer, gamers, geeks, hackers, nerds, coder, coders, ".str_replace(' ', ', ', $data['product']['product_url']);

// 			$data['image'] = site_url($data['product']['product_image_path']);
// 		}
// 		else
// 		{
// 			$data['title'] = $this->config->item('title');
		
// 		{}	$data['description'] = $this->config->item('description');
// 			$data['keywords'] = $this->config->item('keywords');
// 			$data['image'] = base_url($this->config->item('favico'));
// 		}
// 	}

// }

if(!function_exists('send_email'))
{
	function send_email($to_email, $from_email, $type, $data)
	{
		$ci =& get_instance();

		$subject_var = 'Psycho Store';

		switch ($type) 
		{
			case 'order':
				$subject_var = $data['order_id'];
				break;
			
			default:
				# code...
				break;
		}
		
		$ci->load->library('email');
		$ci->lang->load('tank_auth');
		$ci->email->from($from_email, $ci->config->item('website_name', 'tank_auth'));
		$ci->email->reply_to($from_email, $ci->config->item('website_name', 'tank_auth'));
		$ci->email->to($to_email);
		$ci->email->subject(sprintf($ci->lang->line('auth_subject_'.$type), $subject_var));
		$ci->email->message($ci->load->view('email/'.$type.'-html', $data, TRUE));
		$ci->email->set_alt_message($ci->load->view('email/'.$type.'-txt', $data, TRUE));
		if(!$ci->email->send())
			show_error($ci->email->print_debugger());
	}	
}

if(!function_exists('generate_product_table_for_email'))
{
	function generate_product_table_for_email($order_info)
	{
		$ci =& get_instance();

		$ci->load->library('table');
		$ci->load->model('database');
		$ci->table->set_heading('Name','Size','Qty','Price', 'Total');
		$final_total = 0;

		foreach ($order_info['checkout_items'] as $item)
		{
			$product = $ci->database->GetProductById($item['product_id']);
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
		$ci->table->add_row($cell, $final_total - $order_info['amount'] );

		$cell = array('data'=>'Shipping :', 'colspan'=>4, 'class'=>'highlight', 'align'=>'right');
		$ci->table->add_row($cell, 'Always Free' );

		$cell = array('data'=>'Final Price :', 'colspan'=>4, 'class'=>'highlight', 'align'=>'right');
		$ci->table->add_row($cell, $order_info['amount'] );			

		return $ci->table->generate();
	}
}

if(!function_exists('format_address'))
{
	function format_address($address)
	{
		$complete_add = $address['first_name'].' '.$address['last_name'].'<br>'.$address['address_1'] .',<br>';
				if($address['address_2'] != NULL)
				 	$complete_add = $complete_add.$address['address_2'].', ';
				 $complete_add = $complete_add.$address['city'].'<br>'.$address['state'].' '.$address['pincode'].', '.$address['country'].'<br>'. $address['phone_number'];

		return $complete_add;
	}
}

	

?>