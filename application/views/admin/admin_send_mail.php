<?php
	$subject = array(
		'name'	=> 'subject',
		'id'	=> 'subject',		
		'size'	=> 30,
		'class'	=> 'form-control',
		'placeholder'	=> 'Subject'
	);
?>

<?php
	$email = array(
		'name'	=> 'email',
		'id'	=> 'email',
		'maxlength'	=> 80,
		'size'	=> 30,
		'type' => 'email',
		'placeholder' => 'you@email.com',
		'class' => 'form-control',
	);
?>

<?php
	$msg = array(
		'name'	=> 'msg',
		'id'	=> 'msg',		
		'maxlength'	=> 255,
		'minlength'	=> 2,
		'size'	=> 30,
		'class'	=> 'form-control',
		'placeholder'	=> 'Email Body.'
	);
?>

<div class="container top-bottom-space">
    <h1> Send Mail </h1>
    <hr> 
    <div class="well">
    	<div class="row">
	    	<div class="col-md-6">
	    		<?php echo form_open($this->uri->uri_string()); ?>
				<div class="form-group">
					<p>Email address</p>
					<?php echo form_input($email); ?>
					<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
				</div>
				<div class="form-group">
					<p>Subject</p>
					<?php echo form_input($subject) ?>
					<?php echo form_error($subject['name']); ?><?php echo isset($errors[$subject['name']])?$errors[$subject['name']]:''; ?>
				</div>				
				<div class="form-group">
				    	<p>Message</p>
						<?php echo form_textarea($msg) ?>
						<?php echo form_error($msg['name']); ?><?php echo isset($errors[$msg['name']])?$errors[$msg['name']]:''; ?>
				</div>
			</div>
		</div>	
	</div>
	<button class="btn btn-primary" type="submit">Send Mail</button>
	<?php echo form_close(); ?>
</div>

