<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'third_party/mailgun-php/vendor/autoload.php';
use Mailgun\Mailgun;

if(!function_exists('mg_create_mail_params'))
{
	function mg_create_mail_params($type, $data)
	{
		$ci =& get_instance();
		$ci->load->language('tank_auth.php');
				
		switch ($type)
		{
			case 'first_order':
				$subject_var = $data['username'];
				$data['from'] = 'Psycho Store<email@mails.psychostore.in>';
				$data['domain'] = 'mails.psychostore.in';
			break;

			case 'order':
				$subject_var = $data['order_id'];
				$data['from'] = 'Psycho Store Orders <email@mails.psychostore.in>';
				$data['domain'] = 'mails.psychostore.in';
			break;			

			case 'activate':
				$subject_var = $data['username'];
				$data['from'] = 'Psycho Store<email@mails.psychostore.in>';
				$data['domain'] = 'mails.psychostore.in';
			break;
			
			default:
				$subject_var = 'Psycho Store';
				$data['from'] = 'Psycho Store<email@mails.psychostore.in>';
				$data['domain'] = 'mails.psychostore.in';
			break;
		}

		$data['subject'] = sprintf($ci->lang->line('auth_subject_'.$type), $subject_var);
		$data['txt'] = $ci->load->view('email/'.$type.'-txt', $data, TRUE);
		$data['html'] = $ci->load->view('email/'.$type.'-html', $data, TRUE);

		return $data;
	}
}

if(!function_exists('mg_send_mail'))
{
	function mg_send_mail($to_email, $params)
	{
		$key = get_instance()->config->item('mailgun_key');
		$mg = new Mailgun($key);
		$domain = $params['domain'];

		$mg->sendMessage($domain, array(
			'from' 		=> 	$params['from'],
			'to'		=>	$to_email,
			'subject'	=>	$params['subject'],
			'html'		=>	$params['html'],
			'text'		=>	$params['txt']
			));		
	}	
}

if(!function_exists('mg_add_subscriber'))
{
	function mg_add_subscriber($email_id, $name = NULL)
	{
		$key = get_instance()->config->item('mailgun_key');
		$mg = new Mailgun($key);
		$list_address = get_instance()->config->item('newsletter_address');

		# Issue the call to the client.
		$result = $mg->post("lists/$list_address/members",array(
		    'address'   => $email_id,
		    'name'      => $name,
		    'subscribed'=> 'yes',
		    'upsert'	=> 'true'
		));
	}
}

if(!function_exists('mg_delete_subscriber'))
{
	function mg_delete_subscriber($email_id)
	{
		$key = get_instance()->config->item('mailgun_key');
		$mg = new Mailgun($key);
		$list_address = get_instance()->config->item('newsletter_address');

		# Issue the call to the client.
		$result = $mg->delete("lists/$list_address/members/$email_id");
	}	
}

if(!function_exists('mg_unsubscribe'))
{
	function mg_unsubscribe($email_id)
	{
		$key = get_instance()->config->item('mailgun_key');
		$mg = new Mailgun($key);
		$list_address = get_instance()->config->item('newsletter_address');

		# Issue the call to the client.
		$result = $mg->put("lists/$list_address/members",array(
		    'address'  => $email_id,
		    'subscribed'=> 'no',
		));
	}	
}

if(!function_exists('mg_get_subscriber'))
{
	function mg_get_subscriber($email)
	{
		$key = get_instance()->config->item('mailgun_key');
		$mg = new Mailgun($key);
		$list_address = get_instance()->config->item('newsletter_address');

		$res = $mg->get("lists/$list_address/members/$email");
	}
}

?>		