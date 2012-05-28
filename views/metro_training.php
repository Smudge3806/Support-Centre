<div id="tile">
	<a href="https://www.barnsley-ltu.co.uk/events/view/" title="See your Training Events">All Training Events</a>
	<div id="slider2" style="font-size:small;padding-top:20px">
		<div>
			<p style="margin-top:0px;font-size:small">
				Here you can see the four most recent training events that you have been invited to by your collegues.
			</p>
		</div>
		<?php
			$events = $mysqli->query('SELECT * FROM training_registers AS tr, training_events AS te WHERE tr.user_id ='.$uid.' AND te.event_id = tr.event_id ORDER BY te.held_on LIMIT 0, 2');
			if($events->num_rows == 0)
			{
				?>
				<div>
					<p style="margin-top:0px">You don't have any training events coming up.</p>
				</div>
				<div>
					<a href="https://www.barnsley-ltu.co.uk/events/new/" title="Click here to create a new Training Event">Click here to create a new Training Event</a>
				</div>
				<?php
			}
			else
			{
		?>
				<div>
					<table>
						
							<?php 
								while($raw = $events->fetch_object())
								{
									require_once('models/training_event.php'); $event = new Training_Event($raw->event_id); 
							?>
						<tr>
							<td><a href="https://www.barnsley-ltu.co.uk/event/<?php echo $event->id; ?>" title="Click to see this Event"><?php echo $event->title; ?></a></td>
							<td><?php $date = $event->held_on; $date = explode(" ", $date); echo $date[0]; ?></td>
						</tr>
							<?php
								}
							?>
							
						
					</table>
				</div>
				<div>
					<a href="https://www.barnsley-ltu.co.uk/events/new" title="Click here to create a new Training Event">Click here to create a new Training Event</a>
				</div>
	
	
	  	<?php
	  		}
	  	?>
</div>
