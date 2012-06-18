<?php
	//include('../site_data/data.php');
	DEFINE('DB_HOST', "localhost", true);
	DEFINE('DB_USER', "barnsle2_site", true);
	DEFINE('DB_PASS', "muskako2", true);
	DEFINE('DB_NAME', "barnsle2_help_desk", true);
	$mysqli = new Mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_error)
	{
		die('<b>CONSOLE:</b> Connect Error: ' . $mysqli->connect_error);
	}
?>