<?php
	include('dbconnection.php');
		$_timeSecs = $_GET['seconds'];
		$_timeMins = $_GET['minutes'];
		$_timeHour = $_GET['hours'];
		$_time = $_timeHour.":".$_timeMins.":".$_timeSecs;
		
		$mysqli->query("UPDATE training_events SET held_at = '".$_time."' WHERE event_id = ".$_GET['event_id']);
		if($mysqli->affected_rows == 1)
		{
			header('location: ../events/'.$_GET['event_id'].'/admin');
		}
		else
		{
			var_dump($mysqli);
			var_dump($_GET);
		}
?>