<?php
	class Target
	{
		function __construct($id)
		{
			global $target_id;
			global $tutor;
			global $course;	
			global $targets;
			
			$this->target_id = $id;
			
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
				$targ = $mysqli->query('SELECT `Tutor Name/Number` as tutor, Course as course, Targets as targets FROM Targets WHERE TargetID ='. $id);
				$target = $targ->fetch_object();
				$this->tutor = $target->tutor;
				$this->course = $target->course;
				$this->targets = $target->targets;					
			}
			$mysqli->kill;		
		}			
	}		
?>