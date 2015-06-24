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

	

?>