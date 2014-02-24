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




