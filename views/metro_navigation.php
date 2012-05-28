<?php 
	$addr = $_SERVER['PHP_SELF'];
	// Trust that its the full path from www/
	$addr = explode("/", $addr);
	if(count($addr) < 1)
	{
		// is not in the root
		for($x = 0; $x < count($addr); $x++)
		{
			$root.= "../";
		}
		$addr = $root.$addr;
	}
	else
	{
		$addr = "https://www.barnsley-ltu.co.uk/";
	}
	DEFINE("PATH", $addr, true);
?>
<?php if(isset($_SESSION['uid'])){?>
<?php if($_SESSION['account'] == 'admin'){ ?>
<a href="<?php echo PATH; ?>index.php" id="link" title="Go to the Administration Wall">Wall</a><?php } ?>
<a href="<?php echo PATH; ?>user" id="link" title="See your Profile">Profile</a>
<a href="<?php echo PATH; ?>account" id="link" title="See and Change your account details">Account</a>
<a href="<?php echo PATH; ?>logout.php" id="link" title="Logout">Logout</a><?php }else{ ?>
		<a href="<?php echo PATH; ?>register.php" id="link" title="Register to access the Support Centre">Register</a>
		<a href="<?php echo PATH; ?>about.php" id="link" title="About LTU Support Centre">About</a>
		<a href="<?php echo PATH; ?>contact.php" id="link" title="Contact Us">Contact Us</a>
		<a href="<?php echo PATH; ?>login.php" id="link" title="Login to Support Centre">Login</a>
<?php }?>
