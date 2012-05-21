<?php
	session_start();
	var_dump($_POST);
	$x = 0;
	$collected = 0;
	$array = array();
	while($collected != count($_POST))
	{
		if(isset($_POST[$x]))
		{
			$array[] = $x;
			$collected++;
		}
		$x++;
	}
	$x = 0;
	$stmt = 'INSERT INTO training_registers (event_id, user_id, invited_by) VALUES ';
	while($x != count($array))
	{
		if($x != 0)
		{
			$values.=", ";
		}
		$values .= '('.$_GET['eid'].', '.$array[$x].', '.$_SESSION['uid'].')';
		$x++;
	}
	
	echo $stmt.$values;
	
	include('dbconnection.php');
	$mysqli->query($stmt.$values);
	if($mysqli->affected_rows >= 1)
	{
		header('location: ../event.php?id='.$_GET['eid']);	
	}
	else
	{
		var_dump($mysqli);
	}	
?>