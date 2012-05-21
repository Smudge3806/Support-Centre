<?php
	include('controllers/is_logged_in.php');
	include('controllers/dbconnection.php');
	require_once('models/user.php');
	$user = new User($_SESSION['uid'], true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

<link rel="stylesheet" href="styles/metro.css">
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/about.css">
<link rel="stylesheet" href="styles/pie.css">
<link rel="shortcut icon" href="img/favicon.ico" >
<script src="scripts/fade/script.js" type="text/javascript"></script>
<title>Account Settings</title>
<style type="text/css">
	#username{
		width:500px;
}
</style>
</head>

<body>
	<div class="header" style="float:left;display:inline">
		<h1 class="title" style="float:left;display:inline">Account Settings</h1>
	</div>	
	<div class="header"  style="float:right;display:inline">
	<?php include('views/page_header.php'); ?>
	</div>
		<div class="metro">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div class="container" style="clear:both">
		
		<p><a href="#firstname" onclick="fadeEffect.init('firstname', 1)" style="float:left;"><?php echo $user->first_name ?></a> <a href="#lastname" onclick="fadeEffect.init('lastname', 1)" style="float:left;"><?php echo $user->last_name; ?></a></p>
		<div class="container" id="firstname" style="opacity:0;float:left">
			<span onclick="fadeEffect.init('firstname', 0)" style="float:right" id="clear"></span>
			<table>
				<tr>
				<td id="label">Forename:</td>
				<td id="info"><form name="forename" action="controllers/change_name.php" method="post">
					<input type="hidden" name="page" value="account.php">
					<input type="hidden" name="field" value="forename">
					<input type="text" name="info" value="<?php echo $user->first_name; ?>">
					<input type="submit" value="Change"> 
				</form></td>
			</tr>

			</table>
		</div>
		<div class="container" id="lastname" style="float:left;opacity:0">
			<span onclick="fadeEffect.init('lastname', 0)" style="float:right" id="clear"></span>
			<table>
				<tr>
				<td id="label">Surname:</td>
				<td id="info"><form name="surname" action="controllers/change_name.php" method="post">
					<input type="hidden" name="page" value="account.php">
					<input type="hidden" name="field" value="surname">
					<input type="text" name="info" value="<?php echo $user->last_name; ?>">
					<input type="submit" value="Change"> 
				</form></td>
				</tr>

			</table>
		</div>
		
		<table class="user_info">
			<!--<tr>
				<td id="label">Forename:</td>
				<td id="info"><form name="forename" action="controllers/change_name.php" method="post">
					<input type="hidden" name="page" value="account.php">
					<input type="hidden" name="field" value="forename">
					<input type="text" name="info" value="<?php echo $user->first_name; ?>">
					<input type="submit" value="Change"> 
				</form></td>
			</tr>
			<tr>
				<td id="label">Surname:</td>
				<td id="info"><form name="surname" action="controllers/change_name.php" method="post">
					<input type="hidden" name="page" value="account.php">
					<input type="hidden" name="field" value="surname">
					<input type="text" name="info" value="<?php echo $user->last_name; ?>">
					<input type="submit" value="Change"> 
				</form></td>
			</tr>
			<tr>
				<td id="label">Email:</td>
				<td id="info"><?php echo $user->email; ?></td>
			</tr>
			<tr>
				<td id="label">Extension:</td>
				<td id="info"><form name="telephone" method="post" action="controllers/change_telephone.php">
					<input type="hidden" name="page" value="account.php">
					<input type="text" name="ext" value="<?php echo $user->telephone; ?>">
					<input type="submit" value="Change">
				</form></td>
			</tr>
			<tr>
				<?php include("controllers/department_list.php"); ?>
				<td id="label">Department:</td>
				<!-- auto-select -> selected="selected" -->
				<!--<td id="info"><form name="department" action="controllers/change_department.php" method="post">
				<input type="hidden" name="page" value="account.php">
				<?php include('views/department_select.php'); ?>
				<input type="submit" value="Change">
				</form></td>
			</tr>
			
			<tr>
				<td id="label">Password:</td>
				<td id="info"><form name="password" action="controllers/change_password.php" method="post">
					<input type="hidden" name="page" value="account.php">
					<input type="password" name="password" placeholder="New Password">
					<input type="submit" value="Change">
				</form></td>
			</tr>-->
			
		</table>
	
	</div>
		<?php
		include('views/page_footer.php');
	?>

</body>

</html>
