<div>
	<?php 
		if(!$isUser)
		{
			if(isset($list))
			{
				$username = $user->first_name." ".$user->last_name;
				$uid = $user->uid;
				 
			}
	?>
	<div class="metro">
		<a href="profile.php?id=<?php echo $user->uid; ?>" title="See this User's Profile"><?php echo $username; ?><span>Learning Technologies Unit</span></a>
		<a href="mailto:c.smith@barnsley.ac.uk" title="Email this User" id="small"><b style="font-size:25px;line-height:15px">@</b></a>
		<a href="invite.php" title="Invite this User to a Training Event" id="small-long">Invite to Training</a>
		<a href="departments.php?id=<?php echo $user->department_id; ?>" title="See who is in this department" id="small"><b style="font-size:25px;line-height:15px">D</b></a>
		<a href="status.php" title="See why this user is a Gold standard user" id="small-long">Gold Status User</a>
	</div>
	<?php
		}else{
	?>
	<div class="metro">
		<a href="profile.php" title="See this User's Profile">Chris Smith<span>Learning Technologies Unit</span></a>
		<a href="mailto:c.smith@barnsley.ac.uk" title="Email this User" id="small"><b style="font-size:25px;line-height:15px">@</b></a>
		<a href="request_training.php" title="Request a Training Event" id="small-long">Request Training</a>
		<a href="departments.php?id=<?php echo $user->department_id; ?>" title="See who is in this department" id="small"><b style="font-size:25px;line-height:15px">D</b></a>
		<a href="submit_report.php" title="Submit a Support Request" id="small-long">Support Request</a>
	</div>
	<?php
		}
	?>
</div>