<?php
	class Support_Request
	{
		function __construct($prov_rid, $get_notes = false)
		{
			global $rid;
			global $status;
			global $sender;
			global $notes;
			global $type;
			global $summary;
			global $created_on;
			global $moodle_page;
			global $objects;
			
			
			
			
			include('dbconnection.php');
			
			$result = $mysqli->query('SELECT * FROM support_requests WHERE rid = '.$prov_rid);
			if($result->num_rows == 0)
			{
				header('location: ../errors/request_error.php?e=Can\'t find report');
			}
			elseif($result->num_rows > 1)
			{
				header('location: ../errors/request_error.php?e=Ambiguous Reports');	
			}
			else
			{
				// Assume everything works
				$raw = $result->fetch_object();
				$this->rid = $prov_rid;
				$this->type = $raw->type;
				require_once('user.php');
				$this->sender = new User($raw->uid);
				$this->created_on = $raw->created_on;
				$this->summary = $raw->summary;
				$result = $mysqli->query('SELECT * FROM support_status WHERE rid = '.$prov_rid.' ORDER BY date_set DESC');				
				if($result->num_rows == 0)
				{
					header('location: ../errors/request_error.php?e=No Records Found');
				}
				else
				{
					$raw = $result->fetch_object();
					$this->status = $raw->status;					
				}
				if($this->type == "Moodle")
				{
					$result = $mysqli->query('SELECT * FROM support_moodle WHERE request_id ='.$prov_rid);
					if($result->num_rows != 0)
					{
						$raw = $result->fetch_object();
						require_once('models/moodle.php');
						$this->moodle_page = new MoodleCourse($raw->page_id, true, true);
					}
				}
				$result = $mysqli->query('SELECT * FROM support_notes WHERE rid = '.$prov_rid.' ORDER BY date_sent DESC');
				if($result->num_rows == 0)
				{
					$this->notes = array("No Notes Available");
				}
				else
				{
					$this->notes = array();
					while($raw = $result->fetch_object())
					{
						if($get_notes)
						{
							require_once('support_note.php');
							$note = new Support_Note($raw->note_id);
							$this->objects = $get_notes;
							$notes[] = $note;
						}
						else
						{
							require_once('user.php');
							$note = array('id' => $raw->note_id, 'date' => $raw->date_sent, 'sender' => $sender = new User($raw->sender), 'message' => $raw->message);
							$this->notes[] = $note;
						}
						
					}
				}
			}
		}
		
	}
?>