<div class="container top-bottom-space">
	<h1>Select an Address <span class='pull-right'><?php echo anchor("auth/register_address/", 'Add Address', "class='btn btn-default play navbar-btn' "); ?></span> </h1>
	<hr>
<div class="well">
<form method = 'post' action = <?php echo site_url('checkout/payment')?> role="form">
<!-- <table>
<tr> -->
<div class="row">	
<?php
foreach($addresses as $address): 

	$complete_add = $address['address_1'] .',<br>';
	if($address['address_2'] != NULL)
	 	$complete_add += $address['address_2'].', ';
	 $complete_add += $address['city'].'<br>'.$address['state'].' '.$address['pincode'].', '.$address['country'].'<br>'. $address['phone_number'];	
?>
<div class="col-md-3">
<td>
<input type = 'radio' name = 'address_id' checked value = <?php echo $address['address_id'] ?> >


<?php echo $complete_add ?>
<!-- </td> -->
</div>
<?php
endforeach;
?>
<!-- </tr>
<tr>
<td> -->

<?php // echo anchor("auth/remove_address/val", 'Remove Address'); ?>

<!-- </td>
<td>
</td>
<td> -->
<!-- </td>

</tr> -->
</div>
</div>

<button class="btn btn-primary" type="submit"> Proceed To Payment</button>

</form>
<!-- </table> -->


</div>
