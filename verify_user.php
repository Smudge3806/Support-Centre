<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<title>Account Registration: Step 2</title>
<style type="text/css">
	.profile-block{
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	float:left;
	clear:left;
}
	#user-avatar{
	 float:left; 
	 width:75px;
}
	#profile-department
	{
	color:silver;
	text-decoration:none
}
	#user-name{
	margin:0px;
	padding:0px;
	text-decoration:none;
	color:black
}
#user_details{
	float:left;
	padding: 0px 10px 0px 10px;
	margin-top:20px;
}
.user-status{
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	float:right;
	clear:right;
}
.container{
	padding: 10px;
	margin-bottom:10px;
}
.user-training{
	float:left;
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	margin-bottom:10px;
}
#title{
	text-align:center;
	margin:0px;
}
.skills_audit{
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	float:left;
	clear:left;
	margin-bottom:10px;

}

.moodle-audit{
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	float:left;
	clear:left;
	margin-bottom:10px;
}
.ltu-reports{
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	float:left;
	clear:left;
	margin-bottom:10px;
}
.wrapper{
	width:800px;
	margin:auto;
	background: #fff url(img/wrapper.gif) top center repeat-y;
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}
.message
{
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	color:red;
	padding:0px
}
.notice{
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	background-color:InfoBackground;
	font-weight:bold;
	float:left;
	clear:right;
	margin-bottom:10px;
}
#navigation
{
	margin-top:0px;
	background: url(img/navigation.gif) repeat-x;
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}
	#navigation li {
		/*float: right;*/
		text-align: right;
		padding: 20px 10px 23px;
		list-style: none;
		color: #9A76B6;
	}
		#navigation li a {
			color: #fff;
			font-weight:normal;
		    text-decoration:none;
		}
		#navigation li a.current,
		#navigation li a:hover {
			text-decoration: none;
			background-color:#9269AF
		}
	
</style>

</head>
<?php include('controllers/dbconnection.php'); ?>
<body class="wrapper">
	<?php include('views/navigation.php'); ?>
	<header>
		<h1 style="font-weight:normal">Welcome back!</h1>
		<p>Please the time to work through the next few steps to set your account up.</p>
		<hr>
	</header>
	<?php
		$step = 1;
		switch ($step)
		{
			case 1:
	?>
				<article>
					<form name="step-1" action="verify_user.php" method="post">
						<fieldset>
							<table style="width:400px;margin:auto">
								<tr>
									<td style="text-align:center">Please select your department from the list</td>
								</tr>
								<tr>
									<td style="text-align:center">
										<select name="department">
											<option>Select a Department...</option>
										</select>
									</td>
								</tr>
								<tr>
									<td style="float:right"><input type="submit" value="Submit"></td>
								</tr>
							</table>
						</fieldset>
						
					</form>	
				</article>
	
	<?php 
			break;
	?>
	<?php 
		} // End of Switch
	?>
		<?php
		include('views/page_footer.php');
	?>

</body>

</html>
