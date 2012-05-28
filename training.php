<?php
	include('controllers/is_logged_in.php');
	include('controllers/dbconnection.php');
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico" >
<title>ILT Training</title>
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/admin_table.css">
</head>

<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
		
		<div class="description">
			<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px;cursor:pointer" onclick="window.location = 'http://www.barnsley-ltu.co.uk/events/new/'">
					<h2 id="title">ILT Training</h2>
					<p style="margin:0px;">Click here to create a new Training Event.</p>
			</div>
		</div>
		
		
		<div class="side">
			<div class="inner_side" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
				<p>Training you have had</p>
			</div>			
		</div>
		
		<div style="float:left;clear:both;background-color:white; border-radius:5px; box-shadow:#666 0px 0px 25px; margin-left:14px; margin-right:14px;padding:10px; padding-top:100px; width:635px; margin-top:-100px">
			<?php
				$results = $mysqli->query('SELECT tr.* FROM training_registers AS tr, training_events AS te WHERE user_id = '.$_SESSION['uid'].' AND tr.event_id = te.event_id ORDER BY te.held_on DESC');
				if($results->num_rows == 0)
				{
					?>
						<p>There is currently no training events booked for you.</p><p>Click <a href="https://www.barnsley-ltu.co.uk/event/new/">here</a> to book a training event.</p>
					<?php
				}
				else
				{
			?>
			<table width="620px" style="max-width:620px;width:620px;">
				<colgroup>
					<col id="training">
					<col id="location">
					<col id="date">
					<col id="booked by">
				</colgroup>
				<thead>
					<tr>
						<th scope="col">Training</th>
						<th scope="col">Location</th>
						<th scope="col">Date</th>
						<th scope="col">Booked By</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						while($raw = $results->fetch_object())
						{
							require_once('models/training_event.php');
							$event = new Training_Event($raw->event_id, true);
						?>
					<tr>
						<td><a href="https://www.barnsley-ltu.co.uk/events/<?php echo $event->id; ?>/"><?php echo $event->title; ?></a></td>
						<td><?php echo $event->location; ?></td>
						<td><?php require_once('models/datetime.php'); $date = new TimeStamp($event->held_on); echo $date->str_date; ?></td>
						<td><a href="https://www.barnsley-ltu.co.uk/users/<?php echo $event->organiser->id; ?>"><?php echo $event->organiser->username; ?></a></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
			<?php } ?>
		</div>
	
	
	<?php
		include('views/page_footer.php');
	?>

</body>

</html>
