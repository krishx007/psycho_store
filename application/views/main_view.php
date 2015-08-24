<!DOCTYPE html>
<html>
<head>
	<?php echo $header?>
	<?php 
	if(isset($scripts) && count($scripts))
	{
		foreach ($scripts as $key => $script)
		{
			$this->load->view($script['path'], $script['params']);
		}
	}
	?>
</head>
<body>
	<?php echo $external_scripts ?>
	<?php echo $body?>
	<?php echo $footer?>
	<?php echo $event_tracking ?>
</body>

</html>