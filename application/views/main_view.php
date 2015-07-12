<!DOCTYPE html>
<?php 
if(isset($scripts) && count($scripts))
{
	foreach ($scripts as $key => $script)
	{
		$this->load->view($script);
	}
}
?>
<html>
<head>
	<?php echo $header?>
</head>
<body>
	<?php echo $body?>
	<?php echo $footer?>
</body>

</html>