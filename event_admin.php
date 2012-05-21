<?php
	include('controllers/is_logged_in.php');
	if(isset($_GET['id']))
	{
		require_once('models/training_event.php');
		$event = new Training_Event($_GET['id']);
	}
	else
	{
		header('location: index.php?m=No ID set');	
	}
	
	
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Training Event - Support Centre</title>
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/event.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/notes.css">
<link rel="icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico" type="image/x-icon">
<?php include('scripts/import_fancybox.php'); ?>
<?php
	if(isset($_GET['fbm']))
	{
		?>
	<script type="text/javascript">
		$(document).ready(function(){
			 $("#hidden_link").fancybox().trigger('click');
			 <?php 
			 	if(isset($_GET['fba']))
			 	{
			 		switch($_GET['fba'])
			 		{
			 			case "close":
			 				?>
			 				var t = setTimeout("$.fancybox.close()", 1000);
			 				<?php
			 				break;
			 			case "show":
			 				// Do Nothing atm
			 				break;
			 		}
			 	}
			 ?>
		});
	</script>		
		<?php
	}
?>

<script type="text/javascript">
	
	// Page Load Functions
	
	$(document).ready(function(){
		$("#inline1").fancybox(
		{
		
		});
		$("#inline2").fancybox({
		
		});
		
		// Load Fancy Box Elements
		$('#frame').fancybox({
		});

		$("#hidden_link").fancybox({
		<?php if(isset($_GET['fba']) && $_GET['fba'] == "close")
		{
			echo "'showCloseButton': 'false'";
		}
		?>
		});	
		
		$("#invite").fancybox({
		});
	});
	
	// Javascript
	
	function counter(thisfield)
	{
		$count = thisfield.value.length;
		$left = 500 - $count;
		document.getElementById('count').value = $left;		
	}
	
	function del_event()
	{
		var answer = confirm("Are you sure you want to delete this event?");
		if(answer)
		{
			window.location = 'http://www.barnsley-ltu.co.uk/controllers/delete_event.php?id=<?php echo $_GET['id']; ?>';
		}
	}
	
	function alterAttendance(value, user_id)
	{
		window.location = 'http://www.barnsley-ltu.co.uk/controllers/event_alter_attendance.php?eid=<?php echo $event->id; ?>&uid='+user_id+'&page=events/<?php echo $event->id; ?>&att='+value;
	}
	
	function uninvite(event_id)
	{
		window.location = "http://www.barnsley-ltu.co.uk/controllers/ajax/event_uninvite.php?eid="+event_id;
	}
		
	// AJAX
	
	function confirm_event(value, id)
	{
		var result = sendValue(value, "http://www.barnsley-ltu.co.uk/controllers/ajax/event_confirm.php?eid="+value);
		document.getElementById(id).innerHTML = result;
		var t = setTimeout('$.fancybox.close()', 1000);
	}
	
	function sendValue(value, target)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				return xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", target, true);
		xmlhttp.send();
	}

	// jQuery

	

	
	function invite()
	{
		$("a#frame").fancybox().trigger('click');
	}
	
	
</script>
<style type="text/css">
	.backing
	{
		background-color:white;
		box-shadow:#666 0px 0px 25px;
		border-radius:5px;
		padding:20px;
		margin-bottom:25px;
		margin-left:14px;
		margin-right:14px;
		margin-top:-45px;
		padding-top:65px;
		width:615px !important;
		float:left;
		clear:both;
		width:637px
	}
	
	#first{
		margin-top:-45px;
		padding-top:45px;
	}
	
	
}
</style>
</head>

<body>
	<a href="#message_ui" id="hidden_link" style="display:none">Message</a>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	
	<div class="description">
		<div class="inner" style="margin-top:25px;opacity:0.99;box-shadow:#666 0px 0px 25px">
			<h2 id="title"><?php echo $event->title; ?></h2>
			<p style="margin:0px"><?php echo $event->held_on; ?> - <?php echo $event->location; ?></p>
		</div>
	</div>
	
	<div class="backing" id="first">
		<?php if(!$event->confirmed)
		{
			?>
				<div id="confirm">
					<table>
						<tr>
							<td><a href="#confirm_ui" id="inline1">Confirm this Event</a></td>
						</tr>
					</table>
				</div>
			<?php
		}
		else
		{
		?>
			<table>
				<tr>
					<td><a href="#new_date" id="inline2">Suggest a new date</a></td>
				</tr>
			</table>
		<?php
		}
		?>
		<table>
			<tr>
				<td></td>
				<td><?php echo $event->title; ?></td>
			</tr>
			<tr>
				<td><label>When:</label></td>
				<td>
					<?php echo $event->held_on." - ".$event->held_at;?>
					<?php 
						if($event->held_at == "00:00:00")
						{
							?>
								<form name="time" method="get" action="http://www.barnsley-ltu.co.uk/controllers/event_change_time.php">
									<input type="number" max="17" min="8" name="hours" placeholder="Hours">
									<input type="number" max="59" min="0" step="5" name="minutes" placeholder="Minutes">
									<input type="hidden" name="seconds" value="00">
									<input type="hidden" name="event_id" value="<?php echo $_GET['id']; ?>">								
									<input type="submit" value="Save">
								</form>							
							<?php	
						}
					?>
				</td>
			</tr>
			<tr>
				<td><label>Location:</label></td>
				<td><?php echo $event->location; ?></td>
			</tr>
			<tr>
				<td><label>Booked By:</label></td>
				<td><?php require_once('models/user_link.php'); $link = new User_Link($event->organiser); echo $link->output; ?></td>	
			</tr>
		</table>
	</div>
	
	<div class="side">
		<div class="inner_side" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
			<p>Attendees</p>
		</div>	
	</div>
	
	<div class="backing">
		<div id="register">
			<?php
				if($event->register != "There are no users attending this event")
				{
					include('views/event_attendance.php');
				}
				else
				{
				?>
				<b>There are no users attending this event</b>
				<?php
				}
				?>
		</div>
		<hr>
		<div id="invite">
			<div class="topic-headers">
				<h3 class="title">Invite More Colleagues to this event.</h3>
				<p class="subtitle">If you would like to tell your collegues about this training event click the link below to invite them.</p>
			</div>
			<div style="float:left;clear:both;margin-top:25px">
				<button onclick="invite();" disabled="disabled">Invite Colleague</button>
				<?php if($_SESSION['uid'] == $event->organiser->id || $_SESSION['account'] == "admin"){ ?>
				<button onclick="del_event()">Cancel Event</button>
				<?php } ?>
			</div>
		</div>
	</div>
	
	<div class="side">
		<div class="inner_side" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
			<p>Notice Board</p>
		</div>
	</div>
	
	<div class="backing">
		<!-- notice board -->
		<div id="notes">
			<?php include('views/event_notes.php'); ?>
		</div>
		
		<div id="submit" style="clear:both;float:left">
		<hr>
		<p>Add a note about this event.</p>
			<form action="http://www.barnsley-ltu.co.uk/controllers/event_add_note.php" method="get">
			<table>
				<tr>	
					<td><textarea cols="50" rows="10" name="mess" maxlength="500" placeholder="What do you want to add to this event?" onkeydown="counter(this)"></textarea></td>
					<td><input type="text" readonly="readonly" value="500" id="count" style="width:25px;border:none">Characters</td>
				</tr>
				<tr>
					<td><input type="reset" value="Clear"><input type="submit" value="Send"></td>
					<td><input type="hidden" name="eid" value="<?php echo $_GET['id']; ?>"><input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>"></td>
				</tr> 
			</table>
			</form>
		</div>

	
	</div>
	
	<div style="display:none">
		<div id="confirm_ui">
			<p>Do you want to confirm this event?</p>
			<button onclick="window.location = 'http://www.barnsley-ltu.co.uk/controllers/ajax/event_confirm.php?eid=<?php echo $_GET['id']; ?>&page=event_admin.php'">Confirm</button>
		</div>
		<div id="new_date">
			<p>This feature is disabled at the moment.</p>
		</div>
		<div id="message_ui">
			<p id="message"><?php if(isset($_GET['fbm'])){echo $_GET['fbm'];} ?></p>
		</div>
		<div id="contentUI">
			<a href="http://www.barnsley-ltu.co.uk/windows/test_invite.php?event_id=<?php echo $_GET['id'];?>" id="frame"></a>
		</div>
	</div>
	
	

	
</body>

</html>
