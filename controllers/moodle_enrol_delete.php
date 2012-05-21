<?php
	session_start();
	include('dbconnection.php');
	
	$id = $_GET['id'];
	$course = $_GET['course'];
	
	$mysqli->query('DELETE FROM moodle_assignments WHERE page_id ='.$course.' AND user_id ='.$id);
	if($mysqli->affected_rows != 0)
	{
		if($_SESSION['uid'])
		{
			header('location: ../profile.php?m=Unenrolled Successfully');
		}
		else
		{
			header('location: ../moodle.php?func=view&id='.$course.'&m=User Unenrolled Successfully');
		}
	}
?>