<?php
	if(isset($_POST['mess']))
	{
		include('dbconnection.php');
		$mysqli->query('INSERT INTO support_notes (rid, sender, message) VALUES ('.$_POST['suppID'].', '.$_POST['uid'].', "'.$_POST['mess'].'")');
		var_dump($mysqli);
		$mysqli->kill;
		unset($mysqli);
	}
	header('location: ../support/'.$_POST['suppID']);
?>