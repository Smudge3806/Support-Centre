<?php
	include('controllers/dbconnection.php');
	$officers = $mysqli->query('SELECT * FROM users WHERE type = "admin" AND uid != 35');
	?>
	<div id="records" style="display:none">
	<?php
	while($officer = $officers->fetch_object())
	{
		?>
		<div id="<?php echo $officer->first_name; ?>Training">
		<?php
				$oid = $officer->uid;
				$result = $mysqli->query('SELECT * FROM get_support_officers WHERE uid = '.$oid);
				if($result->num_rows == 0)
				{
					echo "<b>You do not have any departments registered to you!</b>";
				}
				else
				{
					if($result->num_rows > 0)
					{
						while($raw = $result->fetch_object())
						{
							$events = $mysqli->query('SELECT * FROM training_events AS te, users AS u WHERE te.organiser_id = u.uid AND u.department_id ='.$raw->did.' ORDER BY held_on DESC');
								if($events->num_rows != 0){ ?>
									<div style="padding:20px">
										<table>
											<caption><?php require_once('models/department.php'); $department = new Department($raw->did); echo $department->name; ?></caption>
											<colgroup>
												<col id="title">
												<col id="level">
												<col id="organiser">
												<col id="location">
												<col id="confirmed">
												<col id="held">
											</colgroup>
											<thead>
												<tr>
													<th scope="col">Event Title</th>
													<th scope="col">Level</th>
													<th scope="col">Organiser</th>
													<th scope="col">Location</th>
													<th scope="col">Confirmed</th>
													<th scope="col">Held On</th>
												</tr>
											</thead>
											<tbody>
									<?php // } // end if($events->num_rows != 0) !!moved!! 
										while($obj = $events->fetch_object())
										{
											?><tr><?php
											require_once('models/training_event.php');
											$event = new Training_Event($obj->event_id);
											?>
													<td><a href="events/<?php echo $event->id; ?>/admin" title="See this Events Details"><?php echo $event->title; ?></a></td>
													<td><?php echo $event->level; ?></td>
													<td><a href="users/<?php echo $event->organiser->id; ?>/admin" title="See this Users Profile"><?php echo $event->organiser->username; ?></a></td>
													<td><?php if($event->location == "A Location has not been set"){echo "TBC"; }else{ echo $event->location; } ?></td>
													<td><?php if($event->confirmed){ echo "Yes"; }else{ echo "No"; } ?></td>
													<td><?php echo $event->held_on; ?></td>
													
												</tr>
									<?php
									
										} // end while
								?>
										</tbody>	
									</table>
									</div>
								<?php
							} // moved end if
						} // end else
					}// end if()
					else
					{
						?>
						<b>There are no training events for any of your departments</b>
						<?php
					} // if() else end
					?>
					
					<?php				
			} // if($result->num_rows == 0) else
				?>
				</div>
				<?php
	} // while($officer = $officers->fetch_object())
?>
	

