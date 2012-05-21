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
<title>Planning Page - Index</title>
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/admin.css">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico" >
<script type="text/javascript" src="http://www.barnsley-ltu.co.uk/scripts/admin.js"></script>
<?php
	include('scripts/import_fancybox.php');
?>
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
			<li><a rel="admin" onclick="switchTab(this)">Administration</a></li>
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
				<?php 
					if($uid == 1)
					{
						// Requires Attention
						include('views/admin_all_support_requests.php');
					}
					else
					{
				?>
				<b>Coming Soon!</b>
				<?php
					}
				?>
			</div>
		</div>
		
		<div id="training">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">Training Events</h2>
				</div>
			</div>
			<div class="content">
				<?php include('views/admin_training_requests.php'); ?>
				<form method="post" action="index.php" style="margin:20px">
					<select name="training_officer">
						<option value="0">Officers</option>
						<?php $officers = $mysqli->query('SELECT uid, CONCAT(`first_name`," ",`last_name`) AS name FROM get_support_officers GROUP BY uid'); while($officer = $officers->fetch_object()){?>
						<option value="<?php echo $officer->uid; ?>"><?php echo $officer->name; ?></option><?php }?>
					</select>
					<?php if($_POST['training_officer'] != 0){ require_once('models/user.php'); $temp_user = new User($_POST['training_officer']); echo "<p>Currently: ".$temp_user->username; }?>
					<input type="submit" value="Show" >
				</form>
			</div>
		</div>
		
		<div id="messages">
			<div class="description">
				<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;">
					<h2 id="title">Your Messages</h2>
				</div>
			</div>
			<div class="content">
				<?php include('views/admin_messages.php'); ?>
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
		
	</div>
</body>

</html>
