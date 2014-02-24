
<?php $id = $product['tshirt_id'] - 1; echo anchor("pages/product/$id", "Previous")?>

<?php $id = $product['tshirt_id'] + 1; echo anchor("pages/product/$id", "Next")?>
<table border="10">
<tr> <?php echo $product['tshirt_name'] ?> </tr>
<tr>
<td><img src = <?php echo $tshirt_img  ?> > </td>
</tr>

<tr>
<form method = "post" action = <?php echo site_url("cart/add/{$product['tshirt_id']}")?>>
<td>Price : <?php echo $product['tshirt_price']?> </td>
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
