<?php
	if(isset($_GET['eid'], $_GET['uid'], $_GET['page'], $_GET['att']))
	{
		include('dbconnection.php');
		switch($_GET['att'])
		{
			case 1:
				// invited
				header('location: ../'.$_GET['page']);
				break;
			case 2:
				// attending
				$attending = 2;
				$stmt = "UPDATE training_registers SET attending = ".$attending." WHERE user_id = ".$_GET['uid']." AND event_id = ".$_GET['eid'];
				break;
			case 3:
				// declined
				$attending = 3;
				$stmt = "DELETE FROM training_registers WHERE user_id = ".$_GET['uid']." AND event_id = ".$_GET['eid'];
				break;
		}
		$result = $mysqli->query($stmt);
		if($mysqli->affected_rows != 0)
		{
			// Change made
			header('location: ../'.$_GET['page']);
		}
		else
		{
			var_dump($result);
			var_dump($mysqli);
			echo "UPDATE training_registers WHERE user_id = ".$_GET['uid']." AND event_id = ".$_GET['eid']." SET attending = ".$attending;
		}
	}
	else
	{
		echo "Error";	
	}
?>