<?php
	if(isset($_POST['addr']))
		{
			if(isset($_GET['no-class']))
			{
			
				$to = $_POST['addr'];
				$subject = "Barnsley LTU - Mail Setup";
				$filename = "test.txt";
				$message = file_get_contents($filename, FILE_USE_INCLUDE_PATH);
				
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
				$sent = mail($to, $subject, $message, $headers);
				if($sent)
				{
					echo "Test Sent";
				}
				else
				{
					echo "Something didn't work!";
				}	
		
			}
			else
			{
				require_once('daemon.php');
				$mailer = new Daemon($_POST['addr'], "new suppport");
				$sent = $mailer->send();
				if($sent)
				{
					echo "Test Sent";
					var_dump($mailer);
				}
				else
				{
					echo "Something didn't work!";
					var_dump($mailer);
				}
			}
	
		}
		else
		{
			echo "Enter target email below";
		}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Mail Tester</title>
</head>

<body>
	<form name="target" method="post">
		<input type="email" name="addr" required placeholder="Target Email Address"><br>
		<input type="submit" value="Start Test">
	</form>
</body>

</html>
