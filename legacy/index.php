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
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/pie.css">

<style type="text/css">

.wrapper{
	width:800px;
	margin:auto;
	/*margin-top:35px;*/
	/*background: #fff url(img/wrapper.gif) top center repeat-y;*/
	background: white url('http://www.barnsley-ltu.co.uk/img/background_image.jpg') no-repeat scroll 50% 10px;
}

.message
{
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	color:red;
	padding:0px;
}

.note{
	font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
	background-color:InfoBackground;
	font-weight:bold;
	float:left;
	clear:both;
	margin-bottom:10px;
	border:thin black solid;
	padding:10px;
}

</style>

<link rel="stylesheet" href="styles/metro.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/tabs.css">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico" >
<script src="http://www.barnsley-ltu.co.uk/scripts/tabs.js" type="text/javascript"></script>

<title>LTU Support Centre</title>

</head>


<body class="wrapper" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
	<?php
		if(isset($_GET['m']))
		{
			?>
				<div class="notice">
					<p style="float:left"><?php echo $_GET['m']; ?></p>
					<a href="index.php" title="Clear" id="clear">     </a>
				</div>
			<?php
		}
	?>

	<?php include('views/page_header.php'); ?>
	<div class="metro">
		<?php include('views/metro_navigation.php'); ?>
	</div>

	<div class="note">
		<p style="display:inline"><b style="font-weight:900;font-size:large">!</b> Please note that this service is still in beta and missing some of its features.</p>
	</div>
	<br style="clear:left">
	<hr>

	<article id="reports">
		<div style="width:790px;margin:auto;">
				<ul id="menutabs" class="shadetabs">	
					<li><a href="#" rel="menu1">Your Reports</a></li>
					<li><a href="#" rel="menu2">All Reports</a></li>
					<li><a href="#" rel="menu3">Training Requests</a></li>
					<li><a href="#" rel="menu4">Your Messages</a></li>
					<li><a href="#" rel="menu5">Moodle</a></li>
					<li><a href="#" rel="menu6">Administration</a></li>
					<li><a href="#" rel="menu7">Tests</a></li>
				</ul>
		<div style="border:1px solid gray; width:780px; margin:auto; margin-bottom: 1em; padding: 10px; background-color:white">
			<div id="menu1" class="tabcontent">
				<?php include('views/admin_support_requests.php'); ?>
			</div>
			
			<div id="menu2" class="tabcontent">
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

			<div id="menu3" class="tabcontent">
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

			<div id="menu4" class="tabcontent">
				<?php include('views/admin_messages.php'); ?>
			</div>

			<div id="menu5" class="tabcontent">
				<?php include('views/admin_moodle_list.php'); ?>
			</div>

			<div id="menu6" class="tabcontent">
				<ul class="shadetabs" id="admin_tabs">
					<li><a href="#" rel="users">Users</a></li>
					<li><a href="#" rel="departments">Departments</a></li>	
					<li><a href="#" rel="skills">Skills Developments</a></li>
					<li><a href="#" rel="course">Course Audits</a></li>			
				</ul>
					<div style="border:1px solid gray; margin-bottom: 1em; padding: 10px">
						<div id="users" class="tabcontent">
							<?php include('views/admin_admin_users.php'); ?>
						</div>

						<div id="departments" class="tabcontent">
							<p>Add Departments</p>
							<p>Edit Departments</p>
							<p>Delete Departments</p>
							<p>Assign Users</p>
							<p>Assign Support Officers</p>
						</div>

						<div id="skills" class="tabcontent">
							<p>Add a Development Skill</p>
							<p>Edit Developments</p>
							<p>Delete Developments</p>
							<p>Release Development</p>
						</div>

						<div id="course" class="tabcontent">
							<p>Add a Moodle Course</p>
							<p>Delete a Course</p>
							<p>Begin Audit</p>
							<p>Edit Audit</p>
						</div>
					</div>

				<script type="text/javascript">
					var menus=new ddtabcontent("admin_tabs")
					menus.setpersist(true)
					menus.setselectedClassTarget("link") //"link" or "linkparent"
					menus.init()
				</script>
			</div>

			<div id="menu7" class="tabcontent">
				<p>Hi Everyone,<br> If you could all work through the tests that are on here to a) help me develop and iron out any bugs, and b) familarise yourself with the functionality of the system and how to do things. <br><br>Cheers, <br><br>Chris. </p>	
				<a href="tests/messaging.php" title="Messaging Test Frame">Messaging Test Case</a>
			</div>		

		</div>

		<script type="text/javascript">
			var menus=new ddtabcontent("menutabs")
			menus.setpersist(true)
			menus.setselectedClassTarget("link") //"link" or "linkparent"
			menus.init()
		</script>
		</div>
	</article>

</body>

</html>

