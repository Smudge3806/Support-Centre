<?php include('controllers/is_logged_in.php'); ?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>New Training Event - Support Centre</title>
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="SHORTCUT ICON" href="http://www.barnsley-ltu.co.uk/img/favicon.ico" type="image/x-icon">
<style type="text/css">
	#content{
		background-color:white;
		box-shadow:#666 0px 0px 25px;
		padding:10px;
		float:left;
		clear:both;
		margin-top:-25px;
		margin-right:14px;
		width:637px;
		margin-left:14px;
		border-bottom-left-radius:5px;
		border-bottom-right-radius:5px;
}
</style>
<link type="text/css" href="http://www.barnsley-ltu.co.uk/scripts/jquery/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" >	
<script type="text/javascript" src="http://www.barnsley-ltu.co.uk/scripts/jquery/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="http://www.barnsley-ltu.co.uk/scripts/jquery/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript">
	$(function() {
		$( "#datepicker" ).datepicker({
			showButtonPanel: true,
			showOtherMonths: true,
			selectOtherMonths: true,
			autoSize: true
		});
	});
</script>
<style type="text/css">
	.ui-widget{
	font-size:0.7em;
}
	ui-datepicker{
	width: 13em;
}
</style>
</head>
<?php require_once('models/user.php'); $user = new User($_SESSION['uid']); ?>
<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div>
		<div class="description">
			<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
				<h2 id="title">
					New Training Event
				</h2>
				<p id="inner_description">
					Create a new training event and invite your colleagues to attend.
				</p>
			</div>			
		</div>
		<div id="content">
			<div id="form">
				<div class="topic-headers" style="clear:both">
					<h2 class="title">
						Step 1 - The Event
					</h2>
				</div>
				<form action="http://www.barnsley-ltu.co.uk/controllers/new_training_event.php" method="post" style="clear:both;float:left">
					<table>
						<tr>
							<td>
								<label>Organiser: </label>
							</td>
							<td>
								<input type="text" name="org" value="<?php echo $user->id?>. <?php echo $user->username; ?>" disabled="disabled"><input type="hidden" name="user" value="<?php echo $user->id?>. <?php echo $user->username; ?>">
							</td>
						</tr>
						<tr>
							<td>
								<label>Event Title: </label>
							</td>
							<td>
								<select name="title" id="titles">
									<?php include('views/training_title_select.php'); ?>
								</select>
							</td>
							
						</tr>
						<?php if($_SESSION['account'] == "admin")
						{ ?>
						
						<?php } ?>
						<tr>
							<td>
								<label>Date: </label>
							</td>
							<td>
								<input type="text" name="date" id="datepicker">
							</td>
						</tr>
						<tr>
							<td>
								<label>Location:</label>
							</td>
							<td>
								<input type="text" name="location" placeholder="Room Number">
							</td>
						</tr>
						<tr>
							<td colspan="3"></td>
							<td><input type="submit" value="Create Event"></td>
						</tr>
					</table>
				</form>
				
			</div>
		</div>
	</div>
</body>

</html>
