<?php
	include('dbconnection.php');
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
	}
	else
	{
		header('location: ../errors/event_error.php?e=Can Not Delete Event');
	}
	
	$mysqli->query('DELETE FROM training_events WHERE event_id = '.$id);
	if($mysqli->affected_rows >= 1)
	{
		$mysqli->query('DELETE FROM training_registers WHERE event_id ='.$id);
		if($mysqli->affected_rows >= 1)
		{
			header('location: ../training.php');
		}
		else
		{
			header('location: ../errors/event_error.php?e=SQL Error');
		}
	}
	else
	{
		header('location: ../errors/event_error.php?e=SQL Error');
	}
?>