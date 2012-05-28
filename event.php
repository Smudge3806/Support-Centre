<?php
	include('controllers/is_logged_in.php');
	require_once('models/training_event.php');
	include('controllers/dbconnection.php');
	if(isset($_GET['id']))
	{
		$event = new Training_Event($_GET['id'], true);
	}
	elseif(isset($_GET['event_id']))
	{
		$event = new Training_Event($_GET['event_id'], true);

	}
	else
	{
		header('location: profile.php');
	}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title><?php echo $event->title; ?> - Support Centre</title>
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/event.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/notes.css">
<?php include('scripts/import_fancybox.php'); ?>
<script type="text/javascript">
	
	$(document).ready(function(){
		// Load Fancy Box Elements
		$('#frame').fancybox({
		});
	});
		
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
			window.location = 'https://www.barnsley-ltu.co.uk/controllers/delete_event.php?id=<?php echo $_GET['id']; ?>';
		}
	}
	
	function alterAttendance(value, user_id)
	{
		window.location = 'https://www.barnsley-ltu.co.uk/controllers/event_alter_attendance.php?eid=<?php echo $event->id; ?>&uid='+user_id+'&page=events/<?php echo $event->id; ?>&att='+value;
	}
	
	
	function getXmlRequest()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			try
			{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(err)
			{
				try
				{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch(err2)
				{
					xmlhttp = false;
				}
			}
		}
		
		return xmlhttp;
	}
	
	var xmlhttp = getXmlRequest();
	
	function callAjax(url,valuePairs)
	{
		xmlhttp.open("POST", url, true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.onreadystatechange = ajaxResponse();
		xmlhttp.send(valuePairs);
	}
	
	function ajaxResponse()
	{
		if(xmlhttp.readyState == 4)
		{
			if(xmlhttp.status == 200)
			{
				var output = xmlhttp.responseText;	
			}
			else
			{
				alert('An error has occured: '+ xmlhttp.statusText);
			}
		}
		return output;
	}
	function invite()
	{
		$("a#frame").fancybox().trigger('click');
	}
</script>
</head>

<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div class="description" style="margin-top:25px">
		<div class="inner" style="box-shadow:#666 0px 0px 25px;opacity:0.99">
			<h2 id="title"><?php echo $event->title; ?></h2>
			<p style="margin-top:0px;padding-top:0px">Date: <?php echo $event->held_on; ?> | Time: <?php echo $event->held_at; ?> | Location: <?php echo $event->location; ?> | Organised By: <a href="http://www.barnsley-ltu.co.uk/users/<?php echo $event->organiser->id; ?>"><?php echo $event->organiser->username; ?></a></p>
		</div>
	</div>
	<div class="content" id="first">
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
				<button onclick="invite();">Invite Colleague</button>
				<?php if($_SESSION['uid'] == $event->organiser->id || $_SESSION['account'] == "admin"){ ?>
				<button onclick="del_event()">Cancel Event</button>
				<?php } ?>
			</div>
		</div>
	</div>
	
	<div class="side">
		<div class="inner_side" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
			<p>Notes about this event.</p>
		</div>
	</div>
	<div class="content" style="margin-top:-45px;width:607px">
		<div id="notes" style="margin-top:25px">
			<?php include('views/event_notes.php'); ?>
		</div>
		
		<div id="submit" style="clear:both;float:left">
		<hr>
		<p>Add a note about this event.</p>
			<form action="https://www.barnsley-ltu.co.uk/controllers/event_add_note.php" method="get">
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
	
	<div id="contentUI" style="display:none">
		<a href="https://www.barnsley-ltu.co.uk/windows/test_invite.php?event_id=<?php echo $_GET['id'];?>" id="frame"></a>
	</div>
	
</body>

</html>
