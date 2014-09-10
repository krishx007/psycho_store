<div class="container top-bottom-space ">
	<h1>Login</h1>
	<hr>
	<div class="well">
<?php

$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
	'type'	=> 'checkbox',
	'class'	=>	'checkbox'
);

?>
 <?php echo form_open($this->uri->uri_string()); ?>
 <div class="form-group">
    <?php echo $this->load->view('view_email') ?>
  </div>
  <div class="form-group">
    <?php echo $this->load->view('view_password') ?>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Remember Me
    </label>
  </div>

  	<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
	<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', ' Register'); ?>
</div>

<button class="btn btn-primary" type="submit">Login</button>
<?php echo form_close(); ?>
</div>