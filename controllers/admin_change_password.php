<?php
	$page = $_POST['page'];
	if(!isset($_POST['password']))
	{
		header("location: ../".$page."?m=Please enter a new password and retry");
	}

	$new_password = MD5(MD5($_POST['password']));
	session_start();
	$uid = $_SESSION['uid'];
	include('dbconnection.php');
	$mysqli->query('UPDATE users SET password = "'.$new_password.'" WHERE uid = '.$uid);
	if($mysqli->affected_rows == 1)
	{
		header('location: ../'.$page.'?m=Password Changed Successfully');
	}
	else
	{
		if($mysqli->affected_rows == 0)
		{
			header('location: ../'.$page.'?m=Password failed to save');
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
