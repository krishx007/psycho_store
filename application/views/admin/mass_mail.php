<?php
function disable_ob()
{
    while (ob_get_level())
    {
    	ob_end_flush();
    }
}

function flush_buffer()
{
	//Without this str_pad it wont flush :|
    echo str_pad("",4096," ");
    echo str_pad("",4096," ");
    echo str_pad("",4096," ");
    echo str_pad("",4096," ");
    flush();
}

    disable_ob();
    
	for ($i=0; $i < $num_subscribers; $i++)
	{
		$val = $subscribers[$i];
		//mg_send_mail($val['email'], $params);
		$this->database->SubscriberUpdated($val['email']);
		
		echo  "# $i Mail sent to : {$val['email']} <br>";
		
		flush_buffer();
		sleep(1);
	}

	echo "<br> $i  mails sent <br>";
	echo "Check Mailgun dashboard for stats.<br>";

?>