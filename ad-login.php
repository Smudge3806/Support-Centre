<?php
	include('controllers/check_proto.php');
	error_reporting(0);
?>
<!DOCTYPE html>
<?php
	//set-up
	include('controllers/dbconnection.php');
	if(!isset($_GET['logout']))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$result = $mysqli->query("SELECT uid FROM ip_logs WHERE ip_address = '{$ip}'");
		if($result->num_rows == 1)
		{
			$row = $result->fetch_object();
			//header('location: authent.php?user='.$row->uid.'&perm=auto');
			$e = "There is currently a problem with automatic login. Please enter your login details.";
		}
		
		if(isset($_COOKIE['barns_code']))
		{
			header('location: authent.php?perm=cookie');
		}
	}
	else
	{
		$e = "See You Soon!";
	}
	if(isset($_GET['e']))
	{
		$e = $_GET['e'];
		switch ($e)
		{
			case 1:
				$e = "User does not exist";
				break;
			case 2:
				$e = "Please re-enter your user details";
				break;
			case 3:
				$e = "Incorrect Email/Password Combination";
				break;
			case 4:
				$e = "There has been a problem with applying your settings. Contact LTU.";
				break;
			case 5:
				$e = "You Must Login First";
				break;
		} 
	}
	

?>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon16.ico" type="image/x-icon" >
<title>Barnsley College LTU Support Centre</title>
<style type="text/css">
	#loginUI{
	width:270px;
	height:290px;
	padding:20px;
	margin:10px;
	background-color:white;
	border-radius:5px;
	box-shadow: #666 0px 0px 25px;
	float:left;
	margin-top:-45px
}
.side
{
	clear:none;
	width:283px;
}
.UILayout
{
	float:left;
	margin-top:25px;
}

.UILayout input[type=text],input[type=password],input[type=email]
{
	width:155px;
}
</style>
</head>

<body>
	<?php
		if(isset($_GET['m']))
		{
			?>
				<div class="notice">
					<p style="float:left"><?php echo $_GET['m']; ?></p>
					<a href="login.php" title="Clear" id="clear">     </a>
				</div>
			<?php
		}
	?>

	<?php include('views/page_header.php'); ?>	
	<div class="metro" id="navigation" style="float:right;clear:both">
		<a href="https://www.barnsley-ltu.co.uk/register.php" id="link" title="Register to access the Support Centre">Register</a>
		<a href="https://www.barnsley-ltu.co.uk/about.php" id="link" title="About LTU Support Centre">About</a>
		<a href="https://www.barnsley-ltu.co.uk/contact.php" id="link" title="Contact Us">Contact Us</a>
	</div>
	
	
	<div style="width:290px;margin:auto;">
		<div class="UILayout">
			<div class="side">
				<div class="inner_side" style="opacity:0.99; box-shadow:#666 0px 0px 25px">
					<p>Admin Login</p>
				</div>
			</div>
	
			<div id="loginUI">
				<form name="login" method="post" action="https://www.barnsley-ltu.co.uk/authent.php" style="padding-top:60px">
					<table>
						<?php if(isset($e)){ ?><tr><td colspan="2" style="color:red;text-align:center"><?php echo $e; ?></td></tr><?php } ?>
						<tr>
							<td>Email:</td>
							<td><input type="email" placeholder="Email Address" name="email" required></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type="password" placeholder="Password" name="password" required></td>
						</tr>
						<tr>
							<td><input type="hidden" name="perm" value="login" ></td>
							<td><input type="submit" value="Login"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
			
	</div>

	<?php
		include('views/page_footer.php');
	?>
</body>

</html>
