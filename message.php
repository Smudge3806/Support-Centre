<?php
	include('controllers/is_logged_in.php');
	require_once('models/user.php');
	$sender = new User($_SESSION['uid']);
	$recipient = new User($_GET['recip']);
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Compose Message - Support Centre</title>
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico">
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
		<div class="description">
			<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
				<h1 id="title">Contact <?php echo $recipient->username; ?> Directly.</h1>
				<p>Use this form to send a message directly to <?php echo $recipient->username; ?>. No address books, No email addresses... Simple and Easy.</p>
			</div>
		</div>
		<div style="box-shadow:#666 0px 0px 25px;border-radius:5px;background-color:white;padding:10px; margin:14px">
			
			<div id="form" style="margin-top:10px">
				<form action="https://www.barnsley-ltu.co.uk/controllers/message.php" method="post">
					<table>
					<?php
						if(!isset($_GET['thread_id']))
						{
						?>
						<tr>
							<td><label>Subject: </label><input type="text" name="topic" placeholder="Subject" style="width:360px" required></td>
						</tr>
						<?php
						}
						?>
						<tr>
							<td valign="top"><label>Message:</label></td>
						</tr>
						<tr>	
							<td><textarea cols="50" rows="10" name="message" maxlength="500" onkeydown="counter(this)" onchange="if(this.value.length > 0){document.getElementById('submit').removeAttribute('disabled');}else{document.getElementById('submit').setAttribute('disabled','disabled');}" required></textarea></td>
							<td><input type="text" readonly="readonly" value="500" id="count" style="width:25px;border:none">Characters</td>
						</tr>
						<tr>
							
							<td style="float:right">
								<input type="submit" id="submit" disabled="disabled" value="Send">
							</td>
							<td>
								<input type="hidden" name="sender" value="<?php echo $sender->id; ?>">
								<input type="hidden" name="recipient" value="<?php echo $recipient->id; ?>">
								<?php if(isset($_GET['thread_id'])){
								?>
								<input type="hidden" name="thread" value="<?php echo $_GET['thread_id']; ?>">
								<?php
									}
								?>
								<input type="hidden" name="page" value="user">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>

</body>

</html>
