<?php
	class Department
	{
		function __construct($departmentID)
		{
			global $mysqli = dbConnect();
			global $result;
			global $departmentID = dbGetDeptID($departmentID);
			global $departmentName = $result->name;
		}
		
		function dbConnect()
		{
			include('../site_data/data.php');
			$this->mysqli = @new Mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if($this->mysqli->connect_error)
			{
				$this->mysqli = null;
				header('location: ../error.php?e=Database');
			}
		}
		
		function dbGetDeptID($deptID)
		{
			$return = false;
			if(isset($deptID))
			{
				$resultset = $this->mysqli->query("SELECT * FROM departments WHERE did = {$deptID}");
				$this->result = resultset->fetch_object();
				$return = $this->result->did;
			}
			else
			{
				header('location: ../error.php?e=Department');	
			}
			return $return;
		}
		
		function getDeptName()
		{
			return $this->departmentName;
		}
		
		function getDeptId()
		{
			return $this->departmentID;
		}
		
	}
?>