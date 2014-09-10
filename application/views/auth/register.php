<div class="container top-bottom-space ">
	<h1>Register</h1>
	<hr>
	<div class="well">
<?php
?>

<?php echo form_open($this->uri->uri_string()); ?>
<div class="form-group">
	<?php echo $this->load->view('view_username') ?>	
</div>
<div class="form-group">
    <?php echo $this->load->view('view_email.php') ?>
</div>
<div class="form-group">
	<?php echo $this->load->view('view_password.php') ?>
</div>
</div>
<button class="btn btn-primary" type="submit">Register</button>
<?php echo form_close(); ?>

</div>