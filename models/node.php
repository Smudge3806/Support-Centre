<?php
	class Node
	{
		function __construct($operation, $id = NULL, $address = NULL, $key = NULL)
		{
			global $key;
			global $value = array();
			
			include('dbconnection.php');
			$result = $mysqli->query('SELECT * FROM map_nodes WHERE ');
		}
		
		public function getLocation()
		{
			
		}
		
		public function getKey()
		{
		
		}
	}
?>