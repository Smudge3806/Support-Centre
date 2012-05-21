<?php
	include('controllers/is_logged_in.php');
	if(!isset($_SESSION['account']) == "admin")
	{
		header('location: profile.php');
	}
	include('controllers/dbconnection.php');
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Test Thread</title>
</head>

<body>
	<h1>Test Thread</h1>
	
	<p>Setting Up</p>
	<?php
		echo "<b>CONSOLE: </b>Creating Thread<br>";
		$mysqli->query('INSERT INTO threads (thread_topic) VALUES ("Test")');
		$num = $mysqli->insert_id;
		if($num != 0)
		{
			echo "<b>CONSOLE: </b>Thread Created<br><b>CONSOLE: </b>Creating Messages...<br>";
			$mysqli->query('INSERT INTO messages (thread_id, sender, recipient, message) VALUES ('.$num.', 1, 31, "Test: First Message"), ('.$num.', 31, 1, "Test: Second Message")');
			if(isset($mysqli->affected_rows))
			{
				require_once('models/thread.php');
				$test = new Thread($num);
				echo "<b>CONSOLE: </b>Messages Created<br><b>CONSOLE: </b>Object Called<br>";
				echo $test->topic."<br>";
				echo $test->created_on."<br>";
				$x = 0;
				while($x != count($test->messages))
				{
					$array = $test->messages[$x];
					echo "<br>";
					echo "Message ".$array->message_id."<br>";
					echo "Sender: ".$array->sender->username."<br>";
					echo "Recipient: ".$array->recipient->username."<br>";
					echo "Message: ".$array->content."<br>";
					echo "<br>";
					$x++;
				}
				echo "<b>CONSOLE: </b>Cleaning Up<br>";
				$mysqli->query("DELETE FROM messages WHERE thread_id = ".$test->thread_id);
				$mysqli->query("DELETE FROM threads WHERE thread_id = ".$test->thread_id);				
			}
			else
			{
				$mysqli->query('DELETE FROM threads WHERE thread_id = '.$num);
				echo "<b>Test Failed</b>";
			}
		}
		else
		{
			echo "<b>Test Failed</b>";
		}
	?>
</body>

</html>
