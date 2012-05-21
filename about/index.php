<!DOCTYPE html>
<html>
<?php 	
	include('../site_data/data.php');
	$mysqli = @new Mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($mysqli->connect_error) 
	{
    	die('Connect Error: ' . $mysqli->connect_error);
	}	

	 
	$isUser = true;
	$uid = 31;
	require_once('../models/user.php');
	$new_user = new User($uid, true);
?>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Coming Soon! - Support Centre</title>
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
<script src="http://bxslider.com/sites/default/files/jquery.bxSlider.min.js" type="text/javascript"></script>
<script type="text/javascript">
// Support Request Slider
 $(function(){
  $('#slider1').bxSlider({
    auto: true, controls: false, speed: 2000, pause: 5000
  });
});	
// Training Request Slider
$(function(){
  $('#slider2').bxSlider({
    auto: true, controls: false, speed: 2000, pause: 5000
  });
});
</script>

</head>

<body>
	<?php include('../views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('../views/metro_navigation.php'); ?>
	</div>
	<div class="description">
		<div class="inner">
			<h2 id="title">This is Your Profile!</h2>
			<p id="inner_description">It's the first thing that you see and it's where you can access all of the ILT Support you need. No menus!</p>
		</div>
	</div>
	<div class="marketing_profile">
		<div>
	<?php
		if($isUser)
		{
			$results = $mysqli->query("SELECT * FROM messages WHERE recipient =".$new_user->id);
			if($results->num_rows != 0)
			{
				$notif_num = "(".$results->num_rows.")";			
			}		
			else
			{
				$notif_num = NULL;
			}
		} 
		if(!$isUser)
		{
			if(isset($list))
			{
				$username = $user->first_name." ".$user->last_name;
				$uid = $user->uid;
				 
			}
	?>
<div class="metro" style="width:620px;">
		<div style="float:left;">
			<div id="tile" style="clear:none">
				<p id="name" style="margin:0px;font-weight:normal;"><a href="demo_register.php" style="text-decoration:none;color:white"><?php echo $new_user->username; ?></a></p>
				<i style="font-size:small" id="name"><a href="demo_register.php" style="text-decoration:none;color:white"><?php echo $new_user->department->name; ?></a></i>
			</div>
			<div id="small-long"><a href="demo_register.php" title="Click to Invite">Invite to Training</a></div>
			<div id="small-long">Coming Soon!</div>
		</div>
		<?php
		}else{
	?>
	
<div class="metro" style="width:620px">
			<div style="float:left"><div id="tile">
				<p id="name" style="margin:0px;font-weight:normal;"><a href="demo_register.php" style="text-decoration:none;color:white"><?php echo $new_user->username; ?></a></p>
				<i style="font-size:small" id="name"><a href="demo_register.php" style="text-decoration:none;color:white"><?php echo $new_user->department->name; ?></a></i>
			</div>
			<div id="small-long"><a href="demo_register.php" title="Click here to request a training event">Request Training</a></div>
			<div id="small-long"><a href="demo_register.php" title="Submit a Support Request to your Support Officer">Request Support</a></div>
			</div><div style="float:left;">
			<div id="small-long" style="float:left;"><a href="demo_register.php" title="Click here to contact your support officer">Contact Your Support Officer</a></div>
			<div id="small-long"><a href="demo_register.php" title="Click here to see the latest news">Inbox <?php echo $notif_num; ?></a></div></div>
		</div>
<?php
		}
	?>

</div>
	</div>
	<div class="description">
		<div class="inner">
			<h2 id="title">Your Training, Your Support.</h2>
			<p id="inner_description">Here you can access all of your training and support requests or simply view the most recent requests!</p>
		</div>
	</div>
	<div class="marketing_profile">
	<div id="skills" style="clear:both;float:left">
		<div class="topic-headers">
			<h2 class="title" style="margin-top:0px">Support and Training</h2>
			<p class="subtitle">Click on the links below to access information about your ILT support &amp; training.</p>
		</div>
		
		<div class="metro" onclick="">

		<div id="tile">
	
		<a href="demo_register.php" title="See your Support Requests">All Support Requests</a>
			<div id="slider1" style="font-size:small;padding-top:20px">
			<?php
				 $requests = $mysqli->query('SELECT * FROM `support_requests` AS sr, `support_status` AS ss WHERE uid = '.$uid);
				 if($requests->num_rows == 0)
				 {
					?>
						<div>
							<p style="margin:0px;padding:0px">You don't have any active Support Requests.</p>
						</div>
						<div>
							<a href="demo_register.php" title="Click here to submit a support request">Click here to Submit a Support Request</a>
						</div>
					<?php
				}
				else
				{ 
										
			?>
				<div>
					<?php
						$requests = $mysqli->query('SELECT * FROM `support_requests` AS sr, `support_status` AS ss WHERE uid = '.$uid.' AND sr.rid = ss.rid AND ss.status = "Inbox" ORDER BY ss.date_set DESC LIMIT 0,2');
						if($requests->num_rows == 0)
						{
							// do nothing
						}
						else
						{
					?>
					<table style="width:230px;text-align:center">
						<tr>
							<th>Summary</th>
							<th>Status</th>
						</tr>
						<?php
							while($raw = $requests->fetch_object())
							{
								require_once('../models/support_request.php');
								$request = new Support_Request($raw->rid);
								if(strlen($request->summary) > 30)
								{
									$summary = substr($request->summary, 0, 26);
									$summary = $summary."...";
								}
								else
								{
									$summary = $request->summary;
								}


						?>
						<tr>
							<td><a href="demo_register.php" title="Click here to see this request"><?php echo $summary; ?></a></td>
							<td><a href="demo_register.php" title="Click here to see this request"><?php echo $request->status; ?></a></td>
						</tr>
						<?php } ?>
					</table>
					<?php } ?>
				</div>
				<div>
					<?php
						$requests = $mysqli->query('SELECT * FROM `support_requests` AS sr, `support_status` AS ss WHERE uid = '.$uid.' AND sr.rid = ss.rid AND ss.status = "Open" ORDER BY ss.date_set DESC LIMIT 0,2');
						if($requests->num_rows == 0)
						{
							//Do Nothing - Go to Next View
						}
						else
						{
					?>
					<table style="width:230px;text-align:center">
						<tr>
							<th>Summary</th>
							<th>Status</th>
						</tr>
						<?php
							while($raw = $requests->fetch_object())
							{
								require_once('../models/support_request.php');
								$request = new Support_Request($raw->rid);
								if(strlen($request->summary) > 30)
								{
									$summary = substr($request->summary, 0, 24);
									$summary = $summary."...";
								}
								else
								{
									$summary = $request->summary;
								}


							?>
								<tr>
									<td><a href="demo_register.php" title="Click here to see this request"><?php echo $summary; ?></a></td>
									<td><a href="demo_register.php" title="Click here to see this request"><?php echo $request->status; ?></a></td>
								</tr>
							<?php
							}
						?>
					</table>
					<?php } ?>
				</div>
				<div>
					<?php
						$requests = $mysqli->query('SELECT * FROM `support_requests` AS sr, `support_status` AS ss WHERE uid = '.$uid.' AND sr.rid = ss.rid AND ss.status = "Closed" ORDER BY ss.date_set DESC LIMIT 0,2');
						if($requests->num_rows == 0)
						{
							//Do Nothing - Go to Next View
						}
						else
						{
					?>
					<table style="width:230px;text-align:center">
						<tr>
							<th>Summary</th>
							<th>Status</th>
						</tr>
						<?php
							while($raw = $requests->fetch_object())
							{
								require_once('../models/support_request.php');
								$request = new Support_Request($raw->rid);
								if(strlen($request->summary) > 30)
								{
									$summary = substr($request->summary, 0, 24);
									$summary = $summary."...";
								}
								else
								{
									$summary = $request->summary;
								}
							?>
								<tr>
									<td><a href="demo_register.php" title="Click here to see this request"><?php echo $summary; ?></a></td>
									<td><a href="demo_register.php" title="Click here to see this request"><?php echo $request->status; ?></a></td>
								</tr>
							<?php
							}
						?>
					</table>
					<?php } ?>
				</div>

				<div>
						<a href="demo_register.php" title="Click here to submit a support request">Click here to Submit a Support Request</a>
				</div>

			<?php 
				} 
			?>
			</div>
		
		</div>
	<div id="tile">
	<a href="demo_register.php" title="See your Training Events">All Training Events</a>
	<div id="slider2" style="font-size:small;padding-top:20px">
			<?php
			$events = $mysqli->query('SELECT * FROM training_registers AS tr, training_events AS te WHERE tr.user_id ='.$uid.' AND te.event_id = tr.event_id ORDER BY te.held_on LIMIT 0, 2');
			if($events->num_rows == 0)
			{
				?>
				<div>
					<p style="margin-top:0px">You don't have any training events coming up.</p>
				</div>
				<div>
					<a href="demo_register.php" title="Click here to create a new Training Event">Click here to create a new Training Event</a>
				</div>
				<?php
			}
			else
			{
		?>
				<div>
					<table>
						
							<?php 
								while($raw = $events->fetch_object())
								{
									require_once('../models/training_event.php'); $event = new Training_Event($raw->event_id); 
							?>
						<tr>
							<td><a href="demo_register.php" title="Click to see this Event"><?php echo $event->title; ?></a></td>
							<td><?php $date = $event->held_on; $date = explode(" ", $date); echo $date[0]; ?></td>
						</tr>
							<?php
								}
							?>
							
						
					</table>
				</div>
				<div>
					<a href="demo_register.php" title="Click here to create a new Training Event">Click here to create a new Training Event</a>
				</div>
	
	
	  	<?php
	  		}
	  	?>
</div>
	</div>
	</div>
	</div>
	</div>
	</div>
</body>

</html>
