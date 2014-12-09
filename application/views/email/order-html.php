<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Psycho Store | Order Placed</title></head>
<body>
<h1>Hey <?php echo $username?>, your order has been placed!</h1>
<h3>Order Id : <?php echo $order_id; ?></h3>
<p>Thank you for shopping at Psycho Store. Our very efficient minions are onto the task of processing your order. So sit back and relax. Orders are usually shipped within 3-5 buisness days unless G-Man gets involved somehow.</p>

<br>
<br>
<h2>Address</h2>
<p> <?php echo $address; ?> </p>
<h2>Products</h2>
<?php echo $product_table; ?>
<br>
<br>

<p>Note : Please use the above order id in case of any communication/problem regarding this order.</p>
<br>

Stay Psycho!<br />
- The <?php echo $site_name; ?> Team
</div>
</body>
</html>