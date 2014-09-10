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
	'placeholder'	=> 'Ishkaran',
	'class' => "form-control"
);
$last_name = array(
	'name'	=> 'last_name',
	'id'	=> 'last_name',
	'value' => set_value('last_name'),
	'maxlength'	=> 50,
	'size'	=> 30,
	'placeholder'	=> 'Singh',
	'class' => "form-control"
);
$address1 = array(
	'name'	=> 'address1',
	'id'	=> 'address1',
	'value' => set_value('address1'),
	'maxlength'	=> 50,
	'size'	=> 30,
	'class' => "form-control"
);
$address2 = array(
	'name'	=> 'address2',
	'id'	=> 'address2',
	'value' => set_value('address2'),
	'maxlength'	=> 50,
	'size'	=> 30,
	'class' => "form-control"
);
$city = array(
	'name'	=> 'city',
	'id'	=> 'city',
	'value' => set_value('city'),
	'maxlength'	=> 20,
	'size'	=> 30,
	'class' => "form-control",
);
$state = array(
	'name'	=> 'state',
	'id'	=> 'state',
	'value' => set_value('state'),
	'maxlength'	=> 20,
	'size'	=> 30,
	'class' => "form-control"
);
$country = array(
	'name'	=> 'country',
	'id'	=> 'country',
	'value' => set_value('country'),
	'maxlength'	=> 20,
	'size'	=> 30,
	'class' => "form-control",
	'placeholder'	=> 'India',
	'readonly' => 'readonly'
);
$pincode = array(
	'name'	=> 'pincode',
	'id'	=> 'pincode',
	'value' => set_value('pincode'),
	'maxlength'	=> 10,
	'size'	=> 30,
	'class' => "form-control"
);
$number = array(
	'name'	=> 'number',
	'id'	=> 'number',
	'type'	=> 'number',
	'value' => set_value('number'),
	'maxlength'	=> 10,
	'minlength'	=> 10,
	'size'	=> 30,
	'class' => "form-control",
	'placeholder' => '+91 -',	
);
?>
<!--<?php echo form_open($this->uri->uri_string()); ?>-->
<form method = 'post' action = <?php echo site_url('auth/register_address')?> role="form">
<?php // echo form_open('auth/register_address'); ?>
<div class="form-group">
	<?php echo form_label('First Name', $first_name['id']); ?>
		<?php echo form_input($first_name); ?>
		<?php echo form_error($first_name['name']); ?>
</div>
<div class="form-group">
		<?php echo form_label('Last Name', $last_name['id']); ?>
		<?php echo form_input($last_name); ?>
		<?php echo form_error($last_name['name']); ?>
</div>
<div class="form-group">
		<?php echo form_label('Address1', $address1['id']); ?>
		<?php echo form_input($address1); ?>
		<?php echo form_error($address1['name']); ?>
</div>
<div class="form-group">
		<?php echo form_label('Address2', $address2['id']); ?>
		<?php echo form_input($address2); ?>
		<?php echo form_error($address2['name']); ?>
</div>
<div class="form-group">
		<?php echo form_label('City', $city['id']); ?>
		<?php echo form_input($city); ?>
		<?php echo form_error($city['name']); ?>
</div>
<div class="form-group">
		<?php echo form_label('State', $state['id']); ?>
		<?php echo form_input($state); ?>
		<?php echo form_error($state['name']); ?>
</div>
<div class="form-group">
		<?php echo form_label('Country', $country['id']); ?>
		<?php echo form_input($country); ?>
		<?php echo form_error($country['name']); ?>
</div>
<div class="form-group">
		<?php echo form_label('Pincode', $pincode['id']); ?>
		<?php echo form_input($pincode); ?>
		<?php echo form_error($pincode['name']); ?>
</div>
<div class="form-group">
		<?php echo form_label('Number', $number['id']); ?>
		<?php echo form_input($number); ?>
		<?php echo form_error($number['name']); ?>		
</div>

</div>
<button class="btn btn-primary" type="submit">Add Address</button>
</form>
</div>