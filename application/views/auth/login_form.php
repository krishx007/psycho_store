<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})	
</script>


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
<?php $redirect_url =  rawurlencode($this->input->get('redirect_url'))?>
 <?php echo form_open($this->uri->uri_string().'?redirect_url='.$redirect_url); ?>
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

	<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', ' Register'); ?> \
  	<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
</div>

<button class="btn btn-primary" data-toggle="tooltip" title="No need to insert coins!" data-placement="right" type="submit">Start the game!</button>
<?php echo form_close(); ?>
</div>