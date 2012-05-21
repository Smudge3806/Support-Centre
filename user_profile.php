<?php
	include('controllers/is_logged_in.php');
	if($_SESSION['account'] != "admin")
	{
		header('location: http://www.barnsley-ltu.co.uk/user');
	}
	include('controllers/dbconnection.php');
	require_once('models/user.php');
	if(isset($_GET['id']))
	{
		$user = new User($_GET['id'], true, true);
	}
	else
	{
		$user = new User($_SESSION['uid'], true, true);
	}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>User Info - <?php echo $user->username; ?></title>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="metro.css">
<link rel="stylesheet" href="pie.css">
<link rel="stylesheet" href="about.css">
<link rel="stylesheet" href="icons.css">
<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/user_profile.css">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico">
<script type="text/javascript" src="admin.js"></script>
</head>

<body style="width:1250px">
<?php
		if(isset($_GET['m']))
		{
			?>
				<div class="notice">
					<p style="float:left;margin-top:1em;margin-bottom:1em;"><?php echo $_GET['m']; ?></p>
					<a href="http://www.barnsley-ltu.co.uk/user/<?php echo $user->id; ?>/admin" title="Clear" id="clear">     </a>
				</div>
			<?php
		}
	?>

	<?php
		include('views/page_header.php');
	?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	
	<div class="description">
			<div class="inner">
				<h2 id="title"><?php echo $user->username; ?>'s User Profile</h2>
			</div>
	</div>
	<div id="left-navigation">
			<ul>
				<li id="active"><a rel="support" onclick="switchTab(this)">Support Requests</a></li>
				<li><a rel="training" onclick="switchTab(this)">Training Requests</a></li>
				<li><a rel="messages" onclick="switchTab(this)">Messages</a></li>
				<li><a rel="equipment" onclick="switchTab(this)">Equipment</a></li>
				<li><a rel="moodle" onclick="switchTab(this)">Moodle Courses</a></li>
			</ul>
		</div>
	<div id="content">
		<div>
			<?php include('views/user_profile.php'); ?>
			<?php include('views/user_functions.php'); ?>
			<?php include('views/user_support.php'); ?>
			<?php include('views/user_events.php'); ?>
			<?php include('views/user_messages.php'); ?>
		</div>
	</div>
</body>

</html>
