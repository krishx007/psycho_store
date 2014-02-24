<?php 
foreach($products as $product_item): 
	$id = $product_item['tshirt_id'];
	$path = "/".$product_item['tshirt_image_path'];
	echo anchor("pages/product/$id", img($path));
endforeach 
?>