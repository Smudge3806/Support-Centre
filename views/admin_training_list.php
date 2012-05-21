<?php
	include('controllers/dbconnection.php');
	$result = $mysqli->query('SELECT * FROM users WHERE type = "admin" AND uid != 35');
	unset($mysqli);
	while($trng_user = $result->fetch_object())
	{
		?>
		<a style="cursor:pointer" rel="<?php echo $trng_user->first_name; ?>Training" onclick="showTraining(this)"><?php echo $trng_user->first_name." ".$trng_user->last_name; ?></a>
		<?php
	}
?>