<?php
	include('controllers/is_logged_in.php');
	if(isset($_GET['cat']))
	{
		$cat = $_GET['cat'];
	}
	else
	{
			$cat = "general";
	}
	if(!isset($_GET['user']))
	{
		$uid = $_SESSION['uid'];
	}
	else
	{
		$uid = $_GET['user'];
	}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.jpg" >
<title>Submit a Support Request</title>
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript">
		!window.jQuery && document.write('<script src="scripts/fancybox/fancybox/jquery-1.4.3.min.js"><\/script>');
	</script>
	<script type="text/javascript" src="https://www.barnsley-ltu.co.uk/scripts/fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="https://www.barnsley-ltu.co.uk/scripts/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="https://www.barnsley-ltu.co.uk/scripts/fancybox/fancybox/jquery.fancybox-1.3.4.css" media="screen" >
<script type="text/javascript">
	$(document).ready(function(){
		$("#various1").fancybox({
		
		
			});
	});
	
	function add_data(value, id)
	{
		$.fancybox.close();
		document.getElementById('various1').innerHTML = value;
		if(!document.getElementById('course'))
		{
			var newElem = document.createElement('div');
			newElem.innerHTML = "<input type='hidden' name='course' id='course' value='"+id+"'>";
			document.getElementById('moodle').appendChild(newElem);
		}
		else
		{
			document.getElementById('course').value = id;
		}
				
	}	
</script>
</head>
<?php include('controllers/dbconnection.php'); ?>
<body class="wrapper">
<div>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
</div>

<div class="description" style="margin-top:25px;float:left">
	<div class="inner" style="box-shadow:#666 0px 0px 25px;opacity:0.99">
		<h2 id="title">Submit a Support Request</h2>
		<p id="inner_description">Use this area to submit a support request. To start, simply select a category that best fits your problem.</p>
	</div>
</div>

		<article style="float: left;clear: right;margin-bottom: 25px;">
			<div style="margin-bottom:10px;background-color:white;box-shadow:#666 0px 0px 25px;border-radius:5px;padding:10px;float:left;margin-left:14px;margin-top: -15px;width:634px;">
			<p>If your problem doesn't fit any of the categories listed, choose "General" or "Other" if you need more flexibility.</p>
			<table>
				<tr>
					<td>Category:</td>
					<td><select name="category" onchange="window.location = this.options[this.selectedIndex].value">
						<?php $categories = $mysqli->query('SELECT * FROM report_categories GROUP BY cid ASC'); while($category = $categories->fetch_object()){?>
						<?php if(isset($cat) && $cat == $category->value){ ?>
						<option value="http://<?php echo $_SERVER['SERVER_NAME']; ?>/support/new/<?php echo $category->value; ?>/<?php echo $_SESSION['uid']; ?>" selected="selected" ><?php echo $category->name; ?></option>
						<?php }else{ ?>
							<option value="http://<?php echo $_SERVER['SERVER_NAME']; ?>/support/new/<?php echo $category->value; ?>/<?php echo $_SESSION['uid']; ?>"><?php echo $category->name; ?></option>
						<?php } ?>
						<?php } ?>
					</select></td>
				</tr>			
			</table>
		</div>
		</article>
		<div class="side">
							<div class="inner_side" style="box-shadow: #666 0px 0px 25px;opacity: .99">
							
							
		<?php
			switch($cat)
			{
				case "moodle":
					?>
						<p>Moodle</p>
					<?php
					break;
				case "promethean":
					?>							
						<p>Promethean</p>
					<?php
					break;
				case "general":
					?>							
						<p>General</p>
					<?php
					break;
			}
		?>
			</div>
		</div>
		<article>
			<div style="border-radius:5px;margin-bottom:10px;background-color:white;box-shadow:#666 0px 0px 25px;padding:10px;float:left;margin-left:14px;width:634px;padding-top:95px;margin-top: -95px">
			
			
		<?php
			switch($cat)
			{
				case "moodle":
			?>
			
		<form id="moodle" name="moodle" method="post" action="https://www.barnsley-ltu.co.uk/controllers/submit_report.php">
			<table>
				<tr>
					<td valign="top">Description:</td>
					<td><textarea name="summary" maxlength="500" rows="6" cols="20" placeholder="Description of the Problem" required></textarea></td>
				</tr>
				<tr>
					<td valign="top">Further Information:</td>
					<td><textarea name="note" maxlength="500" rows="6" cols="20" placeholder="Any Further Information that you think will help" required></textarea></td>
				</tr>
				
				<tr>
					<td>Course Page:</td>
					<td><a href="#add_course" id="various1">Click here to add a course</a></td>
				</tr>
				<?php if(isset($_GET['add'])){ ?>
					<tr>
						<td>User:</td>
						<?php 
							if(isset($_GET['user']))
							{
						?>
						<td>
							<p><?php require_once('models/user.php'); $selected_user = new User($_GET['user']); echo $selected_user->username; ?></p><input type="hidden" value="<?php echo $selected_user->id; ?>" name="user">						
						</td>
						<?php } ?>
					</tr>
				<?php } ?>
				<tr>
					<td><input type="hidden" name="user" value="<?php echo $uid; ?>"><input type="hidden" name="cat" value="Moodle"></td>
					<td><input type="submit" value="Submit Report"></td>
				</tr>
			</table>
		</form>
		
			<?php
					break;
				case "promethean":
				?>
				
					<form name="promethean" method="post" action="https://www.barnsley-ltu.co.uk/controllers/submit_report.php">
								<table>
									<tr>
										<td>Product:</td>
										<td><select name="applications"><?php $apps = $mysqli->query('SELECT * FROM promethean_tech'); while($app = $apps->fetch_object()){ ?><option value="<?php echo $app->value; ?>"><?php echo $app->name; ?></option><?php } ?></select></td>
									</tr>
									<tr>
										<td>Software:</td>
										<td><select name="software"><option value="installed">Installed</option><option value="Not Installed">Not Installed</option><option value="not sure">Not Sure</option></select></td>
									</tr>
									<tr>
										<td valign="top">Description:</td>
										<td><textarea name="description" cols="20" rows="6" maxlength="500" placeholder="Description of the Problem" required></textarea></td>
									</tr>
									<tr>
										<td valign="top">Further Information:</td>
										<td><textarea name="further" maxlength="500" rows="6" cols="20" placeholder="Any Further Information that you think will help" required></textarea></td>
									</tr>
									<?php if(isset($_GET['add'])){ ?>
										<tr>
											<td>User:</td>
											<?php 
												if(isset($_GET['user']))
												{
											?>
											<td>
												<p><?php require_once('models/user.php'); $selected_user = new User($_GET['user']); echo $selected_user->username; ?></p><input type="hidden" value="<?php echo $selected_user->id; ?>" name="user">						
											</td>
											<?php } ?>
										</tr>
									<?php } ?>

									<tr>
										<td><input type="hidden" name="user_id" value="<?php echo $uid; ?>"><input type="hidden" name="cat" value="Promethean"></td>
										<td><input type="submit" value="Submit Report"></td>
									</tr>
								</table>
						
					</form>
					
			<?php
					break;
					case "general":	
				?>
					
						<form name="general" method="post" action="https://www.barnsley-ltu.co.uk/controllers/submit_report.php">
							<table>
								<tr>
									<td>Nature of the Problem:</td>
									<td><select name="nature">
										<option value="generic">Generic</option>
										<option value="hardware">Hardware</option>
										<option value="software">Software</option>
										<option value="elearning">eLearning</option>
										<option value=""></option>
									</select></td>	
								</tr>
								
								<tr>
									<td valign="top">Describe the Problem:</td>
									<td><textarea name="description" rows="10" cols="40" maxlength="500" placeholder="Description of the Problem" required></textarea></td>
								</tr>
								<tr>
									<td valign="top">Further Information:</td>
									<td><textarea name="further" maxlength="500" rows="6" cols="20" placeholder="Any Further Information that you think will help" required></textarea></td>
								</tr>
								<?php if(isset($_GET['add'])){ ?>
									<tr>
										<td>User:</td>
										<?php 
												if(isset($_GET['user']))
												{
											?>
											<td>
												<p><?php require_once('models/user.php'); $selected_user = new User($_GET['user']); echo $selected_user->username; ?></p><input type="hidden" value="<?php echo $selected_user->id; ?>" name="user">						
											</td>
											<?php } ?>
									</tr>
								<?php } ?>

								<tr>
									<td><input type="hidden" name="user_id" value="<?php echo $uid; ?>"><input type="hidden" name="cat" value="General"></td>
									<td><input type="submit" value="Submit Report"></td>
								</tr>
							</table>
							
						</form>
					
				<?php
				break;
				}
			?>
			</div>
		</article>
		<?php
		include('views/page_footer.php');
	?>
<div style="display:none">
<div id="add_course">
<?php
	include('views/page_header.php');
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
		require_once('models/user.php');
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
			include('controllers/dbconnection.php');
			$result = $mysqli->query('SELECT * FROM moodle_pages WHERE department_id ='.$user->department);
			if($result->num_rows != 0)
			{
		?>
		<div id="target">
		<select onchange="add_data(this.options[this.selectedIndex].innerHTML, this.options[this.selectedIndex].value)">
		<?php
			require_once('models/moodle.php');
			echo "<option value='null'>Select a Course...</option>";
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

</div>
</div>
</body>

</html>
