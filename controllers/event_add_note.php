<?php
	// controllers/events_add_note.php
	if(isset($_GET['eid']))
	{
		$event_id = $_GET['eid'];
	}
	else
	{
		session_start();
		if($_SESSION['account'] == "admin")
		{
			header('location: index.php?m=Error 418: Message could not be saved.. Code Problem');
		}
		else
		{
			header('location: profile.php?m=Error 418: There has been a problem. Contact LTU');
		}
	}
	if(isset($_GET['uid']))
	{
		$sender_id = $_GET['uid'];
	}
	
	if(isset($_GET['mess']))
	{
		$message = $_GET['mess'];
	}
	
	include('dbconnection.php');
	$mysqli->query('INSERT INTO training_notes (event_id, sender_id, message) VALUES ('.$event_id.', '.$sender_id.', "'.$message.'")');
	if($mysqli->affected_rows == 0)
	{
		if($_SESSION['account'] == "admin")
		{
			header('location: index.php?m=Error 418: Message could not be saved.. Code Problem');
		}
		else
		{
			header('location: profile.php?m=Error 418: There has been a problem. Contact LTU');
		}

	}
	else
	{
		if(isset($_GET['page']))
		{
			header('location: ../'.$_GET['page'].'?id='.$event_id);
		}
		else
		{
			header('location: ../event.php?id='.$event_id);
		}
	}
?>