<?php
	require_once('models/user.php');
	require_once('models/datetime.php');
	require_once('models/user_link.php');
	//$result = $mysqli->query('SELECT * FROM messages WHERE recipient = '.$_SESSION['uid'].' ORDER BY sent_on DESC');
	$result = $mysqli->query('SELECT * FROM (SELECT * FROM `messages` WHERE `recipient` = '.$_SESSION['uid'].' OR `sender` = '.$_SESSION['uid'].' ORDER BY sent_on DESC) as results WHERE recipient = '.$_SESSION['uid'].' GROUP BY thread_id ORDER BY sent_on DESC');
?>
<div id="MessageColInbox">
	<div class="MessageContainer">
		<div class="MessageContainerHeader" id="Inbox">
			<h3>Inbox</h3>
		</div>
		<div class="MessageContainerItems" id="AllItems">
		<?php
			if($result->num_rows == 0)
			{
		?>
			<div class="MessageItem" id="NoMessages">
				<p class="MessageItemSubject">There are no messages for you.</p>
			</div>
		<?php
			}
			else
			{
				while($row = $result->fetch_object())
				{
			?>
			<div class="MessageItem" id="Message<?php echo $row->message_id; ?>">
				<p class="MessageItemName"><?php $link = new User_Link($user = new User($row->sender)); echo $link->output; ?></p>
				<p class="MessageItemDate"><?php $dt = new TimeStamp($row->sent_on); echo $dt->str_short; ?></p>
				<p class="MessageItemSubject"><a href="http://www.barnsley-ltu.co.uk/messages/<?php echo $row->thread_id; ?>"><?php echo substr($row->message,0,40); ?></a></p>
			</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>
<?php
	//$result = $mysqli->query('SELECT * FROM messages WHERE sender = '.$_SESSION['uid'].' ORDER BY sent_on DESC');
	$result = $mysqli->query('SELECT * FROM (SELECT * FROM `messages` WHERE `recipient` = '.$_SESSION['uid'].' OR `sender` = '.$_SESSION['uid'].' ORDER BY sent_on DESC) as results WHERE sender = '.$_SESSION['uid'].' GROUP BY thread_id ORDER BY sent_on DESC');
?>
<div id="MessageColSent">
	<div class="MessageContainer">
		<div class="MessageContainerHeader" id="Sent">
			<h3>Sent</h3>
		</div>
		<div class="MessageContainerItems" id="AllItems">
			<?php
				if($result->num_rows == 0)
				{
				?>
				<div class="MessageItem" id="NoMessages">
					<p class="MessageItemSubject">There are no messages for you.</p>
				</div>
				<?php
				}
				else
				{
					while($row = $result->fetch_object())
					{
			?>
			<div class="MessageItem" id="Message<?php echo $row->message_id; ?>">
				<p class="MessageItemName"><?php $link = new User_Link($user = new User($row->recipient)); echo $link->output; ?></p>
				<p class="MessageItemDate"><?php $dt = new TimeStamp($row->sent_on); echo $dt->str_short; ?></p>
				<p class="MessageItemSubject"><a href="http://www.barnsley-ltu.co.uk/messages/<?php echo $row->thread_id; ?>"><?php echo substr($row->message,0,40); ?></a></p>
			</div>
			<?php
					}
				}
			?>
		</div>
	</div>
</div>