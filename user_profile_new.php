<?php
	include('controllers/is_logged_in.php');
	$user = $_SESSION['username'];
	$uid = $_SESSION['uid'];
	if($_SESSION['account'] == 'user')
	{
		header('location: profile.php');
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
<title>LTU Support Centre</title>
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/admin.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/admin_table.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/message_boxes.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/icons.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/user_profile.css">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico" >
<script type="text/javascript" src="https://www.barnsley-ltu.co.uk/scripts/admin.js"></script>
<script type="text/javascript" src="https://www.barnsley-ltu.co.uk/scripts/adminMoodleControl.js"></script>
<?php
	include('scripts/import_fancybox.php');
?>
<?php 
		if(isset($_GET['m']))
		{
			?>
<script type="text/javascript">
	$(document).ready(function()
	{
		$("a#hidden_link").fancybox().trigger('click');
	});
</script>
<?php
	}
?>
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#hidden_link").fancybox({});
	});
</script>

<script type="text/javascript">
	
	var targetTrainingElem = "event";

	function showTraining(link)
	{
		try
		{
			var old = document.getElementById("activeSO");
			if(old.rel != link.rel)
			{
				old.removeAttribute("id");
				link.setAttribute("id", "activeSO");	
			}
		}
		catch(err1)
		{
			// first selection
			try
			{
				link.setAttribute("id", "activeSO");
			}
			catch(err2)
			{
				// Do nothing!
			}
		}
		
		
		var target = document.getElementById(targetTrainingElem);
		var content = document.getElementById(link.rel);
		target.innerHTML = content.innerHTML;
	}
	
	
	var targetReportingElem = "report";
	
	function showReports(link)
	{
		try
		{
			var old = document.getElementById("activeSOR");
			if(old.rel != link.rel)
			{
				old.removeAttribute("id");
				link.setAttribute("id", "activeSOR");
			}		
		}
		catch(err1)
		{
			try
			{
				link.setAttribute("id", "activeSOR");
			}
			catch(err2)
			{
				// Do nothing!
			}		
		}
		
		var target = document.getElementById(targetReportingElem);
		var content = document.getElementById(link.rel);
		target.innerHTML = content.innerHTML;	
	}
</script>

</head>

<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div id="left_navigation">
		<ul>
			<li id="user"><?php echo $user->username; ?></li>
			<li id="active"><a rel="admin" onclick="switchTab(this)">User Settings</a></li>
			<li><a rel="support" onclick="switchTab(this)">Support Requests</a></li>
			<li><a rel="training" onclick="switchTab(this)">Training Events</a></li>
			<li><a rel="messages" onclick="switchTab(this)">Message Board</a></li>
		</ul>
	</div>
	<div id="content">
		<div id="admin" style="display:block">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">User Settings</h2>
				</div>
			</div>
			<div class="content">
				<?php include('views/user_profile.php'); include('views/user_functions.php'); ?>
			</div>
		</div>
		<div id="support">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">Support Requests</h2>
				</div>
			</div>
			<div class="content">
				<?php include('views/user_support.php'); ?>
			</div>
		</div>
		
		<div id="training">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">Training Events</h2>
				</div>
			</div>
			<div class="content">
				<div id="events">
					<?php include('views/user_events.php'); ?>
				</div>
				<div id="event">
					
				</div>
			
			</div>
		</div>
		
		<div id="messages">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">Your Messages</h2>
				</div>
			</div>
			<div class="content">
				<?php include('views/user_messages.php'); ?>
			</div>
		</div>
							
	</div>
	<a href="#error" id="hidden_link" style="display:none">Message</a>
	<div id="message_box">
		<div id="error">
			<p><?php echo $_GET['m']; ?></p>
		</div>
	</div>

</body>

</html>