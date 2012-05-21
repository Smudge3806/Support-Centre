<?php
	include('controllers/is_logged_in.php');
	require_once('models/user.php');
	$user = new User($_SESSION['uid']);
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Give Some Feedback</title>
<link rel="shortcut icon" href="img/favicon.ico" >
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/metro.css">
<style type="text/css">
	fieldset{
	background-color:white;
	border:thin black solid;
}
</style>
</head>

<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div style="clear:left;padding-top:25px">
	<fieldset>
		<h2 class="title" style="margin-top:10px">Give us some feedback!</h2>
		<p class="subtitle">We try to make this site as accessible and pleasant as possible however we do miss things. We can not grow our site and its quality without
		you. You feedback, suggestions and fault reports from this page will help us to improve and for the site to serve you better.</p><br>
		 <p class="subtitle">We want you to enjoy your time on Support Centre and we will endeavour to continue to develop it to further meet your needs.</p>
	</fieldset>
	<br>
	<fieldset>
		<form name="faults" action="controllers/feedback.php" method="post">
			<table>
				<tr>
					<td style="float:right">Name: </td>
					<td>
						<input type="text" name="user" value="<?php echo $user->username; ?>">
					</td>
				</tr>
				<tr>
					<td style="float:right">Reason for Contact: </td>
					<td>
						<select name="contact">
							<option value="suggestion">Suggestion</option>
							<option value="fault">Fault</option>
							<option value="feedback">Feedback</option>
						</select>
					</td>
				</tr>
				</table>
				<textarea style="width:100%;height:150px" name="message" maxlength="500" placeholder="Tell us what you think(Max: 500 characters" required></textarea>
				<input type="submit" value="Send" style="float:right">			
		</form>
	</fieldset>
	</div>
		<?php
		include('views/page_footer.php');
	?>

</body>

</html>
