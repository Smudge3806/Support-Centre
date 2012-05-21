<?php
	include('controllers/dbconnection.php');
	include('controllers/is_logged_in.php');
	$value = "New Moodle Page";
	$page = $_SESSION['page'];
	if(!isset($_SESSION['page']))
	{
		if($_SESSION['account'] == "admin")
		{
			$page = "index.php";
		}
		else
		{
			$page = "profile.php";
		}
	}
	unset($_SESSION['page']);
	if(isset($_GET['func']))
	{
		$func = $_GET['func'];
		switch($func)
		{
			case "join":
				$value = "Enrol onto a Moodle Page";
				break;
			
			case "view":
				if(!isset($_GET['id']))
				{
					header('location: ../'.$page.'?m=Missing Course ID');
				}
				$value = "View Moodle Page";
				require_once('models/moodle.php');
				$course = new MoodleCourse($_GET['id'], true, true);
				break; 
		}
	}
	DEFINE("TITLE", $value, true);
?>
<!DOCTYPE html>
<html>

<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title><?php echo TITLE; ?> - Support Centre</title>
	<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
	<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
	<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
	<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/pie.css">
	<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico">
	<style type="text/css">
		tr:nth-child(even) {background-color: #9CF;}
	</style>
</head>

<body>
	<?php
		include('views/page_header.php');
	?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div id="content" style="clear:both;float:left;margin-top:25px">
		<div class="description">
			<div class="inner" style="box-shadow:#666 0px 0px 25px;opacity:0.99">
				<h2 id="title"><?php echo TITLE; ?></h2>
			</div>
		</div>
		<div style="margin:-25px 14px 10px 14px;background-color:white;box-shadow:#666 0px 0px 25px;padding:10px;clear:both;float:left;width:634px;padding-top:35px">
			<?php switch($_GET['func']) { case "view": ?>
			<table>
				<tr>
					<td><label>Moodle Title:</label></td>
					<td><?php echo $course->moodle_title; ?></td>
				</tr>
				<tr>
					<td><label>Actual Title:</label></td>
					<td>(<?php echo $course->course_code; ?>) <?php echo $course->course_title; ?></td>
				</tr>
				<tr>
					<td><label>Department:</label></td>
					<td><?php echo $course->department->name; ?></td>
				</tr>
				<tr>
					<td><label>Number of Enrolments:</label></td>
					<td><?php echo count($course->enrolments); ?></td>
				</tr>
				<tr>
					<td colspan="2"><a href="<?php echo $course->url; ?>" target="_blank" title="Click here to see <?php echo $course->moodle_title; ?>">Click here to see this course</a></td>
				</tr>
			</table>
			<?php break; case "join": ?>
				<?php 
					require_once('models/user.php');
					if(isset($_GET['id']))
					{
						$uid = $_GET['id'];
					}
					else
					{
						$uid = $_SESSION['uid'];
					}
					$user = new User($uid);
					$result = $mysqli->query('SELECT * FROM moodle_pages WHERE department_id ='.$user->department);
					if($result->num_rows == 0)
					{
						?>
							<b>There are no Course Pages Registered for your department.</b>
						<?php
					}
					else
					{
						?>
							<div id="join" style="margin-left:25px">
							<h2>Enroll onto a Course...</h2>
							<form method="post" action="controllers/moodle_enroll_join.php">
								<select name="page" required>
									<option>Select a Course...</option>
									<?php
										while($raw = $result->fetch_object())
										{
									?>
									<option value="<?php echo $raw->course_code; ?>"><?php echo $raw->moodle_title; ?></option>
									<?php
										}
									?>
								</select>
								<input type="hidden" value="<?php echo $_GET['id']; ?>" name="user_id">
								<select name="role">
									<option value="Tutorial Learning Mentor">TLM</option>
									<option value="Teacher">Teacher</option>
									<?php if($_SESSION['account'] == "admin"){ ?>
									<option value="Course Leader">Course Leader</option>
									<?php } ?>
								</select>
								<input type="submit" value="Enrol">
							</form>
							</div>
						<?php
					}
				?>
			<?php break; } if(!isset($_GET['func'])) { ?>
				<b>Moodle Courses can not be added at the moment.<br><br> If yours is missing, contact LTU.</b>				
				
			<?php } ?>
		</div>
		<?php if(isset($_GET['func']) && $_GET['func'] == "view"){ ?>
		<div class="side">
			<div class="inner_side" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
				<p>Enrolments</p>
			</div>
		</div>
		<div style="margin:-50px 14px 10px 14px;background-color:white;box-shadow:#666 0px 0px 25px;padding:10px;clear:both;float:left;width:634px;padding-top:50px">
			<?php if($course->enrolments != "There are no enrolments for this course."){ ?>
			<table style="max-height:800px;overflow:scroll">
				<tr>
					<th>Username</th>
					<th>Role</th>
					<?php if($_SESSION['account'] == "admin"){ ?>
					<th>Function</th>
					<?php } ?>
				</tr>
				
					<?php $x = 0; while($x != count($course->enrolments)){ $enrolment = $course->enrolments[$x];?>
				<tr>
					<td><a href="http://www.barnsley-ltu.co.uk/users/<?php echo $enrolment['user']->id; if($_SESSION['account'] == "admin"){ echo "/admin"; }else{ echo "/"; } ?>" title="See <?php echo $enrolment['user']->username;?>'s profile here"><?php echo $enrolment['user']->username; ?></a></td>
					<td><?php echo $enrolment['role']; ?></td>
					<?php if($_SESSION['account'] == "admin" && $enrolment['role'] != "Support Officer"){ ?>
					<td><a href="http://www.barnsley-ltu.co.uk/controllers/moodle_enrol_delete.php?id=<?php echo $enrolment['user']->id; ?>&course=<?php echo $_GET['id']; ?>" title="Unenrol this User">Delete</a></td>
					<?php } ?>					
				</tr>
					<?php $x++; }?>
			</table>
			<?php }else{ ?>
			<b><?php echo $course->enrolments; ?></b>
			<?php } ?>
		</div>
		<?php } ?>		
	</div>
</body>

</html>
