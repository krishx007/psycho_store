<?php
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value'	=>	set_value('username', $def_username),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'minlength'	=> $this->config->item('username_min_length', 'tank_auth'),
		'size'	=> 30,
		'class'	=> 'form-control',
		'placeholder'	=> 'Who are you?'
	);
?>

<?php
	$msg = array(
		'name'	=> 'msg',
		'id'	=> 'msg',
		'value'	=>	set_value('msg'),
		'maxlength'	=> 255,
		'minlength'	=> 2,
		'size'	=> 30,
		'class'	=> 'form-control',
		'placeholder'	=> 'Say Something, anything. Praise us, criticize us, which game\'s merchandise you want, anything from the top of your head or you just want a special date with me. Anything will do, speak your heart out.'
	);
?>

<?php
	$email = array(
		'name'	=> 'email',
		'id'	=> 'email',
		'value' => set_value('email', $def_email),
		'maxlength'	=> 80,
		'size'	=> 30,
		'type' => 'email',
		'placeholder' => 'you@email.com',
		'class' => 'form-control',
	);
?>

<div class="container top-bottom-space">
    <h1> Say Something</h1>
    <hr> 
    <div class="well">
    	<div class="row ">
	    	<div class="col-md-12">
	    		<?php echo form_open($this->uri->uri_string()); ?>
				<div class="form-group">
					<p>Name</p>
					<?php echo form_input($username) ?>
					<?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?>
				</div>
				<div class="form-group">
					<p>Email address</p>
					<?php echo form_input($email); ?>
					<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
				</div>
				<div class="form-group">
				    	<p>Message</p>
						<?php echo form_textarea($msg) ?>
						<?php echo form_error($msg['name']); ?><?php echo isset($errors[$msg['name']])?$errors[$msg['name']]:''; ?>
				</div>
			</div>
		</div>	
	</div>
	<button class="btn btn-primary" type="submit">Send Us.</button>
	<?php echo form_close(); ?>
</div>

