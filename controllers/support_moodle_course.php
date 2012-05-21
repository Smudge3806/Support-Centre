<?php
	if(isset($_GET['id']))
	{
		session_start();
		$_SESSION['data'] = $_GET['id'];
		echo "<p>Data Saved</p>";
	}
?>