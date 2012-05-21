<?php session_start();?>
<?php include('../controllers/dbconnection.php'); ?>
<?php 
	require_once('../models/user.php');
	$sess = new User($_SESSION['uid'], true);
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Invite a Colleague</title>
<link rel="stylesheet" href="../styles/main.css">
<link rel="stylesheet" href="../styles/metro.css">
<link rel="shortcut icon" href="../img/favicon.ico">
<style type="text/css">
	body{
	background: white url('../img/background_image.jpg') no-repeat scroll 50% 10px;
	overflow:hidden;
	width:520px;
	margin:20px;
}
.header{
	font-size:x-small;
}
</style>
</head>

<body>
<?php include('../views/page_header.php');?>

<div style="float:left;clear:both"><!--
	<form method="post" action="invite.php" style="float:left;clear:left;margin-bottom:25px">
		<input type="search" name="user_search" placeholder="Username">
		<input type="submit" value="Find User" >
	</form>
	<form method="post" action="invite.php" style="float:left;clear:right">
		<input type="submit" value="Clear Results">
	</form>
	<?php
		$cond = " WHERE ";
		if(isset($_POST['user_search']))
		{
			$name = explode(" ", $_POST['user_search']);
			$cond = "first_name = '".$name[0]."' AND ";
			
		}
		
	?>-->
	<form method="post" style="float:left;clear:both" action="../controllers/invite_users_to_event.php?eid=<?php echo $_GET['event_id'];?>">	

	<fieldset style="height:150px;overflow:scroll;clear:left;background-color:white;border:thin black solid">
		<table>
			<thead>
				<tr style="background-color:silver">
					<th>Username</th>
					<th>Department</th>
					<th>Add Invite</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if($_SESSION['account'] == "admin")
					{
						$users = $mysqli->query('SELECT * FROM users'.$cond.'uid != 0');
					}
					else
					{
						$users = $mysqli->query('SELECT * FROM users'.$cond.'department_id = '.$sess->department->id); 
					}
				
				while($user = $users->fetch_object()){ require_once('../models/user.php'); $temp = new User($user->uid, true); ?>
				<tr>
					<td><a href="user.php?id=<?php echo $temp->id; ?>"><?php echo $temp->username; ?></a></td>
					<td><?php echo $temp->department->name; ?></td>
					<td><input type="checkbox" name="<?php echo $temp->id;?>"></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</fieldset>

	<input type="submit" value="Invite">
	<button onclick="window.close()">Close</button>
</form>

</div>
</body>

</html>
