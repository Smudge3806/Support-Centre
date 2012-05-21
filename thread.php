<?php
	if(isset($_GET['id']))
	{
		$thread = $_GET['id'];
	}
	elseif(isset($_GET['thread']))
	{
		$thread = $_GET['thread'];
	}
	elseif(isset($_GET['thread_id']))
	{
		$thread = $_GET['thread_id'];
	}
	else
	{
		if($_SESSION['account'] == "user")
		{
			header('location: profile.php?m=Thread could not be opened');
		}
		else
		{
			header('location: index.php?m=Thread could not be opened');
		}
	}
	
	include('controllers/is_logged_in.php');
	require_once('models/thread.php');
	$thread = new Thread($thread, true, false);
	$others = array();
?>

<!DOCTYPE html>

<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Thread: <?php echo $thread->topic; ?> - Support Centre</title>
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico" type="image/x-icon">
</head>

<body>
	<?php
		if(isset($_GET['m']))
		{
			?>
				<div class="notice">
					<p style="float:left"><?php echo $_GET['m']; ?></p>
					<a href="http://www.barnsley-ltu.co.uk/profile.php" title="Clear" id="clear">     </a>
				</div>
			<?php
		}
	?>
	<?php
		include('views/page_header.php');
	?>

	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>

	<div class="description">
		<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
			<h2 id="title"><?php echo $thread->topic; ?></h2>
			<p id="inner_description">Created On: <?php require_once('models/datetime.php'); $dt = new TimeStamp($thread->created_on); echo $dt->str_datetime; ?></p>
		</div>
	</div>

	<div id="content" style="float:left;clear:both;width:637px;">
	<?php
		$x = 0;
		$messages = $thread->messages;
		while($x != count($messages))
		{
			$message = $messages[$x];
			?>
			<br>
			<div class="side">
				<div class="inner_side" style="opacity:1;box-shadow: #666 5px 5px 25px;">
					<p>From: <a href="http://www.barnsley-ltu.co.uk/<?php if($_SESSION['account'] == "admin"){echo "user_profile.php";}else{echo "profile.php";}echo "?id=".$message['sender']->id; ?>"><?php echo $message['sender']->username; ?></a></p>
				</div>
			</div>

			<div id="message<?php echo $message['message_id']; ?>" style="box-shadow:#666 0px 0px 25px;border-radius:5px;margin-left:14px;margin-top:25px;margin-right:14px; background-color:white; box-shadow: #666 0px 0px 15px;padding-left:25px;padding-bottom:25px">
				<p style=" clear:both"><?php echo $message['content']; ?></p><span style="font-style:italic;color:silver;">Sent On: <?php echo $message['created_on']; ?></span>
			</div>
			<?php
			$x++;
			if($message['sender']->id != $_SESSION['uid'])
			{
				$others[] = $message['sender']->id;
			}
			elseif($message['recipient']->id)
			{
				$others[] = $message['recipient']->id;
			}
		}
	?>
	</div>
	<div id="controls" style="float:left;clear:both;background-color:white;box-shadow: #666 0px 0px 15px;border-radius:5px;margin-left:13px; margin-top:25px; margin-right:14px; padding:25px; margin-bottom:25px;">
		<a href="http://www.barnsley-ltu.co.uk/controllers/thread_delete.php?id=<?php echo $thread->thread_id; ?>&page=notifications">Delete Thread</a>
		<a href="http://www.barnsley-ltu.co.uk/messages/<?php echo $thread->thread_id; ?>/reply/<?php echo $others[0]; ?>">Send a Reply</a>
	</div>
</body>

</html>