<?php
	// controllers/ajax/event_invite_user.php
	
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		session_start();
		include('../dbconnection.php');
		$mysqli->query("INSERT INTO training_registers (event_id, user_id, invited_by) VALUES (".$_GET['eid'].", ".$id.", ".$_SESSION['uid'].")";
		if($mysqli->affected_rows != 0)
		{
			include('../../views/event_register.php');
		}
		else
		{
			echo "<p>There has been a problem</p>";
		}
	}
	else
	{
		echo "<p>There are no users to invite</p>";
	}
?>