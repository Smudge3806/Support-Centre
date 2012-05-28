<?php
	include('controllers/is_logged_in.php');
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Advance Report - Support Centre</title>
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico" type="image/X-CUT">
<style type="text/css">
input[type=submit]
{
	background-image:url(https://s-static.ak.fbcdn.net/rsrc.php/v1/yZ/r/l_kYQEMzvfA.png);
	background-repeat:no-repeat;
	background-position:0 -98px;
	background-color:#5b74a8;
	border-color:#29447e #29447e #1a356e;
	padding: 1px 6px;
	border: 1px solid;
	cursor:pointer;
	vertical-align:middle;
	color:white;
	display: inline-block;
	font-family: 'Lucida Grande', Tahoma, Verdana, Arial, sans-serif;
	font-size: 11px;
	font-weight: bold;
	margin: 0;
	white-space: nowrap;
}

</style>
<script type="text/javascript">
	function delete_filler()
	{
		elem = document.getElementById('officer').firstChild;
		parent = elem.parentNode;
		parent.removeChild(elem);
	}
</script>
</head>

<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	
	<div class="description">
		<div class="inner" style="opacity:0.99;box-shadow:#666 0px 0px 25px">
			<h2 id="title">Advance Report to another Support Officer</h2>
			<p id="inner_description">Too Busy or need help with a Support Request? Advance it to Another Support Officer!</p>
		</div>
	</div>
	<div style="background-color:white;border-radius:5px;box-shadow:#666 0px 0px 25px;padding:25px;margin:-25px 14px 25px 14px;float:left;width:605px">
		<div style="width:250px;margin:auto">
			<form id="support_advance" action="https://www.barnsley-ltu.co.uk/controllers/advance_reports.php" method="post">
				<?php
					include('controllers/dbconnection.php');
					$result = $mysqli->query('SELECT uid, CONCAT(first_name, " ", last_name) AS name FROM get_support_officers WHERE uid != '.$_SESSION['uid'].' GROUP BY uid');
					?>
					<select name="officer" id="officer" onchange="document.getElementById('submit').removeAttribute('disabled');delete_filler()">
						<option>Select an officer...</option>
						<?php
							while($row = $result->fetch_object())
							{
								?>
						<option value="<?php echo $row->uid; ?>"><?php echo $row->name; ?></option>
								<?php
							}
							?>
					</select>
					<input type="hidden" name="report" value="<?php echo $_GET['id']; ?>">
					<input type="submit" id="submit" disabled="disabled" value="Advance To..">				
			</form>
		</div>
	</div>
</body>

</html>
