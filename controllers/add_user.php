<?php
	include('dbconnection.php');
	if(isset($_POST['first_name']))
	{
		$first = $_POST['first_name'];
	}
	else
	{
		header('location: ../index.php?m=User Creation Failed1');
	}
	if(isset($_POST['last_name']))
	{
		$last = $_POST['last_name'];	
	}
	else
	{
		header('location: ../index.php?m=User Creation Failed2');
	}
	if(isset($_POST['email']))
	{
		$email = $_POST['email'];
	}
	else
	{
		header('location: ../index.php?m=User Creation Failed3');
	}
	/*if(isset($_POST['department']))
	{
		require_once('../models/department.php');
		$department = new Department($_POST['department']);
	}
	else
	{
		header('location: index.php?m=User Creation Failed');
	}*/
	
	//If we have got this far then everything is correct.
	
	if(isset($_POST['telephone']))
	{
		$phone = $_POST['telephone'];
	}
	else
	{
		$phone = NULL;
	}
	
	//$mysqli->query('INSERT INTO users (first_name, last_name, email, department_id, telephone) VALUES ('.$first_name.', '.$last_name.', '.$email.', '.$department->id.', '.$telephone.')');
	$mysqli->query('INSERT INTO users (first_name, last_name, email, department_id, telephone) VALUES ("'.$first.'", "'.$last.'", "'.$email.'", 1, "'.$phone.'")');
	if($mysqli->insert_id != 0)
	{
		header('location: ../user.php?id='.$mysqli->insert_id);
	}
	else
	{
		var_dump($mysqli);
		echo "<br/>".'INSERT INTO users (first_name, last_name, email, department_id, telephone) VALUES ("'.$first.'", "'.$last.'", "'.$email.'", 1, "'.$phone.'")';
		//header('location: ../index.php?m=User Creation Failed4');
	}
	
?>