<?php 
	include('controllers/is_logged_in.php');
	include('controllers/dbconnection.php');
	require_once('models/user.php');
	if(isset($_GET['id']))
	{
		$uid = $_GET['id'];
		$isUser = false;
		if($_SESSION['account'] == "admin")
		{
			$isAdmin = true;
		}
		$new_user = new User($uid, true, true);	
	}
	else
	{
		$uid = $_SESSION['uid'];
		$isUser = true;
		$username = $_SESSION['username'];
		$new_user = new User($uid, true, true);	
	}
	$result = $mysqli->query('SELECT * FROM users WHERE uid ='.$uid);
	$user = $result->fetch_object();
	if($result->num_rows == 0)
	{
		header('location: error.php?m=This user does not exist');
	}
	?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
<script src="http://bxslider.com/sites/default/files/jquery.bxSlider.min.js" type="text/javascript"></script>
<script type="text/javascript">
// Support Request Slider
 $(function(){
  $('#slider1').bxSlider({
    auto: true, controls: false, speed: 2000, pause: 5000
  });
});	
// Training Request Slider
$(function(){
  $('#slider2').bxSlider({
    auto: true, controls: false, speed: 2000, pause: 5000
  });
});
// Skills Development Slider
$(function(){
  $('#slider3').bxSlider({
    auto: true, controls: false, speed: 2000, pause: 5000
  });
});
// Course Review Slider
$(function(){
  $('#slider4').bxSlider({
    auto: true, controls: false, speed: 2000, pause: 5000
  });
});
</script>
<title><?php echo $new_user->username; ?>'s Profile</title>
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico" >	
</head>

<body>
	<?php
		if(isset($_GET['m']))
		{
			?>
				<div class="notice">
					<p style="float:left"><?php echo $_GET['m']; ?></p>
					<a href="https://www.barnsley-ltu.co.uk/user/<?php if(isset($_GET['id'])){ echo $_GET['id']; }?>" title="Clear" id="clear">     </a>
				</div>
			<?php
		}
	?>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div>
		<?php include('views/new_profile_badge.php'); ?>
		<br/>
			</div>
			<?php
				if($isUser || $isAdmin)
				{
			?>
	<div id="skills" style="clear:both;float:left">
		<div class="topic-headers">
			<h2 class="title">Support and Training</h2>
			<p class="subtitle">Click on the links below to access information 
			about your ILT support &amp; training.</p>
		</div>
		
		<div class="metro">
			<?php
				 include('views/metro_support.php'); 
				 include('views/metro_training.php');	 
			?>
		</div>
	</div>
	<?php
		}
	?>
		<?php
		include('views/page_footer.php');
	?>

</body>

</html>
