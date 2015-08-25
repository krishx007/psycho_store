<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title><?php echo $username?>, Psycho Store remembers</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;"><?php echo $username?>, Psycho Store remembers!</h2>

You might have forgotten us, but we never forget those who love our products. So as a token of love here's a cheat code specially for you that will unlock some discount.
<br>
<br>
<h1><b>left_left_up_down</b></h1>
<br>
Awesomness is waiting for your in you cart. Go and get it and dont forget to apply this special cheat code.
<br>
<br>
<?php foreach ($products as $key => $product): ?>
<a target="_blank" href="http://psychostore.in/cart">
<img src= "<?php echo site_url($product['product_image_path'])?>" ></img>
<h3> <?php echo $product['product_name']?></h3>
</a>
<?php endforeach; ?>
<br>
<br>
<?php  echo $this->load->view('email/signature') ?>;
</td>
</tr>
</table>
</div>
</body>
</html>