<?php
	class User
	{
		function __construct($userData)
		{
			global $userid = $userData->uid;
			global $username = $userData->username;
			require_once('department.php');
			global $department = new Department($userData->dept_id);
		}
		
		function getUserID()
		{
			return $this->userid;
		}
		
		function getUsername()
		{
			return $this->username;
		}
		
		function getDepartmentObject()
		{
			return $this->department;
		}
		
		function getDepartmentId()
		{
			return $this->department->getDeptID();
		}
		
		function getDepartmentName()
		{
			return $this->department->getDeptName();
		}
	}
?>