<?php 
	include('controllers/dbconnection.php');
	$mysqli->query('UPDATE moodle_pages SET department_id = '.$_GET['dep'].' WHERE page_id = '.$_GET['rec']);
	if($mysqli->affected_rows != 0)
	{
		?>
		<p>Course Assigned</p>
		<?php
	}
	else
	{
		?>
		<p>Assignment Failure.</p>
		<?php
	}
	unset($mysqli);
?>