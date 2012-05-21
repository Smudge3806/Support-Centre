<?php
	include('controllers/dbconnection.php');
	$results = $mysqli->query('SELECT * FROM training_sessions ORDER BY title ASC');
	if($results->num_rows == 0)
	{
		?>
			<option value="0">Create a new Event Title</option>
		<?php
	}
	else
	{
		?>
			<option value="0">Select a Title...</option>
		<?php
		while($raw = $results->fetch_object())
		{
			?>
				<option value="<?php echo $raw->session_id; ?>"><?php echo $raw->title; ?></option>
			<?php
		}
	}
?>