<?php
	// views/events_notes
	$notes = $event->notes;
	if($notes == "There are no notes for this event.")
	{
		?>
		<p><?php echo $notes; ?></p>
		<?php	
	}
	else
	{
		$x = 0;
		while($x != count($notes))
		{
			$note = $notes[$x];
			?>
				<div class="note" id="note-<?php echo $note->id; ?>">
					<p id="title"><a href="<?php require_once('models/user_link.php'); $link = new User_Link($note->sender, "url"); echo $link->output; ?>"><?php echo $note->sender->username; ?></a></p>
					<p id="date">Sent: <?php echo $note->sent_on->str_datetime; ?></p>
					<p id="message"><?php echo $note->message; ?></p>
				</div>
			<?php
			$x++;
		}
	}	
?>