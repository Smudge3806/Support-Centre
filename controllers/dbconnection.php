<?php
	include('site_data/data.php');
	$mysqli = @new Mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($mysqli->connect_error) 
	{
    	die('Connect Error: ' . $mysqli->connect_error);
	}	
?>