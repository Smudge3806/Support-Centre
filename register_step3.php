<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon16.ico" type="image/x-icon" >

<title>Setup your account</title>

</head>
<?php
	session_start();
	$_SESSION['f'] = 1;
?>
<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div class="description">
		<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
			<h2 id="title">
				Welcome to Support Centre
			</h2>
			<p id="title">Create Your Password</p>
		</div>
	</div>
	<div style="width:635px;float:left;background-color:white;box-shadow:#666 0px 0px 25px;border-radius:5px;margin:-25px 4px 25px 14px;padding:45px 10px 10px 10px">
			<p>Enter your date of birth. This will be your password.</p>
			<form name="dob" action="http://www.barnsley-ltu.co.uk/controllers/change_password.php" method="post" style="width:600px;margin:auto">
				<table>
					<tr>
						<td>
							<input type="hidden" name="page" value="profile.php?m=Welcome to Support Centre! Take some time to look around your new profile page.">
							<input type="text" name="date[day]" placeholder="Day(dd)" required>
							<select name="date[month]" style="width:159px">
								<option value="01">January</option>
								<option value="02">Febuary</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
							<input type="text" name="date[year]" placeholder="Year(yyyy)" required>							
							<input type="submit" value="Create">
						</td>
					</tr>
				</table>
			</form>
		</div>
		<?php
		include('views/page_footer.php');
	?>

</body>

</html>
