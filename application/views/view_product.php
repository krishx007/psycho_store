
<?php
	$id = $product['product_id'] - 1;
	
	if($id >= 1 )
		echo anchor("product/$id", "Previous");

  	$id = $product['product_id'] + 1;
  	
  	if($id <= $total_products)
  		echo anchor("product/$id", "Next");
?>

<?php ?>
<table border="10">
<tr> <?php echo $product['product_name'] ?> </tr>
<tr>
<td><img src = <?php echo $product_img  ?> > </td>
</tr>

<tr>
<form method = "post" action = <?php echo site_url("cart/add/{$product['product_id']}")?>>
<td>Price : <?php echo $product['product_price']?> </td>
<td><input type = "radio" name = "size" value = "small">Small</td>
<td><input type = "radio" name = "size" value = "medium">Medium</td>
<td><input type = "radio" name = "size" value = "large" checked>Large</td>
<td><input type = "radio" name = "size" value = "x-large">X-Large</td>
</tr>

<tr>
<td><input type ="submit" value = "Add to Cart" name = "add_to_cart"></td>

</form>
</tr>

</table>
