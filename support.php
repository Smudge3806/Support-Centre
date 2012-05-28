<?php
	include('controllers/is_logged_in.php');
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];	
	}
	else
	{
		if($_SESSION['account'] == "admin")
		{
			header('location: index.php?m=No Such Support Request Found');
		}
		else
		{
			header('location: profile.php?m=No Such Support Request Found');
		}
	}
	if(isset($_GET['sid']))
	{
		include('controllers/dbconnection.php');
		$mysqli->query('INSERT INTO pokes (target_user, support_request, poked_by) VALUES ('.$_GET['sid'].', '.$_GET['id'].', '.$_SESSION['uid'].')');
		$mysqli->kill;
		unset($mysqli);
		header('location: '.$_SERVER['PHP_SELF'].'?id='.$_GET['id']);
	}
	if(isset($_GET['stat']))
	{
		include('controllers/dbconnection.php');
		$mysqli->query('INSERT INTO support_status (rid, status) VALUES ('.$id.', "Inbox")');
		$mysqli->query('DELETE FROM support_status WHERE rid = '.$id.' AND status = "Closed"');
		$mysqli->kill;
		unset($mysqli);

	}
	if(isset($_GET['status']))
	{
		include('controllers/dbconnection.php');
		$mysqli->query('INSERT INTO support_status (rid, status) VALUES ('.$id.', "Closed")');
		$mysqli->query('DELETE FROM support_status WHERE rid = '.$id.' AND status <> "Closed"');
		$mysqli->kill;
		unset($mysqli);

	}
	require_once('models/support_request.php');
	$support = new Support_Request($id);
	require_once('models/datetime.php');
	$timestamp = new TimeStamp($support->created_on);
	if($support->status == "Inbox" && $_SESSION['account'] == "admin" && !isset($_GET['stat']))
	{
		include('controllers/dbconnection.php');
		$mysqli->query('INSERT INTO support_status (rid, status) VALUES ('.$id.', "Open")');
		$mysqli->query('DELETE FROM support_status WHERE rid = '.$id.' AND status = "Inbox"');

		$mysqli->kill;
		unset($mysqli);
		$support->status = "Open";
	}
	
	include('controllers/dbconnection.php');
	$result = $mysqli->query('SELECT * FROM support_advances WHERE rid = '.$id.' ORDER BY created_on DESC');
	if($result->num_rows == 0)
	{
		$redirected = false;
	}
	else
	{
		$redirected = true;
		$row = $result->fetch_object();
		$redir_id = $row->to_officer_id;
	}
	$mysqli->kill;
	unset($mysqli);
	if(!$redirected){
		require_once('models/user.php');
		$user = new User($support->sender->id, true, true);
		$sod = $user->department->support_officer;
		
	}
	else
	{
		require_once('models/user.php');
		$user = new User($redir_id, true, true);
		$sod = $user;
	}	
	
	if(isset($_GET['stat']))
	{
		require_once('models/daemon.php');
		$temp_sod = new User($sod->id);
		$email = new Daemon("admin", $temp_sod->email, "reopened support", true);
		unset($email, $temp_sod);
	}
	
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title><?php echo $support->type; ?> - Support Centre</title>
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/notes.css">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico">
<script type="text/javascript">
	function counter(thisfield)
	{
		$count = thisfield.value.length;
		$left = 500 - $count;
		document.getElementById('count').value = $left;		
	}

</script>
<style type="text/css">
	#controls li
	{
		display:inline;
}
	label
	{
		font-weight: bold;
}
</style>
	</head>

<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div style="clear:both; float:left; margin-top:25px">
		<div class="description">
			<div class="inner" style="opacity:1;box-shadow:#666 0px 0px 25px">
				<h2 id="title">
					<?php echo $support->type; ?> Support Request...
				</h2>
			</div>
		</div>
		<div class="side">
			<div class="inner_side" style="opacity:1;box-shadow:#666 0px 0px 25px">
				<p id="inner_description">Request Info</p>
			</div>
		</div>
		<div style="background-color:white; margin:10px 14px 0px 14px; box-shadow:#666 0px 0px 25px; padding:25px;border-radius:5px;padding-top:50px;width:605px">
			<table>
				<tr>
					<td><label>Status:</label></td>
					<td><?php echo $support->status; ?></td>
				</tr>
				<tr>
					<td><label>Submitted On:</label></td>
					<td><?php echo $timestamp->str_date; ?></td>
				</tr>
				<tr>
					<td><label>Submitted By:</label></td>
					<td><?php echo $support->sender->username; ?></td>
				</tr>
				<tr>
					<td colspan="2" style="height:27px"><!-- Blank to force break --></td>
				</tr>
				<tr>
					<td><label>Summary:</label></td>
					<td><?php echo $support->type; ?></td>
				</tr>
				<tr>
					<td style="vertical-align: top"><label>Description:</label></td>
					<td style="clear:both"><?php echo $support->summary; ?></td>
				</tr>
				<?php if(isset($support->moodle_page)){
				?>
				<tr>
					<td><label>Link:</label></td>
					<td><a href="<?php echo $support->moodle_page->url; ?>" title="Click here to link to this page"><?php echo $support->moodle_page->course_code." - ".$support->moodle_page->course_title; ?></a></td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<br>
		<!-- Notes Area -->
		<div style="float:left;clear:left;">
			<div class="side">
				<div class="inner_side" style="opacity:1;box-shadow:#666 0px 0px 25px">
					<p id="inner_description">Notes</p>
				</div>
			</div>
			<div id="notes" style="margin:25px 14px 10px 14px; background-color:white; box-shadow: #666 0px 0px 15px;padding:25px;border-radius:5px;padding-bottom:50px">
				<?php
					$x = 0;
					$notes = $support->notes;
					while($x != count($notes))
					{
						$note = $notes[$x];
						if($note == "No Notes Available")
						{
							$nonotes = true;
							echo "<b>".$note."</b>";
						}
						else
						{
							?>
							<div class="note" style="width:520px;float:none">
							<?php
							if($_SESSION['account'] == "admin")
							{
								?>
								<p id="title">From: <a href='https://www.barnsley-ltu.co.uk/users/<?php echo $note['sender']->id; ?>/admin' title="See <?php echo $note['sender']->username; ?>'s Profile"><?php echo $note['sender']->username; ?></a></p>
								<?php
							}
							else
							{
								?>
								<p id="title">From: <a href='https://www.barnsley-ltu.co.uk/users/<?php echo $note['sender']->id; ?>' title="See <?php echo $note['sender']->username; ?>'s Profile"><?php echo $note['sender']->username; ?></a></p>
								<?php
							}
							?>
							<p id="date">Sent: <?php $dt = new TimeStamp($note['date']); echo $dt->str_date; ?></p>
							<p id="message">Message: <?php echo $note['message']; ?></p>
							
							</div>
							<?php
						}
						$x++;
					}					
				?>
				
			</div>
			
			<div id="newNote" style="margin-top:25px; float:left;clear:both">
				<div class="side">
					<div class="inner_side" style="opacity:1;box-shadow:#666 0px 0px 25px">
						<p id="inner_description">Add a Note</p>
					</div>
				</div>
				<div id="uiNoteInput" style="margin-left:14px;margin-top:25px;margin-right:14px; background-color:white; box-shadow: #666 0px 0px 15px;padding:25px;border-radius:5px;padding-top:40px;">
					<div id="submit">
					<hr>
					<p>Add a note about this event.</p>
						<form action="https://www.barnsley-ltu.co.uk/controllers/support_add_note.php" method="post">
						<table>
							<tr>	
								<td><textarea cols="50" rows="10" name="mess" maxlength="500" placeholder="What do you want to add to this event?" onkeydown="counter(this)"></textarea></td>
								<td><input type="text" readonly="readonly" value="500" id="count" style="width:25px;border:none">Characters</td>
							</tr>
							<tr>
								<td><input type="reset" value="Clear"><input type="submit" value="Send"></td>
								<td><input type="hidden" name="suppID" value="<?php echo $_GET['id']; ?>"><input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>"></td>
							</tr> 
						</table>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Notes Controls -->
		<div id="controls">
			<div style="float:left;clear:both;background-color:white;box-shadow:#666 0px 0px 25px;padding:5px;margin-top:25px;margin-left:15px;border-radius:5px;">
				<ul style="list-style:none inside none;margin-right:40px">		
					<li>
						<?php if($support->status != "Closed" && $_SESSION['account'] == "admin"){ ?>
						<select name="status" onchange="window.location = this.options[this.selectedIndex].value">
							<option selected="selected">Change Status To...</option>
							<?php if($support->status == "Inbox"){ ?>
							<option value="https://www.barnsley-ltu.co.uk/support/<?php echo $id; ?>/open" style="background:yellow">Open</option>
							<?php } ?>
							<option value="https://www.barnsley-ltu.co.uk/support/<?php echo $id; ?>/close" style="background:lime">Closed</option>
						</select> | 
						<?php }elseif($support->status == "Closed"){ ?>
						<a href="https://www.barnsley-ltu.co.uk/support/<?php echo $id; ?>/reopen" title="Re-Open this Support Request">Recall</a> | 
						<?php } ?></li>
					<li>
						<a href="https://www.barnsley-ltu.co.uk/support/<?php echo $_GET['id']; ?>/nudge/<?php echo $sod->id; ?>" title="Nudge <?php echo $sod->username; ?> to see if there has been any progress">Nudge Support Officer</a>
					</li>
					<?php if($_SESSION['account'] == "admin"){ ?>
					<li> | <a href="https://www.barnsley-ltu.co.uk/support/<?php echo $_GET['id']; ?>/advance" title="Advance this Report to another Officer">Advance Report</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</body>

</html>
