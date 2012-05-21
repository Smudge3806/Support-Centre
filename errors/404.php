<?php
	error_reporting(E_ALL);
	session_start();
	if(isset($_SESSION['account']))
	{
		switch($_SESSION['account'])
		{
				case "admin":
				header('location: ../index.php?m=404 Error - Page Does Not Exist');
				break 2;
			case "user":
				header('location: ../profile.php?m=404 Error - Page Does Not Exist');
				break 2;
		}
	}
	else
	{
		
		header('location: ../login.php?e=5&m=404 Error - Page Does Not Exist');
	}
?>