<?php
	include('dbconnection.php');
	session_start();
	$cat = $_POST['cat'];
	//echo $cat;
	if(isset($_POST['user']))
	{
		$uid = $_POST['user'];	
	} 
	else
	{
		$uid = $_SESSION['uid'];
	}
	//echo $uid;
	switch($cat)
	{
		case "Moodle":
						
			
				//echo "<b>CONSOLE:</b> Record Saved<br/>";
				$rid = $mysqli->insert_id;
				$result = $mysqli->query('SELECT * FROM users WHERE uid ='.$uid);
				$user = $result->fetch_object();
				
				$did = $user->department_id;
			//	echo $did;
				$result = $mysqli->query('SELECT l.* FROM locations AS l, departments AS d WHERE l.lid = d.location AND d.did = '.$did);
				$location = $result->fetch_object();
				$location = $location->location;
			//	echo $location;
				
				$page_id = $_POST['course'];
				$summary = $_POST['summary'];
				
				$mysqli->query('INSERT INTO support_requests (type, summary, uid) VALUES ("'.$cat.'", "'.$summary.'", '.$uid.')');
				$rid = $mysqli->insert_id;
				$mysqli->query('INSERT INTO support_status (rid) VALUES ('.$rid.')');
				$mysqli->query('INSERT INTO support_moodle (page_id, request_id) VALUES ('.$page_id.', '.$rid.')');
				
				if(isset($_POST['note']))
				{
					$mysqli->query('INSERT INTO support_notes (rid, sender, message) VALUES ('.$rid.', '.$uid.', "'.$_POST['note'].'")');
					$insert_id = $mysqli->insert_id;
				}
				
			if($mysqli->affected_rows == 1)
			{	
				require_once('../models/daemon.php');
				require_once('../models/user.php');
				$user = new User($uid);
				$result = $mysqli->query('SELECT * FROM get_support_officers WHERE did = '.$user->department);
				$row = $result->fetch_object();
				$sup_email = new User($row->uid);
				$email = new Daemon($user->username, $sup_email->email, "new support", true);
				$email = new Daemon($sup_email->username, $user->email, "new support", true, $insert_id);
				$mysqli->kill;
				unset($user, $sup_email, $email, $mysqli, $insert_id); 
			
				if($_SESSION['account'] == "admin")
				{
					header('location: http://www.barnsley-ltu.co.uk/user/'.$uid.'/admin');
				}
				else
				{
					header('location: http://www.barnsley-ltu.co.uk/user');
				}
			}
			else
			{
				echo "<b>CONSOLE:</b> Record Save Error<br/>";
				var_dump($mysqli);
			}
			break;
		case "Promethean":
		//	echo "<b>CONSOLE:</b> Record Saved<br/>";
				$rid = $mysqli->insert_id;
				$result = $mysqli->query('SELECT * FROM users WHERE uid ='.$uid);
				$user = $result->fetch_object();
				
				$did = $user->department_id;
		//		echo $did;
				$result = $mysqli->query('SELECT l.* FROM locations AS l, departments AS d WHERE l.lid = d.location AND d.did = '.$did);
				$location = $result->fetch_object();
				$location = $location->location;
		//		echo $location;
				
				$summary = "Application: ".$_POST['applications']."<br>State: ".$_POST['software']."<br><br>".$_POST['description'];
				
				$mysqli->query('INSERT INTO support_requests (type, summary, uid) VALUES ("'.$cat.'", "'.$summary.'", '.$uid.')');
				$rid = $mysqli->insert_id;
				$mysqli->query('INSERT INTO support_status (rid) VALUES ('.$rid.')');
								
				if(isset($_POST['further']))
				{
					$mysqli->query('INSERT INTO support_notes (rid, sender, message) VALUES ('.$rid.', '.$uid.', "'.$_POST['further'].'")');
					$insert_id = $mysqli->insert_id;
				}
				
			if($mysqli->affected_rows == 1)
			{	
				require_once('../models/daemon.php');
				require_once('../models/user.php');
				$user = new User($uid);
				$result = $mysqli->query('SELECT * FROM get_support_officers WHERE did = '.$user->department);
				$row = $result->fetch_object();
				$sup_email = new User($row->uid);
				$email = new Daemon($user->username, $sup_email->email, "new support", true);
				$email = new Daemon($sup_email->username, $user->email, "new support", true, $insert_id);
				$mysqli->kill;
				unset($user, $sup_email, $email, $mysqli, $insert_id); 
			
				if($_SESSION['account'] == "admin")
				{
					header('location: http://www.barnsley-ltu.co.uk/user/'.$uid.'/admin');
				}
				else
				{
					header('location: http://www.barnsley-ltu.co.uk/user');
				}
			}
			else
			{
				echo "<b>CONSOLE:</b> Record Save Error<br/>";
				var_dump($mysqli);
			}
		
			break;
		case "General":
		//	echo "<b>CONSOLE:</b> Record Saved<br/>";
				$rid = $mysqli->insert_id;
				$result = $mysqli->query('SELECT * FROM users WHERE uid ='.$uid);
				$user = $result->fetch_object();
				
				$did = $user->department_id;
		//		echo $did;
				$result = $mysqli->query('SELECT l.* FROM locations AS l, departments AS d WHERE l.lid = d.location AND d.did = '.$did);
				$location = $result->fetch_object();
				$location = $location->location;
		//		echo $location;
				
				$summary = "Nature of Problem: ".$_POST['nature']."<br><br>".$_POST['description'];
				
				$mysqli->query('INSERT INTO support_requests (type, summary, uid) VALUES ("'.$cat.'", "'.$summary.'", '.$uid.')');
				$rid = $mysqli->insert_id;
				$mysqli->query('INSERT INTO support_status (rid) VALUES ('.$rid.')');
								
				if(isset($_POST['further']))
				{
					$mysqli->query('INSERT INTO support_notes (rid, sender, message) VALUES ('.$rid.', '.$uid.', "'.$_POST['further'].'")');
					$insert_id = $mysqli->insert_id;
				}
				
			if($mysqli->affected_rows == 1)
			{	
				require_once('../models/daemon.php');
				require_once('../models/user.php');
				$user = new User($uid);
				$result = $mysqli->query('SELECT * FROM get_support_officers WHERE did = '.$user->department);
				$row = $result->fetch_object();
				$sup_email = new User($row->uid);
				$email = new Daemon($user->username, $sup_email->email, "new support", true);
				$email = new Daemon($sup_email->username, $user->email, "new support", true, $insert_id);
				$mysqli->kill;
				unset($user, $sup_email, $email, $mysqli, $insert_id); 
			
				if($_SESSION['account'] == "admin")
				{
					header('location: http://www.barnsley-ltu.co.uk/user/'.$uid.'/admin');
				}
				else
				{
					header('location: http://www.barnsley-ltu.co.uk/user');
				}
			}
			else
			{
				echo "<b>CONSOLE:</b> Record Save Error<br/>";
				var_dump($mysqli);
			}
			break;
	}
?>