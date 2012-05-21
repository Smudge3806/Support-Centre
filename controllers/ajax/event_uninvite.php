<?php 
	// event_uninvite.php
	include('../dbconnection.php');
	if(isset($_GET['eid']))
	{
		$mysqli->query('DELETE * FROM training_register WHERE register_id = '.eid);
	}
?>