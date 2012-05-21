<div id="user_messages_ui" style="float:left;clear:both">
	<fieldset style="margin-top:25px;background-color:white;border:thin black solid;padding:10px">
	<legend>Messages</legend>
		<?php
			$result = $mysqli->query('SELECT * FROM messages WHERE recipient = '.$user->id.' OR sender = '.$user->id.' GROUP BY thread_id ORDER BY sent_on DESC');
			if($result->num_rows == 0)
			{
				echo "<b>There are no Messages stored for this User</b>";
			}
			else
			{
				while($raw = $result->fetch_object())
				{
					require_once('models/thread.php');
					$thread = new Thread($raw->thread_id, false, false);
					?>
						<table>
						<tr style="background-color:#99ccff">
							<td colspan="2">Topic: <a href="thread.php?id=<?php echo $thread->thread_id; ?>"><?php echo $thread->topic; ?></a></td>
							<td>Sent: <?php echo $thread->created_on; ?></td>
						</tr>
						<tr>
							<td><a href="message.php?recip=<?php $message = $thread->messages[0]; echo $message['sender']; ?>&thread_id=<?php echo $thread->thread_id; ?>">Reply to this User</a> |</td>
							<td><a href="thread.php?id=<?php echo $thread->thread_id; ?>">View Thread</a> |</td>
							<td><a href="index.php?m=This Feature is not available yet">Delete this Message</a></td>
						</tr>
						</table>
						<hr>
	
					<?php
				}	
			}	
		?>
	</fieldset>
</div>