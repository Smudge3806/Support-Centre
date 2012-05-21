<?php
	include('dbconnection.php');
	$department_list = $mysqli->query('SELECT * FROM departments');
?>