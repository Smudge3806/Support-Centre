<div>
	<?php
		if($isUser)
		{
			$results = $mysqli->query("SELECT * FROM messages WHERE recipient =".$new_user->id);
			if($results->num_rows != 0)
			{
				$notif_num = "(".$results->num_rows.")";			
			}		
			else
			{
				$notif_num = NULL;
			}
		} 
		if($isUser)
		{
			
	?>
	
		
<div class="metro" style="width:620px">
			<div style="float:left"><div id="tile">
				<p id="name" style="margin:0px;font-weight:normal;"><a href="http://www.barnsley-ltu.co.uk/user<?php if(!$isUser){echo "/".$new_user->id;} ?>" style="text-decoration:none;color:white"><?php echo $new_user->username; ?></a></p>
				<i style="font-size:small" id="name"><a href="http://www.barnsley-ltu.co.uk/department/<?php echo $new_user->department->id; ?>" style="text-decoration:none;color:white"><?php echo $new_user->department->name; ?></a></i>
			</div>
			<div id="small-long"><a href="http://www.barnsley-ltu.co.uk/events/new" title="Click here to request a training event">Request Training</a></div>
			<div id="small-long"><a href="http://www.barnsley-ltu.co.uk/support/new/moodle/<?php echo $new_user->id; ?>" title="Submit a Support Request to your Support Officer">Request Support</a></div>
			</div><div style="float:left;">
			<div id="small-long" style="float:left;"><a href="http://www.barnsley-ltu.co.uk/messages/compose/<?php echo $new_user->department->support_officer->id; ?>" title="Click here to contact your support officer">Contact Your Support Officer</a></div>
			<div id="small-long"><a href="http://www.barnsley-ltu.co.uk/messages/" title="Click here to see the latest news">Inbox<?php echo $notif_num; ?></a></div></div>
		</div>

		<?php
		}elseif($isAdmin){
		?>
	<div class="metro" style="width:620px">
		<div style="float:left"><div id="tile">
			<p id="name" style="margin:0px;font-weight:normal;"><a href="http://www.barnsley-ltu.co.uk/user<?php if(!$isUser){echo "/".$new_user->id;} ?>" style="text-decoration:none;color:white"><?php echo $new_user->username; ?></a></p>
			<i style="font-size:small" id="name"><a href="http://www.barnsley-ltu.co.uk/department/<?php echo $new_user->department->id; ?>" style="text-decoration:none;color:white"><?php echo $new_user->department->name; ?></a></i>
		</div>
		<div id="small-long"><a href="http://www.barnsley-ltu.co.uk/events/view" title="Add this User to a Training Event">Invite to Training</a></div>
		<div id="small-long"><a href="http://www.barnsley-ltu.co.uk/support/new/moodle/<?php echo $new_user->id;?>" title="Add a Support Request for this User">Add a Support Request</a></div>
		</div>
		<div style="float:left;">
			<div id="small-long" style="float:left;"><a href="http://www.barnsley-ltu.co.uk/messages/compose/<?php echo $new_user->id; ?>" title="Click here to contact this User">Contact This User</a></div>
			<div id="small-long"><a href="http://www.barnsley-ltu.co.uk/profile.php?id=<?php echo $new_user->id; ?>&m=This Features is not available" title="Click here to see the latest news">Coming Soon!</a></div>
		</div>
	</div>

		<?php
		}else{
			
			if(isset($list))
			{
				$username = $user->first_name." ".$user->last_name;
				$uid = $user->uid;
				 
			}
		
		?>
		
			<div class="metro" style="width:620px;">
		<div style="float:left;">
			<div id="tile" style="clear:none">
				<p id="name" style="margin:0px;font-weight:normal;"><a href="http://www.barnsley-ltu.co.uk/users/<?php echo $new_user->id; ?>" style="text-decoration:none;color:white"><?php echo $new_user->username; ?></a></p>
				<i style="font-size:small" id="name"><a href="http://www.barnsley-ltu.co.uk/department/<?php echo $new_user->department->id; ?>" style="text-decoration:none;color:white"><?php echo $new_user->department->name; ?></a></i>
			</div>
			<div id="small-long"><a href="http://www.barnsley-ltu.co.uk/events/view" title="Click to Invite">Invite to Training</a></div>
			<div id="small-long"><a href="http://www.barnsley-ltu.co.uk/messages/compose/<?php echo $new_user->id; ?>" title="Message this User">Message this User</a></div>
		</div>

<?php
		}
	?>

</div>