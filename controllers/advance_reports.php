<?php
	$id = $_POST['report'];
	$officer = $_POST['officer'];
	require_once('../models/user.php');
	$sup_off = new User($officer);
	include('dbconnection.php');
	session_start();
	$user = new User($_SESSION['uid']);
	
	$mysqli->query('INSERT INTO support_advances (from_officer_id, to_officer_id, rid) VALUES ('.$_SESSION['uid'].', '.$officer.', '.$id.')');
	
	if($mysqli->insert_id != 0)
	{
		$mysqli->query('INSERT INTO support_notes (rid, sender, message) VALUES ('.$id.', '.$_SESSION['uid'].', "'.$user->username.' shared this support request to '.$sup_off->username.'")');
		unset($user, $sup_off, $mysqli);
		header('location: ../support/'.$id);
	}
	else
	{
		var_dump($_POST);
		echo "<br><br>";
		var_dump($mysqli);
		echo "<br><br>";
		echo 'INSERT INTO support_advances (from_officer_id, to_officer_id, rid) VALUES ('.$_SESSION['uid'].', '.$officer.', '.$id.')';
	}
?>