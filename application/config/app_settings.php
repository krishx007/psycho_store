<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//Default meta tags info

$config['title'] = 'Psycho Store | Stuff for Gamers and Geeks';
$config['description'] = 'We make stuff for the gaming and geek community of earth(other planets can wait for now)';
$config['keywords'] = 't-shirt, tshirt, t shirt, shirt, tee, t, t-shirts, tshirts, t shirts, shirts, tees, ts, clothing, clothes, threads, wear, gift, gifts, hats, hat, beanies, beanie, gear, sweatshirt, hoodie, sweatshirts, hoodies, gamer, geek, hacker, nerd, computer, gamers, geeks, hackers, nerds, coder, coders, psychostore, psycho, store, psycho store, india, ';

$config['favico'] = 'images/favico.png';
$config['size_chart'] = 'images/size_chart.jpg';

//Admin Panel
$config['admin_email'] = array('ishkaran.fearme@gmail.com', 'ishkaran.singh@hotmail.com');

//Mailgun and Newsletter
$config['mailgun_key'] = 'key-0f80f2f05eb0cc5a7f733be72c8fb5**';	//old one
$config['newsletter_address'] = 'updates@news.psychostore.in';
$config['campaign_id'] = 'psycho_campaign';

$config['return_address'] = array(
									'first_name' => 'Ishkaran',
									'last_name' => 'Singh',
									'address_1' 	=> '#35, Mane Building, 7th Main Road',
									'address_2' => 'ST Bed Layout',
									'city' 	=> 'Bengaluru',
									'country' => 'India',
									'phone_number' 	=> '7387045828',
									'pincode' 	=> '560034',
									'state' 	=> 'Karnataka'
									);

/*Current status of the site
Possible Status :
LIVE
DOWN
TRAVELLING*/
$config['current_site_status'] = 'LIVE'


?>