<fieldset>
	<legend>Help Reports for <?php echo $_SESSION['username']; ?>'s Departments</legend>
	<?php
		include('controllers/dbconnection.php');
		$reports = $mysqli->query('SELECT * FROM get_open_request_data WHERE sid = '.$uid.' ORDER BY status ASC');
		if($reports->num_rows != 0)
		{
	?>
	<table>
		<tr style="background-color:gray">
			<th>Who</th>
			<th>What</th>
			<th>When</th>
			<th>Status</th>
			<th>Functions</th>
		</tr>
		<?php
			while($report = $reports->fetch_object())
			{
				$id = $report->uid;
				$users = $mysqli->query('SELECT CONCAT(`first_name`," ",`last_name`) AS who FROM users WHERE uid = '.$id);
				$user = $users->fetch_object();
			?>
		<tr >
			<td><a href="profile.php?id=<?php echo $id; ?>" title="View this Users Details"><?php echo $user->who; ?></a></td>
			<td><?php echo $report->what; ?></td>
			<td><?php echo $report->when; ?></td>
			<td style="text-align:center;background-color:<?php if($report->status == "Open"){ echo "yellow"; }else{ echo "red"; }?>"><?php echo $report->status; ?></td>
			<td><a href="update_reports.php?id=<?php echo $report->id; ?>" title="Update this Report">Update Details</a> | <a href="advance_report.php?id=<?php echo $report->id; ?>" title="Advance this Report">Advance Report</a></td>
		</tr>
		<?php
		}
		?>
	</table>
	<?php
		}
		else
		{
		?>
			<b>There are no open Reports for your departments.</b>
		<?php
		}
	?>
</fieldset>

