<div id="ClosedReport">
	<?php
		$reports = $mysqli->query('SELECT * FROM get_closed_reports');
		if($reports->num_rows != 0){
	?>
	
		<table style="margin-top:25px">
			<colgroup>
				<col id="who">
				<col id="what">
				<col id="submitted_on">
				<col id="function">
			</colgroup>
			<thead>
				<tr>
					<th scope="col">Who</th>
					<th scope="col">What</th>
					<th scope="col">Submitted On</th>
					<th scope="col">Functions</th>
				</tr>
			</thead>
			<tbody>
			<?php
				while($report = $reports->fetch_object())
				{
					require_once('models/user.php');
					$user = new User($report->uid);
					require_once('models/support_request.php');
					$support = new Support_Request($report->rid);
			?>
			<tr>
				<td><a href="http://www.barnsley-ltu.co.uk/users/<?php echo $user->id; ?>/admin" title="View this User"><?php echo $user->username; ?></a></td>
				<td><a href="http://www.barnsley-ltu.co.uk/support/<?php echo $support->rid; ?>" title="View this Report"><?php echo $support->type; ?></a></td>
				<td><?php require_once('models/datetime.php'); $dt = new TimeStamp($support->created_on); echo $dt->short." ".$dt->hour.":".$dt->minutes; ?></td>
				<td><a href="http://www.barnsley-ltu.co.uk/support/<?php echo $support->rid; ?>/reopen" title="Recall this Report">Recall</a></td>
			</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	<?php 
	}
	else
	{
	?>
	<b>There are no closed reports yet</b>
	<?php 
	}
	?>
</div>
