<?php
	$did = $_POST['departments'];
	$page = $_POST['page'];
	session_start();
	if(!isset($_POST['user']))
	{
		$id = $_SESSION['uid'];
	}
	else
	{
		$id = $_POST['user'];
	}
	include('dbconnection.php');
	
	
	$mysqli->query('UPDATE users SET department_id = '.$did.' WHERE uid ='.$id);
	
	if($mysqli->affected_rows == 1)
	{
		header('location: ../'.$page.'?m=Department Changed Successfully');
	}
	else
	{
		if($mysqli->affected_rows == 0)
		{
			//header('location: '.$page.'?m=Department Change failed to save');
			var_dump($mysqli);
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