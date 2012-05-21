<form method="post" action="index.php" style="float:left;clear:left">
	<input type="search" name="user_search" placeholder="Username">
	<input type="submit" value="Find User" >
</form>
<form method="post" action="index.php" style="float:left;clear:right">
	<input type="submit" value="Clear Results">
</form>
<?php
	$cond = "";
	if(isset($_POST['user_search']))
	{
		$name = explode(" ", $_POST['user_search']);
		$cond = " WHERE first_name = '".$name[0]."'";
		
	}
	
?>
<div style="height:150px;overflow:scroll;clear:left">
	<table>
		<thead>
			<tr style="background-color:silver">
				<th>Username</th>
				<th>Email</th>
				<th>Telephone</th>
				<th>Department</th>
				<th>Type</th>
			</tr>
		</thead>
		<tbody>
			<?php $users = $mysqli->query('SELECT * FROM users'.$cond); while($user = $users->fetch_object()){ require_once('models/user.php'); $temp = new User($user->uid, true); ?>
			<tr>
				<td><a href="users/<?php echo $temp->id; ?>/admin"><?php echo $temp->username; ?></a></td>
				<td><a href="mailto:<?php echo $temp->email; ?>"><?php echo $temp->email; ?></a></td>
				<td><?php echo $temp->telephone; ?></td>
				<td><?php echo $temp->department->name; ?></td>
				<td><?php echo $temp->account_type; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<div id="add_user">
	<p style="text-decoration:underline">Add User</p>
	<form action="controllers/add_user.php" method="post">
	<table>
		<tr><td><label>First Name*: </label></td><td><input type="text" name="first_name" required placeholder="First Name"></td><td><label>Last Name*: </label></td><td><input type="text" name="last_name" required placeholder="Last Name"></td></tr>
		<tr><td><label>Email*: </label></td><td><input type="email" name="email" required placeholder="Email Address"></td><td><label>Telephone: </label></td><td><input type="text" name="telephone" placeholder="Extension"></td></tr>
		<tr><td><!--<label>Department*:</label></td><td><select name="department" required>
			<option>Choose a Department...</option>
			<?php $departments = $mysqli->query('SELECT * FROM departments'); if($departments->num_rows == 0){ header('location: errors/department_error.php?e=No_Department'); }else{
				while($raw = $departments->fetch_object()){ require_once('models/department.php'); $department = new Department($raw->did);?><option value="<?php echo $department->id;?>"><?php echo $department->name; ?></option><?php
			}} ?>
		</select>--></td><td></td><td><input type="submit" value="Add User"></td></tr>
	</table>

	</form>
</div>
