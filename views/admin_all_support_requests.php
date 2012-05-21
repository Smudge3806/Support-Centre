<!--

	while(users = admin)
		<div id="AdminUserReport">
			while(departent = adminsDepartments)
				<div id="DepartmentReports">
					<! Code !>
				</div>
			end while			
		</div>
	end while
-->
<?php
	// Get users details
	$users = $mysqli->query('SELECT * FROM users WHERE type = "admin" AND uid != 35');
	while($admin = $users->fetch_object())
	{
		?>
		<div id="<?php echo $admin->first_name.$admin->last_name; ?>Report">
		<?php
		// get admins departments
		$adminsDepartments = $mysqli->query('SELECT * FROM get_support_officers WHERE uid = '.$admin->uid);
		while($department = $adminsDepartments->fetch_object())
		{
			$reports = $mysqli->query('SELECT * FROM get_open_request_id WHERE department_id = '.$department->did);
?>
<div id="<?php echo $department->department_name; ?>Reports">	
	<?php
	
	if($reports->num_rows != 0)
					{
				?>									
				<table style="clear:left">
					<caption><?php echo $department->department_name; ?></caption>
					<colgroup>
						<col id="who">
						<col id="what">
						<col id="when">
						<col id="status">
						<col id="functions">
					</colgroup>
					<thead>
					<tr>
						<th scope="col">Who</th>
						<th scope="col">What</th>
						<th scope="col">When</th>
						<th scope="col">Status</th>
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
					<tr >
						<td><a href="http://www.barnsley-ltu.co.uk/users/<?php echo $report->uid; ?>/admin" title="View this Users Details"><?php echo $user->username; ?></a></td>
						<td><?php echo $support->type; ?></td>
						<td><?php require_once('models/datetime.php'); $dt = new TimeStamp($support->created_on); echo $dt->short." ".$dt->hour.":".$dt->minutes; ?></td>
						<td style="text-align:center;background-color:<?php if($support->status == "Open"){ echo "yellow"; }else{ echo "red"; }?>"><?php echo $support->status; ?></td>
						<td><a href="support/<?php echo $support->rid; ?>" title="Update this Report">Update Details</a> | <a href="support/<?php echo $support->rid; ?>/advance" title="Advance this Report">Advance Report</a></td>
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
						<p>There are no open Reports for <?php echo $department->department_name; ?>.</p>
					<?php
					}
				?>
			</div>
<?php
			} // End While (department = adminsDepartments)
?>
</div>
<?php
	} // End While (users = admin)

?>