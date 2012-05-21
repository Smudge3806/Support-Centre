<?php
	include('controllers/is_logged_in.php');
	$user = $_SESSION['username'];
	$uid = $_SESSION['uid'];
	if($_SESSION['account'] == 'user')
	{
		header('location: profile.php');
	}

?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>LTU Support Centre</title>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="metro.css">
<link rel="stylesheet" href="about.css">
<link rel="stylesheet" href="pie.css">
<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="admin_table.css">
<link rel="stylesheet" href="message_boxes.css">
<link rel="stylesheet" href="icons.css">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico" >
<script type="text/javascript" src="admin.js"></script>
<script type="text/javascript" src="adminMoodleControl.js"></script>
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
			<li id="active"><a rel="your" onclick="switchTab(this)">Your Reports</a></li>
			<li><a rel="all" onclick="switchTab(this)">All Reports</a></li>
			<li><a rel="training" onclick="switchTab(this)">Training Requests</a></li>
			<li><a rel="messages" onclick="switchTab(this)">Your Messages</a></li>
			<li><a rel="moodle" onclick="switchTab(this)">Moodle</a></li>
			<li><a rel="administration" onclick="switchTab(this)">Administration</a></li>
			<li><a rel="equipment" onclick="switchTab(this)">Equipment</a></li>
		</ul>
	</div>
	<div id="content">
		<div id="your" style="display:block">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">Your Reports</h2>
				</div>
			</div>
			<div class="content">
				<?php include('views/admin_support_requests.php'); ?>
			</div>
		</div>
		
		<div id="all">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">All Reports</h2>
				</div>
			</div>
			<div class="content">
				<div id="controls">
					<?php include('views/admin_reports_list.php'); ?>
				</div>
				<div id="report">
				
				</div>
				<div id="allReport" style="display:none">
					<?php 
						include('views/admin_all_support_requests.php');
					?>
					<div id="ClosedReport">
						<?php include('views/admin_closed_reports.php'); ?>
					</div>
				</div>
			</div>
		</div>
		
		<div id="training">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">Training Events</h2>
				</div>
			</div>
			<div class="content">
				<div id="adminList">
					<?php include('views/admin_training_list.php'); ?>		
				</div>
				<div id="events">
					<?php include('views/admin_training_requests.php'); ?>
				</div>
				<div id="event">
					
				</div>
			</div> <!-- Missing Div Somewhere?? -->
			</div>
		</div>
		
		<div id="messages">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">Your Messages</h2>
				</div>
			</div>
			<div class="content">
				<?php include('views/message_box.php'); ?>
			</div>
		</div>
		
		<div id="moodle">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">Moodle Pages</h2>
				</div>
			</div>
			<div class="content">
				<?php include('views/admin_moodle_list.php'); ?>
			</div>
		</div>
		
		<div id="administration">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
					<h2 id="title">Administration Panel</h2>
				</div>
			</div>
			<div class="content">
				<div id="adminDisplay">
					
				</div>
				<div id="adminDisplays">
					<div id="userDisplay">
						<?php include('views/admin_admin_users.php'); ?>
					</div>
				</div>
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