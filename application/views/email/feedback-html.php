<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title><?php echo $username?>, Psycho Store says "Thank You"</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;"><?php echo $username?>, Psycho Store says "Thank You"</h2>

We hope that you have fallen in love with your Psycho Store merchandise.
<br>
Just wanted to say a big 'Thank you' for ordering from us.
<br>
<br>
Do leave us some <a href="psychostore.in/auth/saysomething">feedback</a>. We would love to know what you think of us and how we can improve.
<br>
<br>
Also, upload your pic with your Psycho Store merchandise on social media and tag us. We will make sure that you get some good discount on your next order.
<br>
<br>
<br>
<p>If there is any query/concern, do contact us at contact@psychostore.in</p>
<br>
<?php  echo $this->load->view('email/signature') ?>;
</td>
</tr>
</table>
</div>
</body>
</html>