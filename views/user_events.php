<div id="event_info_ui" style="width:48%;float:left;clear:none;margin-left:2%">
	<fieldset>
		<legend>Training Events</legend>
		<?php
			$result = $mysqli->query('SELECT * FROM training_registers WHERE user_id ='.$user->id);
			if($result->num_rows == 0)
			{
				echo "<b>There are no Training Events for this user</b>";
			}
			else
			{
				?>
				<table>
					<thead>
						<tr id="alt">
							<th>Title</th>
							<th>Level</th>
							<th>Organiser</th>
							<th>Date Held</th>
						</tr>
					</thead>
					<?
						$x = 0;
						while($raw = $result->fetch_object())
						{
							require_once('models/training_event.php');
							$event = new Training_Event($raw->event_id);
															
								?>
								<tr>
									<td><a href="event.php?id=<?php echo $event->id; ?>"><?php echo $event->title; ?></a></td>
									<td><?php echo $event->level; ?></td>
									<td><a href="user_profile.php?id=<?php echo $event->organiser->id; ?>"><?php echo $event->organiser->username; ?></a></td>
									<td><?php $date = $event->held_on; if($date != "TBC"){ $date = explode(" ", $date);}else{$date = array(); $date[] = "TBC"; $date[] = "TBC";}?><a title="<?php echo $date[1]; ?>"><?php echo $date[0]; ?></a></td>	
										
								</tr>
							<?
						}
					?>
				</table>
				<?php
			}
		?>
	</fieldset>
</div>