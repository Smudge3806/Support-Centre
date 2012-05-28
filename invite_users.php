<?php
	include('controllers/is_logged_in.php');
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Invite Colleagues - Support Centre</title>
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/controls.css">
<link rel="SHORTCUT ICON" href="https://www.barnsley-ltu.co.uk/img/favicon.ico">
<style type="text/css">
	#content{
	background-color:white;
	box-shadow:#666 0px 0px 25px;
	border-bottom-right-radius:5px;
	border-bottom-left-radius:5px;
	float:left;
	clear:both;
	width:604px;
	padding:25px;
	margin-left:14px;
}
h4 a {
	text-decoration:none;
	color:black;
	font-weight:lighter;
}
h4 a:hover{
	text-decoration:underline;
}
</style>
<?php include('scripts/import_fancybox.php'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		// Load Fancy Box Elements
		$('#frame').fancybox({
		});
	});

	function removeuser(userid)
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status==200)
			{
				re_renderTable();
			}
			else if(xmlhttp.readyState == 3 && xmlhttp.status==200)
			{
				document.getElementById('register_container').innerHTML = "<img src='img/loading.gif' alt='Loading' />";
			}
		}
		xmlhttp.open('GET', 'controllers/invite_users_remove.php?e=<?php echo $_GET['event_id']; ?>&uid='+userid, true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send();
		
	}
	
	function re_renderTable()
	{
		var cont;
		if(window.XMLHttpRequest)
		{
			cont = new XMLHttpRequest();
		}
		else
		{
			cont = new ActiveXObject("Microsoft.XMLHTTP");
		}
		cont.onreadystatechange=function()
		{
			if(cont.readyState == 4 && cont.status==200)
			{
				document.getElementById('register_container').innerHTML = cont.responseText;
			}	
			else if(xmlhttp.readyState == 3 && cont.status==200)
			{
				document.getElementById('register_container').innerHTML = "<img src='img/loading.gif' alt='Loading' />";
			}
		
		}
		
		cont.open('GET', 'https://www.barnsley-ltu.co.uk/views/fancybox/events_register_list.php?id=<?php echo $_GET['event_id']; ?>', true);
		cont.send();
	}
	function invite()
	{
		$("a#frame").fancybox().trigger('click');
	}
</script>
</head>
<body>
<?php
	include('views/page_header.php');
?>
<div class="metro" id="navigation">
	<?php include('views/metro_navigation.php'); ?>
</div>
<div style="width:670px;margin-top:25px;">
	<div class="description">
		<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
			<h2 id="title">Invite Colleagues to an Event</h2>
		</div>
	</div>
				
		<div id="content" style="margin-top:-25px">
			<?php 
				if(isset($_GET['event_id']))
				{
					require_once('models/training_event.php');
					$event = new Training_Event($_GET['event_id']);
				}
				else
				{
					header('location: errors/invite_users.php?No Event ID Found');
				}		
			?>
			<h3 class="title" style="text-decoration:underline">The Event</h3>
			<h4><a href="event.php?id=<?php echo $event->id; ?>" style=""><?php echo $event->title; ?></a></h4>
			<p><?php echo $event->location; ?> on <?php echo $event->held_on; ?> organised by <?php $oid = $event->organiser->id; if($_SESSION['uid'] != $oid){?><a href="profile.php?id=<?php echo $oid;?>"><?php echo $event->organiser->username;?></a><?php }else{?>You<?php }?>.</p>
		</div>
		
		<div class="side" style="margin-top:25px">
			<div class="inner_side" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
				<p>Users Invited</p>
			</div>
		</div>
		<div id="content" style="margin-top:-45px;border-top-right-radius:5px;margin-bottom:25px">
			<div style="height:225px;float:left;clear:both;width:450px;margin:25px" id="register_container">
				<table style="width:430px;text-align:center">
					<thead>
						<tr>
							<th>Colleague Name</th>
							<th>Attending</th>
							<th>Invited By</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 0;
							while($x != count($event->register))
							{
								$entry = $event->register[$x];
								if($entry == "There are no users attending this event")
								{
									echo "<tr><td colspan='4'>There are No users currently attending this event</td></th>";
									break 2;
								}
								switch($entry['attending'])
								{
									case 1:
										$att = "Invited";
										break;
									case 2:
										$att = "Attending";
										break;
									case 3:
										$att = "Declined";
										break;
								}
							?>
									<tr>
										<td><a href="profile.php?id=<?php echo $entry['user']->id; ?>"><?php if($_SESSION['uid'] == $entry['user']->id){ echo "You"; }else{echo $entry['user']->username;} ?></a></td>
										<td><?php echo $att; ?></td>
										<td><a href="profile.php?id=<?php echo $entry['invited_by']->id; ?>"><?php if($_SESSION['uid'] == $entry['invited_by']->id){ echo "You"; }else{echo $entry['invited_by']->username;} ?></a></td>
										<td><?php if($entry['user']->id == $_SESSION['uid'] || $_SESSION['account'] == "admin" || $_SESSION['uid'] == $event->organiser->id){?><a class="uiInviteTable uiButton" role="button" id="Uninvite<?php echo $user->id;?>" onclick="removeuser(<?php echo $entry['user']->id; ?>)">
	<span class="uiButtonText">Cancel Invitation</span>
</a><?php } ?></td>
									</tr>
								<?php
								$x++;
							}
						?>				
					</tbody>
				</table>
				
			</div>
			<table style="float:right;clear:both">
				<tr>
					<td>
						<button onclick="invite()">Invite Colleague</button>
					</td>
					<td>
						<button onclick="window.location = 'event.php?id=<?php echo $event->id; ?>'">Finish</button>
					</td>
				</tr>
			</table>
		</div>
</div>

<div id="contentUI" style="display:none">
	<a href="https://www.barnsley-ltu.co.uk/windows/test_invite.php?event_id=<?php echo $_GET['event_id'];?>" id="frame"></a>
</div>

</body>

</html>
