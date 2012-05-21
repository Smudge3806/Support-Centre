<div id="support_info_ui" style="width:48%;float:left;clear:left;">
	<fieldset>
		<legend>Support Requests</legend>
		<?php
			$result = $mysqli->query('SELECT * FROM support_requests WHERE uid = '.$user->id);
			if($result->num_rows == 0)
			{
				echo "<b>There are no support requests for this user</b><br/>";
			}
			else
			{
				while($raw = $result->fetch_object())
				{
					require_once('models/support_request.php');
					$support = new Support_Request($raw->rid);
					?>
					<table style="border:thin #99CCFF solid; margin-bottom:10px">
						<tr>
							<td id="alt"><a href="support.php?id=<?php echo $support->rid; ?>"><?php echo $support->type; ?></a></td>
							<td>Status: <?php echo $support->status; ?></td>
						</tr>
						<tr>
							<td><?php echo $support->summary; ?></td>
							<td>Sent On: <a title="<?php echo $support->created_on; ?>"><?php $date = explode(" ", $support->created_on); echo $date[0];?></a></td>
						</tr>					
						</table>
						<table style="border:thin #99CCFF solid;">
						<tr>
							<td colspan="2">Notes on this Request</td>
						</tr>
						<?php
							$x = 0;
							while($x != count($support->notes))
							{
								$note = $support->notes[$x];
								if($note == "No Notes Available")
								{
									echo "<tr><td><b>There are no notes for this support request</b></td></tr>";
								
								}
								else
								{
									?>
										<tr>
											<td id="alt">Sender: <a href="user_profile.php?id=<?php echo $note['sender']->id; ?>"><?php echo $note['sender']->username ;?></a></td>
											<td>Sent: <a title="<?php echo $note['date']; ?>"><?php $date = explode(" ", $note['date']);echo $date[0];?></a></td>
										</tr>
										<tr>
											<td>Message: <?php echo $note['message']; ?></td>
										</tr>
									<?php
								}
								$x++;
							}
						?>
					</table>
					<hr style="margin-bottom:25px;">
					<?php
				}
			}
		?>
	</fieldset>
</div>