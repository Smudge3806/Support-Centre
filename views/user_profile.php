<div id="user_profile_ui">
	<fieldset>
		<ul id="profile-ui">
			<li id="alt"><h2 class="title"><?php echo $user->username; ?></h2></li>
			<li><a href="mailto:<?php echo $user->email; ?>"><?php echo $user->email; ?></a></li>
			<li id="alt"><p><?php echo $user->department->name; ?></p></li>
			<li><p>Account Type: <?php echo $user->account_type; ?></p></li>
			<li id="alt"><p>Support Officer: <a href="user_profile.php?id=<?php echo $user->department->support_officer->id; ?>"><?php echo $user->department->support_officer->username; ?></a></p></li>
		</ul>	
	</fieldset>
</div>
