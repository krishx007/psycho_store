<head>
	<title>Psycho Store</title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootswatch/3.0.0/amelia/bootstrap.min.css">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.js"></script>
</head>

<?php
if($user_id == 0)
{	//Not Logged in
?>
	<form action= <?php echo site_url('pages/search')?> method="post">
	<table border="0">
	<tr bgcolor="#cccccc">
	</tr>

	<tr>
	<td>Search</td>
	<td align="center"><input type="text" name="searchQuery" size="39"maxlength="30" /> </td>
	<td> <input type="submit" value="Submit" /></td>
	<td> <?php echo anchor('auth', "Login") ?></td>
	</tr>

	</table>
	</form>

<?php
}
else
{	//Logged In, Show UserName/Logout
?>
	<form action= <?php echo site_url('pages/search')?> method="post">
	<table border="0">
	<tr bgcolor="#cccccc">
	</tr>

	<tr>
	<td>Search</td>
	<td align="center"><input type="text" name="searchQuery" size="39"maxlength="30" /> </td>
	<td> <input type="submit" value="Submit" /></td>
	<td> <?php echo $user_name ?> </td>
	<td> <?php echo anchor('auth/logout', "Logout") ?></td>
	</tr>

	</table>
	</form>
<?php
}




