<?php
	if(isset($_GET['self']))
	{
		if(isset($_GET['id']))
		{
			$event = new Training_Event($_GET['id'], true);
		}
		elseif(isset($_GET['event_id']))
		{
			$event = new Training_Event($_GET['event_id'], true);
		}
		else
		{
			header('location: profile.php');
		}
	}
?>
<table style="width:100%;text-align:center">
	<colgroup>
		<col id="name">
		<col id="department">
		<col id="attending">
	</colgroup>
	<thead>
		<tr>
			<th scope="col">Colleague's Name</th>
			<th scope="col">Department</th>
			<th scope="col">Attending</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$x = 0;
		while($x != count($event->register))
		{
			$entry = $event->register[$x];					
	?>
	<tr>
			<td><a href="http://www.barnsley-ltu.co.uk/users/<?php echo $entry['user']->id; ?>"><?php echo $entry['user']->username; ?></a></td>
			<td><?php require_once('models/department.php'); $dep = new Department($entry['user']->department); echo $dep->name; ?></td>
			<td><?php if($_SESSION['account'] == "admin" || $_SESSION['uid'] == $entry['user']->id){ ?>
				<form>
					<select name="att" onchange="alterAttendance(this.options[this.selectedIndex].value, <?php echo $entry['user']->id; ?>)">
						<?php 
							if($entry['attending'] == 1)
							{
								echo '<option value="1" selected="selected">Invited</option>';
							}
							if($entry['attending'] == 2){$out = 'selected="selected"';}else{$out="";}
							echo '<option value="2" '.$out.'>Attending</option>';
							if($entry['attending'] == 3){$out = 'selected="selected"';}else{$out="";}
							echo '<option value="3" '.$out.'>Declined</option>';
						?>	
					</select>
				</form>
				<?php }else{ 
				$att = $entry['attending']; switch($att){case 1: echo "Invited"; break; case 2: echo "Attending"; break; case 3: echo "Declined"; break;}
				 } ?>
			</td>
	</tr>
	<?php
		$x++;
		}
	?>
	</tbody>
</table>
