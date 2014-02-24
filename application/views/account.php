<?php 
foreach ($orders as $order) 
		{
			$orderid = $order['order_id'];
			echo $orderid;
			echo anchor("checkout/view/$orderid", $orderid);
		}
?>