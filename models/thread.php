<?php
	class Thread
	{
		function __construct($prov_id, $get_users = false, $get_message = true)
		{
			global $thread_id;
			global $topic;
			global $messages;
			global $created_on;
			include('dbconnection.php');
			
			$this->thread_id = $prov_id;
			$result = $mysqli->query('SELECT * FROM threads WHERE thread_id = '.$this->thread_id);
			if($result->num_rows == 0)
			{
				header('location: ../errors/thread_error.php?e=Thread Not Found');
			}
			elseif($result->num_rows == 1)
			{
				$raw = $result->fetch_object();
				$this->topic = $raw->thread_topic;
				$this->created_on = $raw->created_on;
				
				$result = $mysqli->query('SELECT * FROM messages WHERE thread_id ='.$this->thread_id.' ORDER BY sent_on DESC');
				if($result->num_rows == 0)
				{
					$this->messages = "There are no messages for this thread";
				}
				else
				{
					$this->messages = array();
					while($raw = $result->fetch_object())
					{
						if($get_message)
						{
							require_once('message.php');
							$message = new Message($raw->message_id, true);
						}
						else
						{
							if($get_users)
							{
								require_once('user.php');
								$user = new User($raw->sender);
								$target = new User($raw->recipient);
							}
							else
							{
								$user = $raw->sender;
								$target = $raw->recipient;
							}
							$message = array('message_id' => $raw->message_id, 'sender' => $user, 'recipient' => $target, 'content' => $raw->message, 'created_on' => $raw->sent_on);
						}
						$this->messages[] = $message;
					}
				}
			}
		}
	}
?>