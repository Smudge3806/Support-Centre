<?php
	include('dbconnection.php');
	
	if(isset($_POST['user_id']))
	{
		$result = $mysqli->query("SELECT department_id AS did FROM users WHERE uid =".$_POST['user_id']);
		if($mysqli->affected_rows != 1)
		{
			header('location: ../errors/error.php?e=Contact Support User ID number');
		}
		if(isset($_POST['message']))
		{
			$raw = $result->fetch_object();
			$result = $mysqli->query('SELECT * FROM get_support_officers WHERE did = '.$raw->did);
			$dep = $result->fetch_object();
			$mysqli->query("INSERT INTO messages (uid, sid, message) VALUES (".$_POST['user_id'].", ".$dep->sid.", '".$_POST['message']."')");
			if($mysqli->affected_rows != 0)
			{
				header('location: ../profile.php?m=Message Sent');
			}
			else
			{
				header('location: ../errors/error.php?e=There has been a problem sending your Message');
			}
		}
		else
		{
			header('location: ../contact_support.php?e=Enter a Message');
		}
	}
	else
	{
	
	}
?>