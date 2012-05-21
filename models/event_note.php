<?php
	class Event_Note
	{
		function __construct($prov_id, $get_user = false)
		{
			global $id;
			global $sender;
			global $event_id;
			global $message;
			global $sent_on;
			include('dbconnection.php');
			$result = $mysqli->query('SELECT * FROM training_notes WHERE note_id = '.$prov_id);
			if($result->num_rows == 0)
			{
				var_dump($mysqli);
			}
			else
			{
				$raw = $result->fetch_object();
				$this->id = $prov_id;
				if($get_user)
				{
					require_once('user.php');
					$this->sender = new User($raw->sender_id);
				}
				else
				{
					$this->sender = $raw->sender_id;
				}
				$this->event_id = $raw->event_id;
				$this->message = $raw->message;
				require_once('datetime.php');
				$this->sent_on = new TimeStamp($raw->sent_on);
				$mysqli->kill;
				unset($mysqli);
			}
		}
	}
?>