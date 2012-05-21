<?php
	// views/event_register.php
	
	// get event register
	if(isset($_GET['id']))
	{
		require_once('models/training_event.php');
		$event = new Training_Event($_GET['id']);
		$register = $event->register;
		if($register == "There are no users attending this event")
		{
			echo $register;
			break 2;
		}
?>

	<table>
		<thead>
			<tr>
				<th>Username</th>
				<th>Status</th>
				<th>Uninvite</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$x = 0;
				require_once('models/user_link.php');
				while($x != count($register))
				{
					$entry = $register[$x];
					?>
						<tr>
							<td><?php $link = new User_Link($entry['user']); echo $link->output; ?></td>
							<td><?php switch($entry['attending']){ case 1: echo "Invited"; break; case 2: echo "Attending"; break; case 3: echo "Declined";break; } ?></td>
							<td><a href="controllers/ajax/event_uninvite.php?eid=<?php echo $entry['id']; ?>&page=controllers/ajax/event_uninvite.php">Uninvite</a></td>
						</tr>
					<?php
					$x++;
				}
			?>
		</tbody>
	</table>
<?php
	}
	else
	{
		echo "<p>There are no users attending this event</p>";
	}
?>