<?php
	if(count($_POST) == 4)
	{
		$message = $_POST['message'];
		$subject = $_POST['subject'];
		$sender = $_POST['sender'];
		$id = $_POST['depart_id'];
		
		include('dbconnection.php');
		
		$mysqli->query('INSERT INTO department_messages (subject, message, sender, did) VALUES ("'.$subject.'", "'.$message.'", '.$sender.', '.$id.')');
		if($mysqli->insert_id == 0)
		{
			var_dump($mysqli);
			echo 'INSERT INTO department_messages (subject, message, sender, did) VALUES ("'.$subject.'", "'.$message.'", '.$sender.', '.$id.')';
		}
		elseif($mysqli->insert_id > 0)
		{
			header('location: ../department/'.$id);
		}
		else
		{
			var_dump($mysqli);
		}
	}
	else
	{
		var_dump($_POST);
	}
?>