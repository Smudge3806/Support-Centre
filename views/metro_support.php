<div id="tile">
	
		<a href="https://www.barnsley-ltu.co.uk/support/view/" title="See your Support Requests">All Support Requests</a>
			<div id="slider1" style="font-size:small;padding-top:20px">
				<div>
					<p style="font-size:small;padding-top:0px;margin-top:0px">See your most recent support requests here.
					This tile will show you the status of the last two requests to be looked at by you or your support officer.</p>
				</div>
			<?php
				 $requests = $mysqli->query('SELECT * FROM `support_requests` AS sr, `support_status` AS ss WHERE uid = '.$uid);
				 if($requests->num_rows == 0)
				 {
					?>
						<div>
							<p style="margin:0px;padding:0px">You don't have any active Support Requests.</p>
						</div>
						<div>
							<a href="https://www.barnsley-ltu.co.uk/support/new/moodle/<?php echo $uid; ?>" title="Click here to submit a support request">Click here to Submit a Support Request</a>
						</div>
					<?php
				}
				else
				{ 
										
			?>
				<div>
					<?php
						$requests = $mysqli->query('SELECT * FROM `support_requests` AS sr, `support_status` AS ss WHERE uid = '.$uid.' AND sr.rid = ss.rid AND ss.status = "Inbox" ORDER BY ss.date_set DESC LIMIT 0,2');
						if($requests->num_rows == 0)
						{
						?>
							<p style="font-size:small;padding-top:0px;margin-top:0px">There are no Reports currently waiting to be read.</p>
						<?php
						}
						else
						{
					?>
					<table style="width:230px;text-align:center">
						<tr>
							<th>Summary</th>
							<th>Status</th>
						</tr>
						<?php
							while($raw = $requests->fetch_object())
							{
								require_once('models/support_request.php');
								$request = new Support_Request($raw->rid);
								if(strlen($request->summary) > 30)
								{
									$summary = substr($request->summary, 0, 26);
									$summary = $summary."...";
								}
								else
								{
									$summary = $request->summary;
								}


						?>
						<tr>
							<td><a href="https://www.barnsley-ltu.co.uk/support/<?php echo $request->rid; ?>" title="Click here to see this request"><?php echo $summary; ?></a></td>
							<td><a href="https://www.barnsley-ltu.co.uk/support/<?php echo $request->rid; ?>" title="Click here to see this request"><?php echo $request->status; ?></a></td>
						</tr>
						<?php } ?>
					</table>
					<?php } ?>
				</div>
				<div>
					<?php
						$requests = $mysqli->query('SELECT * FROM `support_requests` AS sr, `support_status` AS ss WHERE uid = '.$uid.' AND sr.rid = ss.rid AND ss.status = "Open" ORDER BY ss.date_set DESC LIMIT 0,2');
						if($requests->num_rows == 0)
						{
							?>
							<p style="font-size:small;padding-top:0px;margin-top:0px">There are no Open Reports.</p>
							<?php
						}
						else
						{
					?>
					<table style="width:230px;text-align:center">
						<tr>
							<th>Summary</th>
							<th>Status</th>
						</tr>
						<?php
							while($raw = $requests->fetch_object())
							{
								require_once('models/support_request.php');
								$request = new Support_Request($raw->rid);
								if(strlen($request->summary) > 30)
								{
									$summary = substr($request->summary, 0, 24);
									$summary = $summary."...";
								}
								else
								{
									$summary = $request->summary;
								}


							?>
								<tr>
									<td><a href="https://www.barnsley-ltu.co.uk/support/<?php echo $request->rid; ?>" title="Click here to see this request"><?php echo $summary; ?></a></td>
									<td><a href="https://www.barnsley-ltu.co.uk/support/<?php echo $request->rid; ?>" title="Click here to see this request"><?php echo $request->status; ?></a></td>
								</tr>
							<?php
							}
						?>
					</table>
					<?php } ?>
				</div>
				
					<?php
						$requests = $mysqli->query('SELECT * FROM `support_requests` AS sr, `support_status` AS ss WHERE uid = '.$uid.' AND sr.rid = ss.rid AND ss.status = "Closed" ORDER BY ss.date_set DESC LIMIT 0,2');
						if($requests->num_rows == 0)
						{
							//Do Nothing - Go to Next View
						}
						else
						{
					?>
					<div>
					<table style="width:230px;text-align:center">
						<tr>
							<th>Summary</th>
							<th>Status</th>
						</tr>
						<?php
							while($raw = $requests->fetch_object())
							{
								require_once('models/support_request.php');
								$request = new Support_Request($raw->rid);
								if(strlen($request->summary) > 30)
								{
									$summary = substr($request->summary, 0, 24);
									$summary = $summary."...";
								}
								else
								{
									$summary = $request->summary;
								}
							?>
								<tr>
									<td><a href="https://www.barnsley-ltu.co.uk/support/<?php echo $request->rid; ?>" title="Click here to see this request"><?php echo $summary; ?></a></td>
									<td><a href="https://www.barnsley-ltu.co.uk/support/<?php echo $request->rid; ?>" title="Click here to see this request"><?php echo $request->status; ?></a></td>
								</tr>
							<?php
							}
						?>
					</table>
					</div>
					<?php } ?>
				

				<div>
						<a href="https://www.barnsley-ltu.co.uk/support/new/moodle/<?php echo $uid; ?>" title="Click here to submit a support request">Click here to Submit a Support Request</a>
				</div>

			<?php 
				} 
			?>
			</div>
		
		</div>