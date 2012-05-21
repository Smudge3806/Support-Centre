<fieldset class="container" style="width:auto;min-width:300px;max-width:400px" id="profile-badge">
	<img src="<?php echo $user->avatar; ?>" alt="User Picture" id="user-avatar">
	<table id="user_details">
		<tr>
			<td><h3 id="user-name"><a href="profile.php?id=<?php echo $user->uid; ?>" title="See this User's Profile" id="user-name"><?php echo $user->first_name.' '.$user->last_name; ?></a></h3></td>
		</tr>
		<tr>
			<td><a href="departments.php?id=<?php echo $user->department_id; ?>" title="See who's in this department" id="profile-department"><?php echo $department->department_name; ?></a></td>
		</tr>
	</table>
</fieldset>
