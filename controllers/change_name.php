<?php
	$page = $_POST['page'];
	if(!isset($_POST['info']))
	{
		header("location: ../".$page."?m=Please enter your name and retry");
	}

	$field = $_POST['field'];
	$info = $_POST['info'];
	
	include('dbconnection.php');
	session_start();
	if($field == "forename")
	{
		$mysqli->query('UPDATE users SET first_name = "'.$info.'" WHERE uid ='.$_SESSION['uid']);
	}
	else
	{
		$mysqli->query('UPDATE users SET last_name ="'.$info.'" WHERE uid ='.$_SESSION['uid']);
	}
	
	if($mysqli->affected_rows == 1)
	{
		header('location: ../'.$page.'?m=Name Changed Successfully');
	}
	else
	{
		if($mysqli->affected_rows == 0)
		{
			header('location: ../'.$page.'?m=Name failed to save');
		}
		else
		{
			if($_SESSION['account'] == 'admin')
			{
				echo $mysqli->error;
			}
			else
			{
				header('location: ../'.$page.'?m=Oops, Theres been a programming problem');
			}
		}
	}

?>