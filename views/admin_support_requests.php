<div>
	<?php
		include('controllers/dbconnection.php');
		$result = $mysqli->query('SELECT go.* FROM get_open_request_id AS go, get_support_officers AS gso WHERE gso.did = go.department_id AND gso.uid = '.$uid); // get all the open report ids for a support officer
		if($result->num_rows != 0)
		{
			
	?>
	<table>
		<caption>Support Requests for <?php echo $_SESSION['username']; ?>'s Departments</caption>
		<colgroup >
			<col id="user">
			<col id="type">
			<col id="submitted on">
			<col id="status">
			<col id="functions">
		</colgroup>
		<thead>
			<tr>
				<th scope="col">User</th>
				<th scope="col">Type</th>
				<th scope="col">Submitted On</th>
				<th scope="col">Status</th>
				<th scope="col">Functions</th>
			</tr>
		</thead>
		<tbody>
		<?php
			while($raw = $result->fetch_object())
			{
				require_once('models/support_request.php');
				$request = new Support_Request($raw->rid);
				require_once('models/user.php');
				$user = new User($raw->uid);				
			?>
		<tr >
			<td><a href="users/<?php echo $user->id; ?>/admin" title="View this Users Details"><?php echo $user->username; ?></a></td>
			<td><?php echo $request->type; ?></td>
			<td><?php require_once('models/datetime.php'); $dt = new TimeStamp($request->created_on); echo $dt->short." ".$dt->hour.":".$dt->minutes; ?></td>
			<td style="text-align:center;background-color:<?php if($request->status == "Open"){ echo "yellow"; }else{ echo "red"; }?>"><?php echo $request->status; ?></td>
			<td><a href="support/<?php echo $request->rid; ?>" title="View this Request">View</a> | <a href="support/<?php echo $request->rid; ?>/advance" title="Advance this Report">Advance Report</a></td>
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
			<b>There are no open Reports for your departments.</b>
		<?php
		}
	?>
</div>
<hr style="margin:25px">
<div>
	<?php
		$result = $mysqli->query('SELECT * FROM support_advances AS sa, get_open_request_id AS go WHERE sa.rid = go.rid AND sa.to_officer_id = '.$uid);
		if($result->num_rows == 1)
		{
			?>
			<table>
				<caption>Requests Advanced to You</caption>
				<colgroup>
					<col id="user">
					<col id="type">
					<col id="submitted_on">
					<col id="status">
					<col id="functions">
					<col id="advanced_by">
				</colgroup>
				<thead>
					<tr>
						<th scope="col">User</th>
						<th scope="col">Type</th>
						<th scope="col">Submitted On</th>
						<th scope="col">Status</th>
						<th scope="col">Functions</th>
						<th scope="col">Advanced By</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					while($raw = $result->fetch_object())
					{
						require_once('models/support_request.php');
						$request = new Support_Request($raw->rid);
						require_once('models/user.php');
						$user = new User($raw->uid);
				?>
					<tr>
						<td><a href="users/<?php echo $user->id; ?>/admin" title="View this Users Details"><?php echo $user->username; ?></a></td>
						<td><?php echo $request->type; ?></td>
						<td><?php require_once('models/datetime.php'); $dt = new TimeStamp($request->created_on); echo $dt->short." ".$dt->hour.":".$dt->minutes; ?></td>
						<td style="text-align:center;background-color:<?php if($request->status == "Open"){ echo "yellow"; }else{ echo "red"; }?>"><?php echo $request->status; ?></td>
						<td><a href="support/<?php echo $request->rid; ?>" title="View this Request">View</a> | <a href="advance_report.php?id=<?php echo $request->rid; ?>" title="Advance this Report">Advance Report</a></td>
						<td><?php $officer = new User($raw->from_officer_id);?><a href="user/<?php echo $officer->id; ?>"><?php echo $officer->username; ?></a></td>
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
			<b>There are no requests that have been advanced to you.</b>
			<?php
		}	?>

</div>

