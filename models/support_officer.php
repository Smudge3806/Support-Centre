<?php
	class Support_Officer
	{
		function __construct($prov_id)
		{
			global $support_id;
			global $id;
			global $first_name;
			global $last_name;
			global $username;
						
			include('dbconnection.php');
			$result = $mysqli->query('SELECT * FROM get_support_officers WHERE sid ='.$prov_id);
			if($result->num_rows > 1)
			{
				header('location: ../errors/support_error.php?e=Abiguous Officers');
			}
			elseif($result->num_rows == 0)
			{
				header('location: ../errors/support_error.php?e=No Officer Assigned');
			}
			else
			{
				// Assume that everything Works
				$raw = $result->fetch_object();
				$this->support_id = $prov_id;
				$this->id = $raw->uid;
				$this->first_name = $raw->first_name;
				$this->last_name = $raw->last_name;
				$this->username = $this->first_name." ".$this->last_name;
			}
		}
		
		
	}
?>