<?php
	include('dbconnection.php');
	session_start();
	if(isset($_POST['user_id']))
	{
		if(isset($_POST['message']))
		{	
			$mysqli->query("INSERT INTO messages (uid, sid, message) VALUES (".$_SESSION['uid'].", ".$_POST['user_id'].", '".$_POST['message']."')");
			if($mysqli->affected_rows != 0)
			{
				header('location: ../index.php?m=Message Sent');
			}
			else
			{
				header('location: ../errors/error.php?e=There has been a problem sending your Message');
			}
		}
		else
		{
			header('location: ../contact_user.php?m=Enter a Message');
		}

	}
	else
	{
		header('location: ../login.php?e=2&m=There has been an internal error. Please contact LTU');
	}
?>