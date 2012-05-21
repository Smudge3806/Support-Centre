<?php 
	session_start();
	
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Add a New Note - Support Centre</title>
<link rel="stylesheet" href="../styles/main.css">
<link rel="stylesheet" href="../styles/pie.css">
<link rel="stylesheet" href="../styles/about.css">
<style type="text/css">
	body{
	background: white url('../img/background_image.jpg') no-repeat scroll 50% 10px;
	overflow:hidden;
	width:520px;
	margin:20px;
}
.header{
	font-size:x-small;
}
</style>
<?php
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
	}
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
?>
</head>

<body>
	<?php include('../views/page_header.php');?>
	<div style="background:white;box-shadow:#666 0px 0px 25px">
		<div id="new_note" style="float:left;clear:both">
			
			<form name="message" action="http://www.barnsley-ltu.co.uk/controllers/support_add_note.php" method="post">
				<table>
					<tr>
						<td><label>Message</label></td>
					</tr>
					<tr>
						<td><textarea name="message" rows="10" cols="60"></textarea></td>
					</tr>
					<tr style="float:right">
						<td><input type="reset" value="Clear"><input type="hidden" name="page" value="<?php echo $page; ?>"><input type="submit" value="Send"></td>
					</tr>
				</table>
			</form>
			
		</div>
	</div>
</body>

</html>
