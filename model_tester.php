<?php 
	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
	}
	else
	{
		$id = 1;
	}
	include('controllers/dbconnection.php');
	
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Model Tester</title>
</head>

<body>
	<?php
		require_once('models/user.php');
		echo "<div style='float:left'>Beginning Test<br/>";
		$user = new User($id, true, true);
		echo "<b>Username: </b>".$user->username."<br/>";
		echo "<b>Extension: </b>".$user->telephone."<br/>";
		echo "<b>Email Address: </b>".$user->email."<br/>";
		echo "<b>Department Name: </b>".$user->department->name."<br/>";
		echo "<b>Location: </b>".$user->department->location."<br/>";
		echo "<b>Support Officer: </b>".$user->department->support_officer->username."<br style='padding-bottom:20px' /></div>";
		?>
			<div style="float:left; clear:right; display:block; padding-left:25px;">
				<?php if(isset($_GET['m'])){ echo "<b>".$_GET['m']."</b>";} ?>
				<p>Try a different user!</p>
				<form method="post" action="model_tester.php">
					<input type="text" name="id" >
					<input type="submit" value="Test" >
				</form>
			</div>
		<?php
		$result = $mysqli->query('SELECT * FROM support_requests WHERE uid ='.$user->id);		
		echo "<div style='float:left;clear:left'>";
		echo "<h3>Your Support Requests</h3><hr/>";
		if($result->num_rows == 0)
		{
			echo "<b>There are no support requests for this user</b><br/>";
		}
		else
		{
			while($raw = $result->fetch_object())
			{
				require_once('models/support_request.php');
				$request = new Support_Request($raw->rid);
				
				echo "<b>Request ID: </b>".$request->rid."<br/>";
				echo "<b>Request Type: </b>".$request->type."<br/>";
				echo "<b>Request Summary: </b>".$request->summary."<br/>";
				echo "<b>Request Created: </b>".$request->created_on."<br/>";
				echo "<b>Request Status: </b>".$request->status."<br/>";
				$x = 0;
				while($x != count($request->notes))
				{
					$note = $request->notes[$x];
					
					if($request->objects)
					{
						echo "worked";
					}
					elseif($note == "No Notes Available")
					{
						echo "<br/><b>".$note."</b>";
						break 2;
					}
					else
					{
						echo "<br/><b>Note ID: </b>".$note['id']."<br/>";
						echo "<b>Note Content: </b>".$note['message']."<br/>";
						echo "<b>Note Sender: </b>".$note['sender']->username."<br/>";
						echo "<b>Note Sent: </b>".$note['date']."<br style='padding-bottom:20px'/>";
					}
					$x++;
				}
				echo "<hr/>";
			}
		}
		echo "</div>";
		
		echo "<div style='float:left;padding-left:25px'>";
		echo "<h3>Events You've Organised</h3><hr/>";
		$result = $mysqli->query("SELECT * FROM training_events WHERE organiser_id = ".$user->id);
		if($result->num_rows == 0)
		{
			echo "<b>There are no training records for this user</b><br/>";
		}
		else
		{	
			while($raw = $result->fetch_object())
			{
				require_once('models/training_event.php');
				$training = new Training_Event($raw->event_id);
				echo "<b>Event ID: </b>".$training->id."<br/>";
				echo "<b>Event Title: </b>".$training->title."<br/>";
				echo "<b>Event Level: </b>".$training->level."<br/>";
				echo "<b>Event Organiser: </b>".$training->organiser->username."<br/>";
				echo "<b>Event Date: </b>".$training->held_on."<br/>";
				$bool = "No";
				if($training->confirmed)
				{
					$bool = "Yes";
				}
				echo "<b>Event Confirmed: </b>".$bool."<br/>";
				echo "<br/><b>Attending Users</b><br/>";
				$x = 0;
				while($x != count($training->register))
				{
					$entry = $training->register[$x];
					if($entry == "There are no users attending this event")
					{
						echo "<br/><b>There are no users attending this event</b><br/>";
						break 2;
					}
					else
					{
						$att = "No";
						if($entry['attending'])
						{
							$att = "Yes";
						}
						$con = "No";
						if($entry['confirmed'])
						{
							$con = "Yes";
						}
						echo "<b>Attendee: </b>". $x ."<br/>";
						echo "<b>Name: </b>".$entry['user']->username."<br/>";
						echo "<b>Invited By: </b>".$entry['invited_by']->username."<br/>";
						echo "<b>Confirmed: </b>".$con."<br/>";
						echo "<b>Attending: </b>".$att."<br/>";
						echo "<br/>";					
					}
					$x++;				
				}
				echo "<hr/>";			
			}
		}
		
		echo "</div>";
		echo "<div style='float:left;padding-left:25px'><h3>Events You've been Invited To</h3><hr/>";
		$result = $mysqli->query('SELECT * FROM training_registers WHERE user_id ='.$user->id);
		if($result->num_rows == 0)
		{
			echo "<b>There are no invites for this user</b><br/>";
		}
		else
		{
			while($raw = $result->fetch_object())
			{
				
				require_once('models/training_event.php');
				$event = new Training_Event($raw->event_id);
				echo "<b>Title: </b>".$event->title."<br/>";
				echo "<b>Held On: </b>".$event->held_on."<br/><br/>";
				$x = 0;
				while($x != count($training->register))
				{
					$entry = $training->register[$x];
					if($entry['user']->id == $user->id)
					{
						echo "<b>Invited By: </b>".$entry['invited_by']->username."<br/>";
					}
					$x++;	
				}
				echo "<hr/>";
			}	
		}
		echo "</div>";
		
	?>
	<div style="float:left;clear:left">
	<br>End of Test<br>
	</div>
</body>

</html>
