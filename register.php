<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico" >
<title>Register for an account</title>
</head>

<body class="wrapper">
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation" style="float:right;clear:both">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div class="description">
		<div class="inner">
			<h2 id="title">
				Welcome to the LTU Support Centre!!!
			</h2>
		</div>
	</div>
	<hr style="margin-top:0px;margin-bottom:25px">
	<div style="width:620px;margin:auto">
		<img src="img/sup_cent_logo.png" alt="Support Centre Logo" width="670px">
	</div>
	<p>Support Centre is a one stop portal for all your Information Learning Technology Support needs! Register below to benefit from expert help and advice, as and when you need it.</p>
	<article>
		<?php
			if(isset($_GET['c']))
			{
				?>
				<b class="message" style="margin-left:25px"><?php echo $_GET['m']; ?></b><br><br>
				<b style="margin-left:25px">Remember to check your Junk Mail folder!</b>
				<?php
			}
			else
			{
		?>
		<form name="register" method="post" action="controllers/register.php">
			<fieldset style="background-color:white;border:thin black solid">
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
		<?php
			}
		?>
	</article>
	<br>
		
</body>

</html>
