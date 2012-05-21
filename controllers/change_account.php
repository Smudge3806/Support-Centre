<?php
	include('dbconnection.php');
	$page = $_POST['page'];
	$type = $_POST['type'];
	$mysqli->query('UPDATE users SET account = "'.$type.'" WHERE uid = '.$_POST['uid']);
	header('location: ../'.$page.'?id='.$_POST['uid'].'&m=Account type Changed');
?>