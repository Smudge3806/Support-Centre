<?php
	class Department
	{
		function __construct($prov_id, $get_support = false)
		{
			global $id;
			global $name;
			global $location;
			global $support_officer;
			include('dbconnection.php');

			$result = $mysqli->query('SELECT * FROM departments WHERE did = '.$prov_id);
			if($result->num_rows > 1)
			{
				header('location: ../errors/department_error.php?e=Ambiguous Departments');
			}
			elseif($result->num_rows == 0)
			{
				header('location: ../errors/department_error.php?e=No Department&i='.$prov_id);
			}
			else
			{
				$raw = $result->fetch_object();
				$this->id = $raw->did;
				$this->name = $raw->department_name;
				$loc_id = $raw->location;
				$result = $mysqli->query('SELECT * FROM locations WHERE lid ='.$loc_id);
				if($result->num_rows > 1)
				{
					header('location: ../errors/department_error.php?e=Ambiguous Locations');
				}
				elseif($result->num_rows == 0)
				{	
					header('location: ../errors/department_error.php?e=No Location Set');
				}
				else
				{
					//we assume that nothing is wrong.
					$raw = $result->fetch_object();
					$this->location = $raw->location;
				}
				$result = $mysqli->query('SELECT * FROM get_support_officers WHERE did ='.$this->id);
				if($result->num_rows > 1)
				{
					header('location: ../errors/department_errors.php?e=Ambiguous Officers');
				}
				elseif($result->num_rows == 0)
				{
					header('location: ../errors/department_errors.php?e=No Support Officer Assigned');
				}
				else
				{
					//Assume everything is ok.
					$raw = $result->fetch_object();
					if($get_support)
					{
						require_once('support_officer.php');
						$this->support_officer = new Support_Officer($raw->sid);
					}
					else
					{
						$this->support_officer = $raw->uid;
					}
				}
				
			}
		}
		
		
	}
?>