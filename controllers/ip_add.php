<?php
	$ip = $_SERVER['REMOTE_ADDR'];
	$_SESSION['ip'] = $ip;
	$uid = $row->uid;
	$test = $mysqli->query("SELECT * FROM ip_logs WHERE uid = {$uid}");
	if($test->num_rows == 0)
	{
		$mysqli->query("INSERT INTO ip_logs (uid, ip_address) VALUES ({$uid}, '{$ip}')");
		if($mysqli->affected_rows == 0)
		{
			header('location: login.php?e=4');
		}
	}
?>