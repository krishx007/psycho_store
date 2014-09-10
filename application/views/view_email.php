<?php 

$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value' => set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'type' => 'email',
	'placeholder' => 'you@email.com',
	'class' => 'form-control',
);
?>
<label>Email address</label>
<?php echo form_input($email); ?>
<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
