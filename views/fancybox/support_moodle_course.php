<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Support Centre</title>
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/pie.css">
<script type="text/javascript">
	function add_data(value)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById('target').innerHTML = "<p>Data Saved</p>";
			}
		}
		xmlhttp.open('GET', 'http://www.barnsley-ltu.co.uk/controllers/support_moodle_course.php?id='+value, true);
		xmlhttp.send();
	}
</script>
</head>

<body>
<?php
	include('../page_header.php');
?>
<div class="description" style="margin-top:25px">
	<div class="inner" style="opacity:0.99">
		<h2 id="title">
			Select a Moodle Course
		</h2>
	</div>
</div>
<div style="background-color:white; border-radius:5px; box-shadow: #666 0px 0px 25px; width:637px; padding:10px; padding-top:30px; margin:-45px 14px 25px 14px; float:left;clear:both">
	<?php 
		session_start();
		require_once('../../models/user.php');
		if(isset($_GET['user']))
		{
			$user_id = $_GET['user'];
		}
		else
		{
			$user_ud = $_SESSION['uid'];
		}
		$user = new User($user_id);
		unset($user_id);
		?>
		<p>Courses for <?php echo $user->username; ?>.</p>
		<?php
			include('dbconnection.php');
			$result = $mysqli->query('SELECT * FROM moodle_assignments WHERE user_id ='.$user->id);
			if($result->num_rows != 0)
			{
		?>
		<div id="target">
		<select onchange="add_data(this.options[this.selectedIndex].value)">
		<?php
			require_once('../../models/moodle.php');
			echo "<option>Select a Course...</option>";
			while($raw = $result->fetch_object())
			{
				$course = new MoodleCourse($raw->page_id);
				?>
				<option value="<?php echo $course->id ?>"><?php echo $course->course_code; ?> - <?php echo $course->moodle_title; ?></option>
				<?php
			}
		?>
		</select>
		</div>
		<?php
		}
		?>
</div>
</body>

</html>
