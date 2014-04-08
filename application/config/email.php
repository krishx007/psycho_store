<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['protocol']= 'smtp';
$config['smtp_host']= 'ssl://smtpout.asia.secureserver.net';// (SMTP server)
$config['smtp_port']= '465';// (SMTP port)
$config['smtp_timeout']= '30';
$config['smtp_user']= 'ishkaran@psychostore.in';
$config['smtp_pass']= 'fear<fearme';


/* End of file email.php */
/* Location: ./application/config/email.php */