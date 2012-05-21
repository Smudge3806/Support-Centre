<?php
	$id = $_GET['id'];
	include('dbconnection.php');
	$mysqli->query('UPDATE training_events SET confirmed = 1 WHERE event_id = '.$id);
	if($mysqli->affected_rows != 0)
	{
		header('location: ..'.$_GET['page']);
	}
	else
	{
		echo "false";
	}
?>