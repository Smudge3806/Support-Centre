<?php
	class Student
	{
		function __construct($id)
		{
			global $student_number;
			global $name;
			global $concerns;
			global $targets;
			
			$this->concerns = array();
			$this->targets = array();
			
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
				$this->student_number = $id;
				
				$stud = $mysqli->query('SELECT `Student Name` AS name FROM Concerns WHERE `Student Number` = '.$id);
				$name = $stud->fetch_object();
				$this->student_name = $name->name;
				unset($stud);	
							
				$student_conc = $mysqli->query('SELECT ConcernID FROM get_concerns WHERE `Student Number` = '.$id);
				if($student_conc->num_rows != 0)
				{	
					while($conc = $student_conc->fetch_object())
					{		
						require_once('concern.php');
						$concern = new Concern($conc->ConcernID);
						$this->concerns[] = $concern;		
					}	
				}
				else
				{
					$this->concerns = "There are No Concerns for this Student";
					unset($student_conc);		
				}				
			
				$student_targ = $mysqli->query('SELECT TargetID FROM Targets WHERE `Student Number` ='.$id);
				if($student_targ->num_rows != 0)
				{
					while($targ = $student_targ->fetch_object())
					{
						require_once('target.php');
						$target = new Target($targ->TargetID);
						$this->targets[] = $target;		
					}					
				}
				else
				{
					$this->targets = "There are No Targets for this Student";	
				}
			
																		
			}					
			
			$mysqli->kill;											
		}				
	}		
?>