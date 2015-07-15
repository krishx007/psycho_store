<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Delhivery
$config['delhivery_url'] = 'http://test.delhivery.com';
$config['delhivery_token'] = 'd553fe2a0286484c51f01e809d5e5ae27c285960';
$config['delhivery_warehouse'] = 'PSYCHONETSOLUTIONS - DFS';
$config['delhivery_logo'] ='images/shipping/delhivery.png';
$config['company_logo'] ='images/shipping/shipping_logo.png';

//Pickup Location
$config['pickup_location'] = array(
									'add' 	=> '#35, Mane Building, 7th Main Road, Shinivagalu Tank Bed Layout, near back door Balaji Apartments',
									'city' 	=> 'Bangaluru',
									'country' => 'India',
									'name' 	=> $config['delhivery_warehouse'],  // Use client warehouse name
									'phone' 	=> '7387045828',
									'pin' 	=> '560034',
									'state' 	=> 'Karnataka'
									);

$config['return_address'] = array(
									'first_name' => 'Ishkaran',
									'last_name' => 'Singh',
									'address_1' 	=> '#35, Mane Building, 7th Main Road',
									'address_2' => 'ST Bed Layout,',
									'city' 	=> 'Bengaluru',
									'country' => 'India',									
									'phone_number' 	=> '7387045828',
									'pincode' 	=> '560034',
									'state' 	=> 'Karnataka'
									);

?>