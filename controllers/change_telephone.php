<?php
	$page = $_POST['page'];
	if(!isset($_POST['ext']))
	{
		header("location: ../".$page."?m=Please enter your extension and retry");
	}
	$telephone = $_POST['ext'];
	
	
	session_start();
	include('dbconnection.php');
	
	$mysqli->query("UPDATE users SET telephone = '".$telephone."' WHERE uid = ".$_SESSION['uid']);
	
	if($mysqli->affected_rows == 1)
	{
		header('location: ../'.$page.'?m=Telephone Extention Changed Successfully');
	}
	else
	{
		if($mysqli->affected_rows == 0)
		{
			header('location: ../'.$page.'?m=Telephone Extention failed to save');
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