<?php
	//include('controllers/dbconnection.php');
	$results = $mysqli->query('SELECT * FROM messages WHERE recipient ='.$_SESSION['uid'].' GROUP BY thread_id ORDER BY sent_on DESC');
?>
	<?php
		if($results->num_rows == 0)
		{
	?>
		<b>There are no messages for you</b>
	<?php
		}else{
			while($raw = $results->fetch_object())
			{
				require_once('models/message.php');
				$message = new Message($raw->message_id, true);
	?>
				<table>
					<tr style="background-color:#99ccff">
						<td colspan="2">From: <a href="users/<?php echo $message->sender->id; ?>/admin"><?php echo $message->sender->username; ?></a></td>
						<td>Sent: <?php echo $message->sent_on; ?></td>
					</tr>
					<tr>
						<td colspan="3">Message: <?php echo $message->content; ?></td>
					</tr>
					<tr>
						<td><a href="messages/<?php echo $message->thread_id; ?>/reply/<?php echo $message->sender->id; ?>">Reply to this User</a> |</td>
						<td><a href="messages/<?php echo $message->thread_id; ?>">View Thread</a> |</td>
						<td><a href="http://www.barnsley-ltu.co.uk/controllers/thread_delete.php?id=<?php echo $message->thread_id;?>&page=index">Delete this Message</a></td>
					</tr>
				</table>
				<hr>
	<?php
			}
		}
	?>
