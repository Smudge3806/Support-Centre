<?php 
	session_start();
	include('dbconnection.php');
	include('../../models/training_event.php');
	$event = new Training_Event($_GET['id']);
?>
<div style="height:225px;float:left;clear:both;width:450px;margin:25px" id="register_container">
				<table style="width:430px;text-align:center">
					<thead>
						<tr>
							<th>Colleague Name</th>
							<th>Attending</th>
							<th>Invited By</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 0;
							while($x != count($event->register))
							{
								$entry = $event->register[$x];
								if($entry == "There are no users attending this event")
								{
									echo "<tr><td colspan='4'>There are No users currently attending this event</td></th>";
									break 2;
								}
								switch($entry['attending'])
								{
									case 1:
										$att = "Invited";
										break;
									case 2:
										$att = "Attending";
										break;
									case 3:
										$att = "Declined";
										break;
								}
							?>
									<tr>
										<td>
										<a href="../profile.php?id=<?php echo $entry['user']->id; ?>"><?php if($_SESSION['uid'] == $entry['user']->id){ echo "You"; }else{echo $entry['user']->username;} ?></a></td>
										<td><?php echo $att; ?></td>
										<td>
										<a href="../profile.php?id=<?php echo $entry['invited_by']->id; ?>"><?php if($_SESSION['uid'] == $entry['invited_by']->id){ echo "You"; }else{echo $entry['invited_by']->username;} ?></a></td>
										<td><?php if($entry['user']->id == $_SESSION['uid'] || $_SESSION['account'] == "admin" || $_SESSION['uid'] == $event->organiser->id){?><a class="uiInviteTable uiButton" role="button" id="Uninvite<?php echo $user->id;?>" onclick="removeuser(<?php echo $entry['user']->id; ?>)">
	<span class="uiButtonText">Cancel Invitation</span>
</a><?php } ?></td>
									</tr>
								<?php
								$x++;
							}
						?>				
					</tbody>
				</table>
				
			</div>
