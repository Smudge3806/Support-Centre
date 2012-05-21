<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Register for Support Centre</title>
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico">
</head>

<body>
	<?php include('../views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('../views/metro_navigation.php'); ?>
	</div>
	<div class="description">
		<div class="inner" style="background-color:#459D35;">
			<h2 id="title">What did you think of the demo?</h2>
			<p id="inner_description">Like the look of the Demo? Register Below!</p>
		</div>
		
	</div>
	<form name="register" action="http://www.barnsley-ltu.co.uk/controllers/register.php" method="post">
			<fieldset style="background-color:white;border:thin black solid;width:500px;margin:auto">
				<legend>Register</legend>
				<?php if(isset($_GET['m']))
				{ ?>
					<p class="message" style="margin-left:25px"><?php echo $_GET['m']; ?></p>
				<?php } ?>
				<table style="width:250px;margin:auto">
					<tr>
						<td>First Name:</td>
						<td><input type="text" name="first_name" placeholder="First Name" required></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><input type="text" name="last_name" placeholder="Last Name" required></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="email" name="email" placeholder="j.bloggs@barnsley.ac.uk" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Register"></td>
					</tr>
				</table>
			</fieldset>

		</form>
</body>

</html>
