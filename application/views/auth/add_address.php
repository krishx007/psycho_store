<div class="container top-bottom-space">
	<h1>Add Address</h1>
	<hr>
	<div class="well">
<?php
$first_name = array(
	'name'	=> 'first_name',
	'id'	=> 'first_name',
	'value' => set_value('first_name'),
	'maxlength'	=> 50,
	'size'	=> 30,
);
$last_name = array(
	'name'	=> 'last_name',
	'id'	=> 'last_name',
	'value' => set_value('last_name'),
	'maxlength'	=> 50,
	'size'	=> 30,
);
$address1 = array(
	'name'	=> 'address1',
	'id'	=> 'address1',
	'value' => set_value('address1'),
	'maxlength'	=> 50,
	'size'	=> 30,
);
$address2 = array(
	'name'	=> 'address2',
	'id'	=> 'address2',
	'value' => set_value('address2'),
	'maxlength'	=> 50,
	'size'	=> 30,
);
$city = array(
	'name'	=> 'city',
	'id'	=> 'city',
	'value' => set_value('city'),
	'maxlength'	=> 20,
	'size'	=> 30,
);
$state = array(
	'name'	=> 'state',
	'id'	=> 'state',
	'value' => set_value('state'),
	'maxlength'	=> 20,
	'size'	=> 30,
);
$country = array(
	'name'	=> 'country',
	'id'	=> 'country',
	'value' => set_value('country'),
	'maxlength'	=> 20,
	'size'	=> 30,
);
$postal = array(
	'name'	=> 'postal',
	'id'	=> 'postal',
	'value' => set_value('postal'),
	'maxlength'	=> 10,
	'size'	=> 30,
);
$number = array(
	'name'	=> 'number',
	'id'	=> 'number',
	'value' => set_value('number'),
	'maxlength'	=> 10,
	'size'	=> 30,
);
?>
<!--<?php echo form_open($this->uri->uri_string()); ?>-->
<form method = 'post' action = <?php echo site_url('auth/register_address')?> role="form">
<?php// echo form_open('auth/register_address'); ?>
<table>
	<tr>
		<td><?php echo form_label('First Name', $first_name['id']); ?></td>
		<td><?php echo form_input($first_name); ?></td>
		<td style="color: red;"><?php echo form_error($first_name['name']); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Last Name', $last_name['id']); ?></td>
		<td><?php echo form_input($last_name); ?></td>
		<td style="color: red;"><?php echo form_error($last_name['name']); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Address1', $address1['id']); ?></td>
		<td><?php echo form_input($address1); ?></td>
		<td style="color: red;"><?php echo form_error($address1['name']); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Address2', $address2['id']); ?></td>
		<td><?php echo form_input($address2); ?></td>
		<td style="color: red;"><?php echo form_error($address2['name']); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('City', $city['id']); ?></td>
		<td><?php echo form_input($city); ?></td>
		<td style="color: red;"><?php echo form_error($city['name']); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('State', $state['id']); ?></td>
		<td><?php echo form_input($state); ?></td>
		<td style="color: red;"><?php echo form_error($state['name']); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Country', $country['id']); ?></td>
		<td><?php echo form_input($country); ?></td>
		<td style="color: red;"><?php echo form_error($country['name']); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Postal', $postal['id']); ?></td>
		<td><?php echo form_input($postal); ?></td>
		<td style="color: red;"><?php echo form_error($postal['name']); ?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Number', $number['id']); ?></td>
		<td><?php echo form_input($number); ?></td>
		<td style="color: red;"><?php echo form_error($number['name']); ?></td>
	</tr>
</table>
<?php// echo form_close(); ?>


</div>
<button class="btn btn-primary" type="submit">Add Address</button>
</form>
</div>