<div class="container top-bottom-space well">
<form method = 'post' action = <?php echo site_url('checkout/payment')?> >
<table>
<tr>
<?php

foreach($addresses as $address): 
	$complete_add = $address['address_1'] .',<br>'. $address['address_2'].', '.$address['city'].
	'<br>'.$address['state'].' '.$address['postal'].', '.$address['country'].'<br>'. $address['phone_number'];	
?>

<td>
<input type = 'radio' name = 'address_id' checked value = <?php echo $address['address_id'] ?> >


<?php echo $complete_add ?>
</td>

<?php
endforeach;
?>
</tr>
<tr>
<td>

<?php // echo anchor("auth/remove_address/val", 'Remove Address'); ?>

</td>
<td>
<?php echo anchor("auth/register_address/", 'Add Address'); ?>
</td>
<td>
<input type = 'submit' value = 'Buy'>
</td>

</tr>
</form>
</table>
</div>


