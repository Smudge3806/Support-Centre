<?php 
	include('dbconnection.php');
	var_dump($_POST);
	if(isset($_POST['user']))
	{
	echo "User ID = ".$_POST['user']."<br>";
	}
	else
	{
		echo "Nope<br>";
	}
	
	if($_POST['title'] == 0)
	{
		$mysqli->query('INSERT INTO training_sessions (title) VALUES ('.$_POST['new_session'].')');
		if($mysqli->insert_id == 0)
		{
			var_dump($mysqli);//header('location: ../errors/database.php?Could Not Save New Training Session');
		}
		else
		{
			$sess_id = $mysqli->insert_id;
		}
	}
	else
	{
		$sess_id = $_POST['title'];
	}
	if(isset($sess_id))
	{
		echo "Session ID = ".$sess_id."<br>";
	}
	else
	{
		echo "Nope<br>";
	}

	echo $_POST['user'];
	$user = explode(". ", $_POST['user']);
	var_dump($user);
	$uid = $user[0];
	var_dump($uid);
	echo "<br><br>";
	$mysqli->query('INSERT INTO training_events (session_id, organiser_id, location, held_on) VALUES ('.$sess_id.', '.$uid.', "'.$_POST['location'].'", "'.$_POST['date'].'")');
	if($mysqli->insert_id == 0)
	{
		//header('location: ../errors/database.php?Could Not Save New Training Event');
		var_dump($mysqli);
	}
	else
	{
		$insert = $mysqli->insert_id;
		$mysqli->query('INSERT INTO training_registers (event_id, user_id, invited_by, attending) VALUES ('.$insert.', '.$uid.', '.$uid.', 2)');
		header('location: ../invite_users.php?event_id='.$insert);
	}	
	
?>