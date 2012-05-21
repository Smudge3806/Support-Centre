<?php
	if(isset($_GET['eid'])){
		include('../dbconnection.php');
		$mysqli->query("UPDATE training_events SET confirmed = 1 WHERE event_id = ".$_GET['eid']);
		if($mysqli->affected_rows != 1)
		{
			$message = "Save Error";
			$action = "show";
		}
		else
		{
			$message = "Event Confirmed";
			$action = "close";
		}
		$mysqli->kill;
		echo json_encode(array("output" => "<p>Event Confirmed</p>"));
	}
	else
	{
		echo json_encode(array("output" => "<p>Save Error</p>"));
	}
	if(isset($_GET['page']))
	{
		header('location: ../../'.$_GET['page'].'?id='.$_GET['eid'].'&fbm='.$message.'&fba='.$action);
	}
?>