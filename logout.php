<?php
	include('controllers/is_logged_in.php');
	if(isset($_POST['action']))
	{
		session_destroy();
		include('controllers/dbconnection.php');
		$mysqli->query('DELETE FROM cookie_codes WHERE raw_code = "'.$_COOKIE['barns_code'].'"');
		setcookie('barns_code', '', time()-3600);
		header('location: login.php?logout=true');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Logout</title>
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/metro.css">
<link rel="shortcut icon" href="img/favicon.ico" >
<style type="text/css">
fieldset{
	width:250px;
	height:150px;
	margin:auto;
	background-color:white;
	border:thin black solid;
	margin-top:65px;
}

</style>
</head>

<body class="wrapper">
	<?php include('views/page_header.php'); ?>

	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	
	<div style="clear:both;padding-top:50px">
		<fieldset>
			<table style="width:110px;margin:auto;padding-top:35px">
				<tr>
					<th colspan="2">Are you sure?</th>
				</tr>
				<tr>
					<td>
						<form action="logout.php" method="post">
							<input type="hidden" name="action" value="yes">
							<input type="submit" value="Yes">
						</form>
					</td>
					<td>
						<form action="index.php">
							<input type="submit" value="No" >
						</form>
					</td>	
				</tr>
			</table>
		</fieldset>
	</div>
	

				
		<?php
		include('views/page_footer.php');
	?>

</body>

</html>
