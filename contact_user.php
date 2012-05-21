<?php
	include('controllers/is_logged_in.php');
	if($_SESSION['account'] == "user")
	{
		header('location: profile.php?m=You Do Not Have Permission to be in there!');
	}
	include('controllers/dbconnection.php');
	require_once('models/message.php');
	$message = new Message($_GET['mid'], true);
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Contact a User - Support Centre</title>
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/metro.css">
<link rel="shortcut icon" href="img/favicon.ico">
<style type="text/css">
	fieldset{
	background-color:white;
	border:thin black solid;
	width:100%;
}
</style>
<script type="text/javascript">
	function counter(thisfield)
	{
		$count = thisfield.value.length;
		$left = 500 - $count;
		document.getElementById('count').value = $left;		
	}
</script>

</head>

<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div id="content" style="float:left;clear:both;margin-top:10px">
		<fieldset>
			<h1 class="title">
				Contact <?php echo $message->sender->username; ?> Directly.
			</h1>
			<p class="subtitle" style="font-style:normal">
				Use this form to send a message directly to <?php echo $message->sender->username; ?>. No address books, No email addresses... Simply and Easy.
			</p>
			<div id="form" style="margin-top:10px">
				<form action="controllers/contact_user.php" method="post">
					<table>
						<tr>
							<td><label>User</label></td>
							<td><input type="text" name="user" value="<?php echo $message->sender->username; ?>" disabled="disabled"></td>
						</tr>
						<tr>
							<td valign="top"><label>Message</label></td>
							<td><textarea cols="50" rows="10" name="message" onkeydown="counter(this)"></textarea></td>
							<td><input type="text" readonly="readonly" value="500" id="count" style="width:25px;border:none">Characters</td>
						</tr>
						<tr>
							<td><input type="hidden" name="user_id" value="<?php echo $message->sender->id; ?>"></td>
							<td style="float:right">
								<input type="submit" value="Send">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</fieldset>
	</div>
</body>

</html>
