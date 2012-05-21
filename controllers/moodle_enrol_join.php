<?php
	$user_id = $_POST['user_id'];
	$page = $_POST['page'];
	$role = $_POST['role'];
	
	include('dbconnection.php');
	$mysqli->query('INSERT INTO moodle_assignments (page_id, user_id, role) VALUES ('.$page.', '.$user_id.', "'.$role.'")');
	$mysqli->kill;
	unset($mysqli);
	header('location: ../moodle.php?func=view&id='.$page);
?>