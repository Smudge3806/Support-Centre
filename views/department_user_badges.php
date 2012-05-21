<div class="metro">
				
		<a href="profile.php?id=<?php echo $user->uid; ?>" title="See this User's Profile"><?php echo $username; ?><span><?php echo $department->department_name; ?></span></a>
		<a href="mailto:<?php echo $user->email; ?>" title="Email this User" id="small-long">Email <?php echo $username; ?></a>
		<a href="invite.php" title="Invite this User to a Training Event" id="small-long">Invite to Training</a>
</div>


