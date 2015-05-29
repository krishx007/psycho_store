<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'third_party\mailgun-php\vendor\autoload.php';
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
				break;

			case 'order':
				$subject_var = $data['order_id'];
				$data['from'] = 'Psycho Store Orders <email@mails.psychostore.in>';
				break;			

			case 'activate':
				$subject_var = $data['username'];
				$data['from'] = 'Psycho Store<email@mails.psychostore.in>';
			break;
			
			default:
				$subject_var = 'Psycho Store';
				$data['from'] = 'Psycho Store<email@mails.psychostore.in>';
				break;
		}

		$data['subject'] = sprintf($ci->lang->line('auth_subject_'.$type), $subject_var);
		$data['msg'] = $ci->load->view('email/'.$type.'-html', $data, TRUE);

		return $data;
	}
}

if(!function_exists('mg_send_mail'))
{
	function mg_send_mail($to_email, $params)
	{
		$mg = new Mailgun('key-c02fdb3b3ae25a6c91dc222ff814fe0f');
		$domain = 'mails.psychostore.in';
	
		$mg->sendMessage($domain, array(
			'from' 		=> 	$params['from'],
			'to'		=>	$to_email,
			'subject'	=>	$params['subject'],
			'html'		=>	$params['msg']
			));		
	}	
}

if(!function_exists('mg_add_subscriber'))
{
	function mg_add_subscriber($email_id, $name = NULL)
	{
		$mg = new Mailgun('key-c02fdb3b3ae25a6c91dc222ff814fe0f');
		$list_address = 'newsletter@mails.psychostore.in';

		# Issue the call to the client.
		$result = $mg->post("lists/$list_address/members",array(
		    'address'   => $email_id,
		    'name'      => $name,
		    'upsert'	=> 'true'
		));		
	}	
}

if(!function_exists('mg_umg_get_subscriber'))
{
	function mg_get_subscriber($email)
	{
		$mg = new Mailgun('key-c02fdb3b3ae25a6c91dc222ff814fe0f');
		$list_address = 'newsletter@mails.psychostore.in';

		$res = $mg->get("lists/$list_address/members/$email");
	}
}

?>		