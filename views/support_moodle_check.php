<?php
	if(isset($_GET['data']))
	{
		require_once('../models/moodle.php');
		$course = new MoodleCourse($_GET['data']);
		echo "<p>".$course->course_code." - ".$course->moodle_title."</p> % ".$course->id;		
	}
?>