<?php
	include('dbconnection.php');
	if(!isset($_POST['message']))
	{
		header('location: ../'.$_POST['page'].'?m=Enter a Message');
	}
	if(!isset($_POST['page']))
	{
		session_start();
		switch($_SESSION['account'])
		{
			case "admin":
				$page = "index.php";
				break;
			case "user":
				$page = "profile.php";
		}
	}
	else
	{
		$page = $_POST['page'];
	}	
	$thread = 1;
	if(isset($_POST['thread']))
	{
		$thread = $_POST['thread'];
		echo "old thread<br>";
	}
	else
	{
		echo "new thread ";
		$mysqli->query('INSERT INTO threads (thread_topic) VALUES ("'.$_POST['topic'].'")');
		$thread = $mysqli->insert_id;
		echo "created<br>";
	}
		echo "thread: ";
		if(isset($thread))
		{
			var_dump($thread);
		}
		else
		{
			echo "oops";
		}
		echo "<br>";
	if(isset($_POST['sender'], $_POST['recipient']))
	{
		$mysqli->query('INSERT INTO messages (thread_id, sender, recipient, message) VALUES ('.$thread.', '.$_POST['sender'].', '.$_POST['recipient'].', "'.$_POST['message'].'")');
		if($mysqli->affected_rows != 0)
		{
			/*require_once('../models/user.php');
			$sender = new User($_POST['sender']);
			var_dump($sender);
			$recipient = new User($_POST['recipient']);
			$mysqli->query('INSERT INTO notifications (message, target_user) VALUES ("'.$sender->username.' has sent you a message. Click [link thread.php?id='.$mysqli->insert_id.' here] to see it.", '.$recipient->id.')');
			*/
			require_once('../models/user.php');
			$user = new User($_POST['recipient']);
			var_dump($user);
			$sender = new User($_POST['sender']);	
			/*$to = $user->email;
			$subject = "New Message on Barnsley SupportCentre";
			$message = $sender->username." has sent you a message on SupportCentre";
			echo "hello";
			$email = mail($to, $subject, $message);*/
			require_once('../models/daemon.php');
			$email = new Daemon($sender->username, $user->email, "new message", true);
			
			unset($user, $email);
			
			header('location: ../'.$page.'?m=Message Sent');
					}
		else
		{
			echo "Error<br>";
			var_dump($_POST);
			echo "<br><br>";
			var_dump($mysqli);
		}
	}
	else
	{
		header('location: ../'.$page.'?m=Please Enter a Recipient');	
	}
?>