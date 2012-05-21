<?php
	include('controllers/is_logged_in.php');
	include('controllers/dbconnection.php');
	require_once('models/user.php');
	$user = new User($_SESSION['uid'], true, true);
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Contact Your Support Officer - Support Centre</title>
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
				Contact Your Support Officer Directly.
			</h1>
			<p class="subtitle" style="font-style:normal">
				Use this form to send a message directly to your support officer. No address books, No email addresses... Simply and Easy.
			</p>
			<div id="form" style="margin-top:10px">
				<form action="controllers/contact_support.php" method="post">
					<table>
						<tr>
							<td><label>Support Officer</label></td>
							<td><input type="text" name="officer" value="<?php echo $user->department->support_officer->username; ?>" disabled="disabled"></td>
						</tr>
						<tr>
							<td valign="top"><label>Message</label></td>
							<td><textarea cols="50" rows="10" name="message" onkeydown="counter(this)"></textarea></td>
							<td><input type="text" readonly="readonly" value="500" id="count" style="width:25px;border:none">Characters</td>
						</tr>
						<tr>
							<td><input type="hidden" name="user_id" value="<?php echo $user->id; ?>"></td>
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
