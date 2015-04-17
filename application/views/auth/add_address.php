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
$states = array(				  
                  'Anadaman and Nicobar Islands'  => 'Anadaman and Nicobar Islands',
                  'Andhra Pradesh'    => 'Andhra Pradesh',
                  'Arunachal Pradesh'   => 'Arunachal Pradesh',
                  'Chandigarh' => 'Chandigarh',
                  'Chhattisgarh' => 'Chhattisgarh',
                  'Dadra and Nagar Haveli' => 'Dadra and Nagar Haveli',
                  'Daman and Diu' => 'Daman and Diu',                  
                  'Goa' => 'Goa',
                  'Gujarat' => 'Gujarat',
                  'Haryana' => 'Haryana',
                  'Himachal Pradesh' => 'Himachal Pradesh',
                  'Jammu and Kashmir' => 'Jammu and Kashmir',
                  'Jharkhand' => 'Jharkhand',
                  'Karnatka' => 'Karnatka',
                  'Kerala' => 'Kerala',
                  'Lakshadweep' => 'Lakshadweep',
                  'Maharashtra' => 'Maharashtra',
                  'Madhya Pradesh' => 'Madhya Pradesh',
                  'Manipur' => 'Manipur',
                  'Meghalaya' => 'Meghalaya',
                  'Mizoram' => 'Mizoram',
                  'Nagaland' => 'Nagaland',
                  'New Delhi' => 'New Delhi',
                  'Orissa' => 'Orissa',
                  'Pondicherry' => 'Pondicherry',
                  'Punjab' => 'Punjab',
                  'Rajashthan' => 'Rajashthan',
                  'Sikkim' => 'Sikkim',
                  'Tamil Nadu' => 'Tamil Nadu',
                  'Telangana' => 'Telangana',
                  'Tripura' => 'Tripura',
                  'Uttar Pradesh' => 'Uttar Pradesh',
                  'Uttarakhand' => 'Uttarakhand',
                  'West Bengal' => 'West Bengal',
                );
$country = array(
	'name'	=> 'country',
	'id'	=> 'country',
	'value' => set_value('country','India'),
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
	'placeholder' => '+91 - Enter 10 digit number',	
);
?>
<!--<?php echo form_open($this->uri->uri_string()); ?>-->
<form method = 'post' action = <?php echo site_url('auth/register_address')?> role="form">
<?php // echo form_open('auth/register_address'); ?>
<div class="form-group">
	<?php echo ('First Name'); ?>
		<?php echo form_input($first_name); ?>
		<?php echo form_error($first_name['name']); ?>
</div>
<div class="form-group">
		<?php echo ('Last Name'); ?>
		<?php echo form_input($last_name); ?>
		<?php echo form_error($last_name['name']); ?>
</div>
<div class="form-group">
		<?php echo ('Address1'); ?>
		<?php echo form_input($address1); ?>
		<?php echo form_error($address1['name']); ?>
</div>
<div class="form-group">
		<?php echo ('Address2'); ?>
		<?php echo form_input($address2); ?>
		<?php echo form_error($address2['name']); ?>
</div>
<div class="form-group">
		<?php echo ('City'); ?>
		<?php echo form_input($city); ?>
		<?php echo form_error($city['name']); ?>
</div>
<div class="form-group">
		<?php echo ('State'); ?>
		<select name="state" class='form-control'>
			<option value="Anadaman and Nicobar Islands" <?php echo set_select('state', 'Anadaman and Nicobar Islands'); ?>>Anadaman and Nicobar Islands</option>
			<option value="Andhra Pradesh" <?php echo set_select('state', 'Andhra Pradesh'); ?> >Andhra Pradesh</option>
			<option value="Arunachal Pradesh" <?php echo set_select('state', 'Arunachal Pradesh'); ?> >Arunachal Pradesh</option>
			<option value="Chandigarh" <?php echo set_select('state', 'Chandigarh'); ?> >Chandigarh</option>
			<option value="Chhattisgarh" <?php echo set_select('state', 'Chhattisgarh'); ?> >Chhattisgarh</option>
			<option value="Dadra and Nagar Haveli" <?php echo set_select('state', 'Dadra and Nagar Haveli'); ?> >Dadra and Nagar Haveli</option>
			<option value="Daman and Diu" <?php echo set_select('state', 'Daman and Diu'); ?> >Daman and Diu</option>
			<option value="Goa" <?php echo set_select('state', 'Goa'); ?> >Goa</option>
			<option value="Gujarat" <?php echo set_select('state', 'Gujarat'); ?> >Gujarat</option>
			<option value="Haryana" <?php echo set_select('state', 'Haryana'); ?> >Haryana</option>
			<option value="Himachal Pradesh" <?php echo set_select('state', 'Himachal Pradesh'); ?> >Himachal Pradesh</option>
			<option value="Jammu and Kashmir" <?php echo set_select('state', 'Jammu and Kashmir'); ?> >Jammu and Kashmir</option>
			<option value="Jharkhand" <?php echo set_select('state', 'Jharkhand'); ?> >Jharkhand</option>
			<option value="Karnatka" <?php echo set_select('state', 'Karnatka'); ?> >Karnatka</option>
			<option value="Kerala" <?php echo set_select('state', 'Kerala'); ?> >Kerala</option>
			<option value="Lakshadweep" <?php echo set_select('state', 'Lakshadweep'); ?> >Lakshadweep</option>
			<option value="Maharashtra" <?php echo set_select('state', 'Maharashtra'); ?> >Maharashtra</option>
			<option value="Madhya Pradesh" <?php echo set_select('state', 'Madhya Pradesh'); ?> >Madhya Pradesh</option>
			<option value="Manipur" <?php echo set_select('state', 'Manipur'); ?> >Manipur</option>
			<option value="Meghalaya" <?php echo set_select('state', 'Meghalaya'); ?> >Meghalaya</option>
			<option value="Mizoram" <?php echo set_select('state', 'Mizoram'); ?> >Mizoram</option>
			<option value="Nagaland" <?php echo set_select('state', 'Nagaland'); ?> >Nagaland</option>
			<option value="New Delhi" <?php echo set_select('state', 'New Delhi', TRUE); ?> >New Delhi</option>
			<option value="Orissa" <?php echo set_select('state', 'Orissa'); ?> >Orissa</option>
			<option value="Pondicherry" <?php echo set_select('state', 'Pondicherry'); ?> >Pondicherry</option>
			<option value="Punjab" <?php echo set_select('state', 'Punjab'); ?> >Punjab</option>
			<option value="Rajashthan" <?php echo set_select('state', 'Rajashthan'); ?> >Rajashthan</option>
			<option value="Sikkim" <?php echo set_select('state', 'Sikkim'); ?> >Sikkim</option>
			<option value="Tamil Nadu" <?php echo set_select('state', 'Tamil Nadu'); ?> >Tamil Nadu</option>
			<option value="Telangana" <?php echo set_select('state', 'Telangana'); ?> >Telangana</option>
			<option value="Tripura" <?php echo set_select('state', 'Tripura'); ?> >Tripura</option>
			<option value="Uttar Pradesh" <?php echo set_select('state', 'Uttar Pradesh'); ?> >Uttar Pradesh</option>
			<option value="Uttarakhand" <?php echo set_select('state', 'Uttarakhand'); ?> >Uttarakhand</option>
			<option value="West Bengal" <?php echo set_select('state', 'West Bengal'); ?> >West Bengal</option>
		</select>		
		<?php echo form_error($state['name']); ?>
</div>
<div class="form-group">
		<?php echo ('Country'); ?>
		<?php echo form_input($country); ?>
		<?php echo form_error($country['name']); ?>
</div>
<div class="form-group">
		<?php echo ('Pincode'); ?>
		<?php echo form_input($pincode); ?>
		<?php echo form_error($pincode['name']); ?>
</div>
<div class="form-group">
		<?php echo ('Number'); ?>
		<?php echo form_input($number); ?>
		<?php echo form_error($number['name']); ?>		
</div>

</div>
<button class="btn btn-primary" type="submit">Add Address</button>
</form>
</div>