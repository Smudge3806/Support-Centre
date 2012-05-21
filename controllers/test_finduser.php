<?php
	include('dbconnection.php');
	$result = $mysqli->query('SELECT * FROM users WHERE CONCAT(first_name, " ", last_name) LIKE "%'.$_POST['name'].'%"');
	if($result->num_rows != 0)
	{
		?>
		<table>
			<tr>
				<th>Username</th>
				<th>Email Address</th>
			</tr>
		<?php
		while($raw = $result->fetch_object())
		{
			?>
			<tr>
				<td><?php echo $raw->first_name." ".$raw->last_name; ?></td>
				<td><?php echo $raw->email_address; ?></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}
	else
	{
		echo "There are no records that match ".$_POST['name'];
	}
?>