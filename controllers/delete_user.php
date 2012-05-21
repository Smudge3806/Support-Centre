<?php
	include('dbconnection.php');
	// authenticate Admin authority.
	$result = $mysqli->query('SELECT * FROM users WHERE uid = '.$_POST['uid'].' AND password = '.MD5($_POST['password']));
	if($result->num_rows != 0)
	{
		$row = $result->fetch_object();
		if($row->type != "Admin")
		{
			require_once('../models/daemon.php');
			$daemon = new Daemon(6, 6, "5012", true, "User-ID: ".$_POST['uid']."\n\rOperation: Delete User");
			header('location: ../profile.php?m=Unauthorised Access. You have been Reported');
		}
	}
	else
	{
		header('location: ../'.$_POST['page'].'&m=Password Failed to Authenticate');
	}
	
	$mysqli->query('INSERT INTO deactiv_users (user_id, deactiv_by) VALUES ('.$_POST['deactiv_user'].', '.$_POST['user'].')');
	var_dump($mysqli);
	//header('location: ../index.php?m=User Deleted');
?>