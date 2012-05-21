<?php
	class Concern
	{
		function __construct($id)
		{
			global $concern_id;
			global $tutor;
			global $course;
			global $comment;
		
			$this->concern_id = $id;	
			
			DEFINE('DB_USER', 'barnsle2_ilp', true);
			DEFINE('DB_PASS', 'barnsle12', true);
			DEFINE('DB_NAME', 'barnsle2_ilp', true);
			$mysqli = @new Mysqli('localhost', DB_USER, DB_PASS, DB_NAME);
			if ($mysqli->connect_error) 
			{
		    		die('Connect Error: ' . $mysqli->connect_error);
			}
			else
			{
				$conc = $mysqli->query('SELECT `Tutor Name/Number` AS tutor, Course, Comments FROM Concerns WHERE ConcernID = '.$id);
				$concern = $conc->fetch_object();
				$this->tutor = $concern->tutor;
				$this->course = $concern->Course;
				$this->comment = $concern->Comments;		
			}										
		}			
	}		
?>