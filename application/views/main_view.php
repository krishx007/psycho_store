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
	<?php echo $body?>
	<?php echo $footer?>
</body>

</html>