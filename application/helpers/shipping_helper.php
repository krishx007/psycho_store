<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('request_delhivery_pickup'))
{
	function request_delhivery_pickup($packaged_shipemts)
	{
		$ci = &get_instance();
		$ci->config->load('shipping_settings');
		$api_url = $ci->config->item('delhivery_url');
		$token = $ci->config->item('delhivery_token');
		$warehouse = $ci->config->item('delhivery_warehouse');

		$url = $api_url."/cmu/push/json/?token=".$token;
		
		$params = array(); // this will contain request meta and the package feed
		$package_data = array(); // package data feed
		$shipments = array();
		$pickup_location = array();
		
		/////////////start: building the package feed/////////////////////
		foreach ($packaged_shipemts as $key => $value)
		{
			$ship['waybill'] = $value['waybill']; // waybill number
			$ship['order'] = $value['txn_id']; // client order number
			//ToDo Actual weight to be set up
			$ship['weight'] = 0;
			foreach ($value['order_items'] as $key => $item)
			{
				$ship['weight'] += '0.2' * $item['count'];	//In kgs * count
				$prod = $item['product'];
				$ship['products_desc'][] = $prod['product_name']." {".$item['count'].", ".$item['size']."}";
			}

			$ship['order_date'] = $value['date_created']; // ISO Format
			$ship['payment_mode'] = $value['payment_mode'];
			$ship['total_amount'] = $value['order_amount']; // in INR

			if($value['payment_mode'] == 'cod')
			{
				$ship['cod_amount'] = $value['order_amount']; // amount to be collected, required for COD
			}

			//Assign Address
			$address = $value['address'];
			$ship['name'] = $address['first_name'].' '.$address['last_name']; // consignee name
			$ship['add'] = $address['address_1'].','.$address['address_2']; // consignee address
			$ship['city'] = $address['city'];
			$ship['state'] = $address['state'];
			$ship['country'] = $address['country'];
			$ship['phone'] = $address['phone_number'];
			$ship['pin'] = $address['pincode'];
			$ship['quantity'] = 1; // quanitity of quantity

			$shipments[] = $ship;
		}

		// pickup location information //
		$pickup_location = $ci->config->item('pickup_location');

		$package_data['shipments'] = $shipments;
		$package_data['pickup_location'] = $pickup_location;
		$params['format'] = 'json';
		$params['data'] =json_encode($package_data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($params));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		
		$result = curl_exec($ch);
		
		curl_close($ch);		

		return json_decode($result, TRUE);
 	}
}

function fetch_shipping_label_info($waybills)
{
	$ci = &get_instance();
	$ci->config->load('shipping_settings');
	$api_url = $ci->config->item('delhivery_url');
	$token = $ci->config->item('delhivery_token');
	if(is_array($waybills) == false)
	{
		$waybills = array($waybills);
	}

	$waybill_string = null;

	//Create HTTP Get Request URL
	foreach ($waybills as $key => $waybill)
	{
		$waybill_string += "$waybill,";
	}
	
	$url = $api_url."/api/p/packing_slip/?wbns=$waybill_string";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Token $token"));
	
	$result = curl_exec($ch);
	
	curl_close($ch);

	$result = json_decode($result, TRUE);

	return $result;	
}

function create_shipping_label($waybills)
{
	$labels = fetch_shipping_label_info($waybills);	

	return $labels;
}

function fetch_delhivery_waybills($count)
{
	$ci = &get_instance();
	$ci->config->load('shipping_settings');
	$api_url = $ci->config->item('delhivery_url');
	$token = $ci->config->item('delhivery_token');
	$warehouse = $ci->config->item('delhivery_warehouse');

	$url = $api_url."/waybill/api/bulk/json/?token=$token&count=$count";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);
	curl_close($ch);
	$result = json_decode($result, TRUE);	

	return $result;
}

//Active pincodes since $date
function fetch_delhivery_pincodes($date)
{
	$ci = &get_instance();
	$ci->config->load('shipping_settings');
	$ci->load->model('database');
	$api_url = $ci->config->item('delhivery_url');
	$token = $ci->config->item('delhivery_token');

	$url = $api_url."/c/api/pin-codes/json/?token=$token&dt=$date";	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($ch);
	$info = curl_getinfo($ch);
	$error = curl_error($ch);
	curl_close($ch);
	$result = json_decode($result, TRUE);	
	
	return $result;
}


?>