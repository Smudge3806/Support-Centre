<?php
	session_start();
	require_once('../models/user.php');
	$user = new User($_SESSION['uid']);
	if(isset($_GET))
	{
		include('dbconnection.php');
		?>
		<table>
		<?php
		echo "<tr><td><b>CONSOLE: </b>Deleting Messages from this Thread</td>";
		$mysqli->query('DELETE FROM messages WHERE thread_id = '.$_GET['id']);
		if($mysqli->affected_rows > 0)
		{
			$answer = "[OK]";
		}
		else
		{
			$answer = "[FAILED]";
		}
		echo "<td>".$answer."</td></tr>";
		echo "<tr><td><b>CONSOLE: </b>Deleting Thread</td>";
		$mysqli->query('DELETE FROM threads WHERE thread_id = '.$_GET['id']);
		if($mysqli->affected_rows > 0)
		{
			$answer = "[OK]";
		}
		else
		{
			$answer = "[FAILED]";
		}
		echo "<td>".$answer."</td></tr>";
		echo "<tr colspan='2'><td><b>CONSOLE: </b>Thread Deleted</b></td></tr>";
		$mysqli->close();
		unset($mysqli);
		header('location: http://www.barnsley-ltu.co.uk/messages/');
	}
	else
	{
		if(strtolower($_SESSION['account']) == "user")
		{
			header('location: http://www.barnsley-ltu.co.uk/user/'.$_SESSION['uid']);
		}
		else
		{
			header('location: http://www.barnsley-ltu.co.uk/user/'.$_SESSION['uid'].'/admin');
		}
	}
?>