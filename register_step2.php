<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Setup your account</title>
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<style type="text/css">
input[type=submit]
{
	background-image:url(https://s-static.ak.fbcdn.net/rsrc.php/v1/yZ/r/l_kYQEMzvfA.png);
	background-repeat:no-repeat;
	background-position:0 -98px;
	background-color:#5b74a8;
	border-color:#29447e #29447e #1a356e;
	padding: 1px 6px;
	border: 1px solid;
	cursor:pointer;
	vertical-align:middle;
	color:white;
	display: inline-block;
	font-family: 'Lucida Grande', Tahoma, Verdana, Arial, sans-serif;
	font-size: 15px;
	font-weight: bold;
	margin: 0;
	white-space: nowrap;
}

</style>

</head>
<?php
	session_start();
	$code = $_GET['code'];
	include('controllers/dbconnection.php');
	$result = $mysqli->query("SELECT * FROM registration_codes");
	while($user = $result->fetch_object())
	{
		
		$vericode = $user->code;
		if($vericode == $code)
		{
			echo "found code";
			$rid = $user->rid;
			$mysqli->query("DELETE FROM registration_codes WHERE rid = ".$rid);
			break;
		}
	}
	$_SESSION['uid'] = $user->uid;
	$_SESSION['account'] = "user";
?>
<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div class="description">
		<div class="inner" style="opacity:0.99">
			<h2 id="title">
			Welcome to Support Centre!!!
			</h2>
			<p id="inner_description">Select you department from the list.</p>
		</div>
	</div>
	
	<div style="width:655px;float:left;margin:-25px 14px 10px 14px;background-color:white;padding-top:35px;padding-bottom:35px;box-shadow:#666 0px 0px 25px;border-radius:5px">
		<?php include("controllers/department_list.php"); ?>
		<form name="department" action="controllers/change_department.php" method="post" style="width:380px;margin:auto">
			<table>
				<tr>
					<td>
						<input type="hidden" name="page" value="register_step3.php">
						<?php include('views/department_select.php'); ?>
						<input type="submit" value="Join">
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
