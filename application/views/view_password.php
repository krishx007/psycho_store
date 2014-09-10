<?php 
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'type'	=> 'password',
	'size'	=> 30,
	'class'	=>'form-control',
	'placeholder' => 'password',	
	'minlength'	=> $this->config->item('password_min_length', 'tank_auth'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
);
?>
<label>Password</label>
<?php echo form_password($password); ?>
<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>