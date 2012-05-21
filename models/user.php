<?php
	class User
	{
		function __construct($prov_id, $get_department = false, $get_support = false)
		{
			global $id;
			global $first_name;
			global $last_name;
			global $username;
			global $department;
			global $telephone;
			global $email;
			global $account_type;
			include('dbconnection.php');
			$result = $mysqli->query("SELECT * FROM users WHERE uid = ".$prov_id);
			if($result->num_rows > 1)
			{	
				header('location: ../errors/user_error.php?e=Duplicated ID');
			}
			elseif($result->num_rows == 0)
			{	
				header('location: ../errors/user_error.php?e=No User');
			}
			else
			{
				$raw= $result->fetch_object();
				$this->id = $raw->uid;
				$this->first_name = $raw->first_name;
				$this->last_name = $raw->last_name;
				$this->username = $raw->first_name." ".$raw->last_name;
				$this->email = $raw->email;
				$this->telephone = $raw->telephone;
				$this->account_type = $raw->type;
				if($get_department)
				{
					require_once('department.php');
					if($get_support)
					{
						$this->department = new Department($raw->department_id, true);
					}
					else
					{
						$this->department = new Department($raw->department_id);
					}
				}
				else
				{
					$this->department = $raw->department_id;
				}
			}
			
			$mysqli->kill;
			unset($mysqli);
		}
		
	}
	
	
?>