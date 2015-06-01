<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'type'	=>	'password',
	'placeholder' => 'New Password',
	'minlength'	=> $this->config->item('password_min_length', 'tank_auth'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class'	=>	'form-control'
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'type'	=>	'password',
	'placeholder' => 'New Password',
	'minlength'	=> $this->config->item('password_min_length', 'tank_auth'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class'	=>	'form-control'
);
?>

<div class="container top-bottom-space">
	<h1>Reset Password</h1>
	<hr>
	<div class="well">
		<?php echo form_open($this->uri->uri_string()); ?>
		<div class="form-group">
			<p>New Password</p>
			<?php echo form_password($new_password); ?>
			<?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?>
		</div>		
		<div class='form-group'>
			<p>Confirm New Password</p>
			<?php echo form_password($confirm_new_password); ?>
			<?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?>
		</div>	
	</div>
		<button class="btn btn-primary" type="submit">Change Passowrd</button>
		<?php echo form_close(); ?>
</div>