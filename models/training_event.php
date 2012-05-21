<?php
	class Training_Event
	{
		function __construct($prov_id, $get_objects = false)
		{
			global $id;
			global $title;
			global $level;
			global $organiser;
			global $location;
			global $arranged_on;
			global $held_on;
			global $held_at;
			global $confirmed;
			global $notes;
			global $register;
			
			include('dbconnection.php');
			
			$result = $mysqli->query('SELECT * FROM training_events WHERE event_id = '.$prov_id);
			if($result->num_rows == 0)
			{
				header('location: ../errors/event_error.php?e=Event Not Found');
			}
			elseif($result->num_rows > 1)
			{
				header('location: ../errors/event_error.php?e=Ambiguous Events');
			}
			else
			{
				$raw = $result->fetch_object();
				require_once('user.php');
				$this->id = $prov_id;
				$this->organiser = new User($raw->organiser_id);
				if(isset($raw->held_on))
				{
					$this->held_on = $raw->held_on;
				}
				else
				{
					$this->held_on = "TBC";
				}
				if(isset($raw->held_at))
				{
					$this->held_at = $raw->held_at;
				}
				else
				{
					$this->held_at = "TBC";
				}
				$this->arranged_on = $raw->arranged_on;
				if(isset($raw->location))
				{
					$this->location = $raw->location;
				}
				else
				{
					$this->location = "A Location has not been set";
				}
				if($raw->confirmed == 0)
				{
					$this->confirmed = false;
				}
				else
				{
					$this->confirmed = true;
				}
				
			}
			$sess = $raw->session_id;
			$result = $mysqli->query('SELECT * FROM training_sessions WHERE session_id = '.$sess);
			if($result->num_rows == 0)
			{
				header('location: ../errors/event_error.php?e=Session Data Missing');
			}
			elseif($result->num_rows > 1)
			{
				header('location: ../errors/event_error.php?e=Ambiguous Session Data');
			}
			else
			{
				$raw = $result->fetch_object();
				$this->title = $raw->title;
				switch($raw->weighting)
				{
					case 500:
						$this->level = "Novice";
						break;
					case 1000:
						$this->level = "Intermediate";
						break;
					case 1500:
						$this->level = "Advanced";
						break;
					case 2000:
						$this->level = "Expert";
						break;				
				}				
			}
			
			$result = $mysqli->query('SELECT * FROM training_registers WHERE event_id = '.$prov_id);
			if($result->num_rows == 0)
			{
				$this->register = "There are no users attending this event";
			}
			else
			{
				$this->register = array();
				while($raw = $result->fetch_object())
				{
					$att = $raw->attending;
					require_once('user.php');
					$entry = array('id' => $raw->register_id, 'user' => $user = new User($raw->user_id), 'invited_by' => $inviter = new User($raw->invited_by), 'invited_on' => $raw->invited_on, 'attending' => $att);
					$this->register[] = $entry;
					$x++;
					
				}
			}
			
			// get notes
			
			$result = $mysqli->query('SELECT * FROM training_notes WHERE event_id = '.$prov_id.' ORDER BY sent_on DESC');
			if($result->num_rows == 0)
			{
				$this->notes = "There are no notes for this event.";
			}
			else
			{
				$this->notes = array();
				while($raw = $result->fetch_object())
				{
					require_once('event_note.php');
					$note = new Event_Note($raw->note_id, true);
					$this->notes[] = $note;
				}
			}	
			
		}// end function
	}
?>