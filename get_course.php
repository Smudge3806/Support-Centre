<?php
	include('controllers/dbconnection.php');
	$result = $mysqli->query('SELECT * FROM moodle_pages WHERE page_id ='.$_GET['id']);
	if($result->num_rows == 0)
	{
		?>
		<p>There are no records that match that id number.</p>
		<?php
	}
	else
	{
		$row = $result->fetch_object();
		if($row->department_id != 21)
		{
			?>
			<p>This Course has already been assigned to a department.</p>
			<?php
		}
		else
		{
			?>
			<p>Course Title: <a href="<?php echo $row->url; ?>" target="_blank"><?php echo $row->course_title; ?></a></p>
			<a href="<?php echo $row->url; ?>" target="_blank"><?php echo $row->url; ?></a>
			<p>Course Code: <?php if(isset($row->course_code)){echo $row->course_code; }else{echo "No Course Code"; } ?></p>
			<form>
				<input type="hidden" name="rec_id" value="<?php echo $_GET['id']; ?>">
				<select name="dep_id">
					<?php 
						$departments = $mysqli->query('SELECT * FROM departments WHERE did != 21');
						while($department = $departments->fetch_object())
						{
						?>
							<option value="<?php echo $department->did; ?>"><?php echo $department->department_name; ?></option>
						<?php
						}
					?>
				</select>
				<input type="submit" value="Assign">
			</form>
			<?php
		}
	}
	unset($mysqli);
?>