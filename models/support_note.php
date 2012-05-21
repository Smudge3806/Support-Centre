<?php
	class Support_Note
	{
		function __construct($nid, $get_user = false)
		{
			global $id;
			global $sender;
			global $message;
			global $date_sent;
			include('dbconnection.php');
			$result = $mysqli->query('SELECT * FROM support_notes WHERE note_id ='.$nid);
			if($result->num_rows > 1)
			{
				header('location: ../errors/notes_error.php?e=Ambiguous Notes');
			}
			elseif($result->num_rows == 0)
			{
				header('location: ../errors/notes_error.php?e=Note Not Found');
			}
			else
			{
				$raw = $result->fetch_object();
				$this->id = $nid;
				if(isset($get_user))
				{
					require_once('user.php');
					$this->sender = new User($raw->sender);
				}
				else
				{
					$this->sender = $raw->sender;
				}
				$this->message = $raw->message;
				$this->date_sent = $raw->date_sent;
			}
		}
	}
?>