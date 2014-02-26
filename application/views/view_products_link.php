<?php 
foreach($products as $product_item): 
	$id = $product_item['product_id'];
	$path = "/".$product_item['product_image_path'];	
	echo anchor("/product/$id", img($path));
endforeach 
?>