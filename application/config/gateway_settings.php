<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//PayUMoney Settings
$config['merchant_key'] = 'JBZaLc';
$config['salt'] = 'GQs7yium';
$config['service_provider'] = 'payu_paisa';
$config['gateway_url'] = 'https://test.payu.in/_payment/';
$config['success_url'] = 'http://psychostore.in/checkout/success';
$config['failure_url'] = 'http://psychostore.in/checkout/failure';
$config['cancel_url'] = '';

?>