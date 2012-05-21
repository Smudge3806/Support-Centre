<?php 
	if(!isset($_SESSION['uid']))
	{
?>
<div class="header-login">
	<form name="header-login" action="controllers/login.php" method="get">
		<table>
			<tr>
				<td>Username:</td>
				<td><input name="username" type="text" value="Username" onfocus="ClickClear(this, 'Username')" onblur="ClickReturn(this, 'Username')"></td>
			</tr>
		</table>
	</form>
</div>
<?php
	}
	else
	{
?>
<div class="header-options">
	<a href="settings.php" title="Edit Your Account Settings">Settings</a>
	<a href="logout.php" title="Log Out">Log Out</a>
</div>
<?php
	}
?>