<?php
	$str = $_GET['name'];
	$output = "";
	include('dbconnection.php');
	if(strlen($str) == 0)
	{
		$mysqli->kill;
		unset($mysqli);
		echo "Enter a Name.";
	}	
	else
	{
		$result = $mysqli->query('SELECT * FROM users WHERE CONCAT(first_name, " ", last_name) LIKE "%'.$str.'%"');
		if($result->num_rows == 0)
		{
			$mysqli->kill;
			unset($mysqli);
			echo "No Results Found";
		}
		else
		{
			require_once('../models/user.php');
			while($raw = $result->fetch_object())
			{
				$user = new User($raw->uid);
				$output = "<user><id>".$user->id."</id><username>".$user->username."</username></user>";
			}
			$mysqli->kill;
			unset($mysqli);
			echo $output;
		}
	}
?>