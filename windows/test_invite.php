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
<title>Test IFrame</title>
</head>

<body>
	<form method="post" style="float:left;clear:both" action="http://www.barnsley-ltu.co.uk/controllers/invite_users_to_event.php?eid=<?php $event_id = $_GET['event_id']; echo $event_id; ?>">	
			<?php
				$cond = " WHERE ";
								if($_SESSION['account'] == "admin")
								{
									$found_users = $mysqli->query('SELECT * FROM users'.$cond.'uid != 0');
								}
								else
								{
									$found_users = $mysqli->query('SELECT u.* FROM users AS u WHERE department_id = '.$sess->department->id.' AND u.uid <> (SELECT tr.user_id FROM training_registers AS tr WHERE tr.event_id = '.$event_id.') GROUP BY u.uid');
								}
								
								if($found_users->num_rows != 0)
								{
			?>
					<table>
						<colgroup>
							<col id="username">
							<col id="department">
							<col id="add_invite">
						</colgroup>
						<thead>
							<tr>
								<th scope="col">Username</th>
								<th scope="col">Department</th>
								<th scope="col">Add Invite</th>
							</tr>
						</thead>
						<tbody>
							<?php 	
							while($user = $found_users->fetch_object()){ require_once('../models/user.php'); $temp = new User($user->uid, true); ?>
							<tr>
								<td><a href="user.php?id=<?php echo $temp->id; ?>"><?php echo $temp->username; ?></a></td>
								<td><?php echo $temp->department->name; ?></td>
								<td><input type="checkbox" name="<?php echo $temp->id;?>"></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				
					<input type="submit" value="Invite">
						<?php
						}
						else
						{
						?>
						<b>There are no more users to invite in this department.</b>
						<?php
						}
						?>
				</form>
</body>

</html>
