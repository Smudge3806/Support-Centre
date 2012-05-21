<?php
	session_start();
	if(isset($_SESSION['uid']))
	{
		$isLoggedIn = true;
	}
	else
	{
		//require_once('models/map.php');
		//$map = new Map($_SERVER['PHP_SELF']);
		//header('location: login.php?e=5&p='.$map->currentNode->nodeKey);
		header('location: http://www.barnsley-ltu.co.uk/login/e/5');
	}
?>