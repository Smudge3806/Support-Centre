<?php
	class Message
	{	
		function __construct($prov_id, $get_user = false)
		{
			global $message_id;
			global $thread_id;
			global $sender;
			global $recipient;
			global $content;
			global $sent_on;
			include('dbconnection.php');
			$result = $mysqli->query('SELECT * FROM messages WHERE message_id = '.$prov_id);
			if($result->num_rows > 1)
			{
				header('location: ../errors/message_error.php?e=Ambiguous Message');
			}
			elseif($result->num_rows == 0)
			{
				header('location: ../errors/message_error.php?e=Missing Message');
			}
			else
			{
				$raw = $result->fetch_object();
				$this->message_id = $raw->message_id;
				$this->thread_id = $raw->thread_id;
				if($get_user)
				{
					require_once('user.php');
					$this->sender = new User($raw->sender);
					$this->recipient = new User($raw->recipient);
				}
				else
				{
					$this->sender = $raw->sender;
					$this->recipient = $raw->recipient;
				}
				$this->content = $raw->message;
				$this->sent_on = $raw->sent_on;
				
			}
		}
	}
?>