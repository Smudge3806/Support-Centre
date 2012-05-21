<?php
	include('dbconnection.php');
	session_start();
	if(isset($_GET))
	{
		require_once('../models/user.php');
		$support = new User($_GET['sid']);
		$user = new User($_SESSION['uid']);
		require_once('../models/daemon.php');
		
		$daemon = new Daemon($user->username, $support->email, "nudge", true, "http://www.barnsley-ltu.co.uk/support/".$_GET['id']);
		$mysqli->query('INSERT INTO threads (thread_topic) VALUES ("You\'ve been nudged!")');
		var_dump($mysqli);
		echo "<br>";
		$mysqli->query('INSERT INTO messages (thread_id, sender, recipient, message) VALUES ('.$mysqli->insert_id.', '.$user->id.', '.$support->id.', "'.$user->username.' would like an update on support request <a href=\"http://www.barnsley-ltu.co.uk/support/'.$_GET['id'].'\">'.$_GET['id'].'</a>")');
		var_dump($mysqli);
		$mysqli->query('INSERT INTO support_notes (rid, sender, message) VALUES ('.$_GET['id'].', '.$user->id.', "'.$user->username.' nudged '.$support->username.'.")');
	}
		$mysqli->kill;
		unset($mysqli);
		header('location: http://www.barnsley-ltu.co.uk/support/'.$_GET['id']);
?>