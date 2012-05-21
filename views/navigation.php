<div id="navigation" style="margin-top:0px">
		<ul>
			<?php if(isset($_SESSION['uid'])){ ?>
			<li><?php if($_SESSION['account'] == "admin"){?><a href="index.php" title="Administrator's Wall">Wall</a> | <?php }?><a href="profile.php" title="<?php echo $_SESSION['username']; ?>'s Profile">Profile</a> | <a href="account.php" title="Account Settings">Account</a> | <a href="logout.php" title="Logout of your account">Logout</a> |</li>
			<?php }else{ ?>
			<li><a href="about.php" title="About Syncronicity" >About</a> | <a href="login.php" title="Login to your account">Login</a> |</li>
			<?php } ?>
		</ul>
</div>
