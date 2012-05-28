
<?php
	include('controllers/is_logged_in.php');
	include('controllers/dbconnection.php');
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Notifications - Support Centre</title>
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/message_boxes.css">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico">
</head>

<body>
	<?php
		if(isset($_GET['m']))
		{
			?>
				<div class="notice">
					<p style="float:left"><?php echo $_GET['m']; ?></p>
					<a href="https://www.barnsley-ltu.co.uk/notifications.php" title="Clear" id="clear">     </a>
				</div>
			<?php
		}
	?>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
		<div id="new" style="float:left;clear: both">
		<?php include('views/message_box.php'); ?>
	</div>
	
</body>

</html>
