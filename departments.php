<?php
	include('controllers/is_logged_in.php');
	include('controllers/dbconnection.php');
	if(isset($_GET['id']))
	{
		$depart_id = $_GET['id'];
		$result = $mysqli->query('SELECT * FROM departments WHERE did ='.$depart_id);
		$department = $result->fetch_object();
		$users = $mysqli->query('SELECT * FROM users WHERE department_id ='.$depart_id);
		require_once('models/department.php');
		$department = new Department($department->did, true);
	}
	else
	{
		header('location: profile.php?m=Oops, Theres been a problem');
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
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/notes.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/icons.css">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico" type="image/x-cut">
<script type="text/javascript">
	function counter(thisfield)
	{
		$count = thisfield.value.length;
		$left = 500 - $count;
		document.getElementById('count').value = $left;		
	}
</script>


<style type="text/css">
	.content
	{
		background-color:white;
		border-radius:5px;
		box-shadow:#666 0px 0px 25px;
		padding:10px;
		padding-top:55px;
		margin:14px;
		margin-top:-45px;
		float:left;
		width:637px;
	}
	.inner_side
	{
		opacity:0.99;
		box-shadow:#666 0px 0px 25px;
}

	table
	{
	border-collapse:collapse;
}
	#user_list tbody tr:nth-child(even)
	{
		background-color:#91d685;
}
</style>

<title><?php echo $department->name; ?></title>	

</head>

<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div class="description">
		<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
			<h2 id="title"><?php echo $department->name; ?> Department Page</h2>
			<p id="inner_description">More Coming Soon</p>
		</div>
	</div>
	
	<div id="main">
		<div class="content">
			<table>
				<tr>
					<td><label>Support Officer:</label></td>
					<td><?php require_once('models/user_link.php'); $link = new User_Link($department->support_officer); echo $link->output; ?></td>
				</tr>
				<tr>
					<td><label>Location:</label></td>
					<td><?php echo $department->location; ?></td>
				</tr>
			</table>
		</div>
		<div class="side">
			<div class="inner_side">
				<p>Collegues</p>
			</div>
		</div>
		<div class="content">
			
					<?php
						require_once('models/user.php');
						while($user = $users->fetch_object())
						{
							$user = new User($user->uid);
							?>
							<span class="UserTile">
								<a href="http://www.barnsley-ltu.co.uk/<?php $link = new User_Link($user, "url"); echo $link->output; ?>" class="UserTileTitle"><?php echo $user->username; ?></a></a>
								<a href="mailto:<?php echo $user->email; ?>" class="UserTileEmail"><?php echo $user->email; ?></a>
			
							</span>
							<?php
						}
					?>
			
		</div>
		
		<div class="side">
			<div class="inner_side">
				<p>Moodle Courses</p>
			</div>
		</div>
		<div id="moodle" class="content">
			<?php
				$result = $mysqli->query('SELECT * FROM moodle_pages WHERE department_id = '.$department->id.' ORDER BY course_title ASC');
				if($result->num_rows == 0)
				{
					?>
					<b>There are currently no moodle courses assigned to this page.</b>
					<?php
				}
				else
				{
					require_once('models/moodle.php');
					while($row = $result->fetch_object())
					{
						$moodle = new MoodleCourse($row->page_id);
						?>
						<span class="MoodleTile">
							<a href="http://www.barnsley-ltu.co.uk/courses/<?php echo $moodle->id; ?>/view" class="MoodleTileTitle"><?php echo $moodle->moodle_title; ?></a>
							<a href="<?php echo $moodle->url; ?>" class="MoodleTileURL"><?php echo $moodle->url; ?></a>
						</span>
						<?php
					}
				}
			?>
		</div>
		
		<div class="side">
			<div class="inner_side">
				<p>Message Board</p>
			</div>
		</div>
		<div id="messages" class="content">
			<?php
				$result = $mysqli->query('SELECT * FROM department_messages WHERE did = '.$department->id.' ORDER BY created_on DESC');
				if($result->num_rows == 0)
				{
					?>
					<b>There are no messages on this message board.</b>
					<?php
				}
				else
				{
					require_once('models/user_link.php'); 
					require_once('models/user.php');
					require_once('models/datetime.php');
					while($message = $result->fetch_object())
					{
						/*
						require_once('models/department_message.php');
						$message = new DepartmentMessage($row->id);
						*/
						?>
						<div class="note">
							<p id="title">From: <?php $user = new User($message->sender); $link = new User_Link($user); echo $link->output; unset($user,$link); ?></p>
							<p id="date">Sent: <?php $dt = new TimeStamp($message->created_on); echo $dt->str_date; ?></p>
							<p id="message"><?php echo $message->message; ?></p>
						</div>
						<?php
					}
				}
			?>
			<hr style="clear:both">
			<div>
				<form method="post" action="http://www.barnsley-ltu.co.uk/controllers/department_message.php">
					<table>
					
						<tr>
							<td><label>Subject: </label><input type="text" name="subject" placeholder="Subject" style="width:360px" required></td>
						</tr>
						<tr>
							<td valign="top"><label>Message:</label></td>
						</tr>
						<tr>	
							<td><textarea cols="50" rows="10" name="message" maxlength="500" onkeydown="counter(this)" onchange="if(this.value.length > 0){document.getElementById('submit').removeAttribute('disabled');}else{document.getElementById('submit').setAttribute('disabled','disabled');}" required></textarea></td>
							<td><input type="text" readonly="readonly" value="500" id="count" style="width:25px;border:none">Characters</td>
						</tr>
						<tr>
							
							<td style="float:right">
								<input type="submit" id="submit" disabled="disabled" value="Send">
							</td>
							<td>
								<input type="hidden" name="sender" value="<?php echo $_SESSION['uid']; ?>">
								<input type="hidden" name="depart_id" value="<?php echo $department->id; ?>">
							</td>
						</tr>
					</table>
				</form>
				
			</div>
		</div>
	</div>
</body>

</html>
