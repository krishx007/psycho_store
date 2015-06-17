<?php
echo "Very important, Dont close this browser <br>";

  while(ob_get_level() > 0)
  {
  	ob_end_flush();
  }

	for ($i=0; $i < $num_subscribers; $i++)
	{
		$val = $subscribers[$i];
		mg_send_mail($val['email'], $params);
		$this->database->SubscriberUpdated($val['email']);
		echo "# $i Mail sent to : ".$val['email']."<br>";

		flush();
		sleep(1);
	}

	echo "<br> $i  mails sent <br>";
	echo "Check Mailgun dashboard for stats.<br>";
?>