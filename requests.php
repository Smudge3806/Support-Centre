<?php include('controllers/is_logged_in.php'); ?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Recent Support Requests - Support Centre</title>
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="stylesheet" href="http://www.barnsley-ltu.co.uk/styles/admin_table.css">
<link rel="shortcut icon" href="http://www.barnsley-ltu.co.uk/img/favicon.ico" type="image/x-icon">
<style type="text/css">
	.reports #summary
	{
		width:61px !important;
		overflow:hidden  !important;
}
	.reports #type{
	width:109px !important;
}

.reports #datemade
{
	width:194px !important;
}
.reports #status{
	width:116px !important;
}
</style>
</head>

<body>
	<?php include('views/page_header.php'); ?>
	<div class="metro" id="navigation">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	
	<div style="float:left;clear:both">
		<div class="description">
			<div class="inner" style="opacity:0.99; box-shadow:#666 0px 0px 25px;cursor:pointer" onclick="window.location = 'http://www.barnsley-ltu.co.uk/support/new/general/<?php echo $_SESSION['uid']; ?>'">
				<h2 id="title">Your Support Requests</h2>
				<p style="margin:0px">Click here to log a new Support Requests</p>
			</div>
		</div>
		
		<div id="content" style="box-shadow:#666 0px 0px 25px;border-radius:5px;background-color:white;margin:14px;padding:25px">
			<?php
				include('controllers/dbconnection.php');
				$result = $mysqli->query('SELECT * FROM support_requests WHERE uid = '.$_SESSION['uid']);
				if($result->num_rows == 0)
				{
					$mysqli->kill;
					unset($mysqli);
					?>
					<b>There are no Support Requests to be found.</b>					
					<?php
				}
				else
				{
					?>
					<table class="reports" style="width:580px">
						<colgroup>
							<col id="type">
							<col id="date">
							<col id="status">
							<col id="summary">
						</colgroup>
						<thead>
							<tr>
								<th scope="col">Summary</th>
								<th scope="col">Date Made</th>
								<th scope="col">Status</th>
								<th scope="col">Description</th>
							</tr>
						</thead>
						<tbody>
							<?php
								require_once('models/support_request.php');
								while($raw = $result->fetch_object())
								{
									$support = new Support_Request($raw->rid);
									?>
									<tr>
										<td id="type"><a href="http://www.barnsley-ltu.co.uk/support/<?php echo $support->rid; ?>"><?php echo $support->type; ?></a></td>
										<td id="datemade"><?php require_once('models/datetime.php'); $time = new TimeStamp($support->created_on); echo $time->str_short; ?></td>
										<td id="status"><?php echo $support->status; ?></td>
										<td id="summary"><?php $out = $support->summary; if(strlen($out) > 20){$out = substr($out, 0, 20);} echo $out ?></td>
									</tr>
									<?php
								}
							?>
						</tbody>
					</table>
					<?php
				}
			?>
		</div>
	</div>
</body>

</html>
