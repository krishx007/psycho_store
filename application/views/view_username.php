<?php
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'minlength'	=> $this->config->item('username_min_length', 'tank_auth'),
		'size'	=> 30,
		'class'	=> 'form-control',
		'placeholder'	=> 'your gaming name'
	);
?>
	<p>Gamername</label>
	<?php echo form_input($username) ?>
	<?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>