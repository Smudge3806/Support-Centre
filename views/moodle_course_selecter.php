<?php
	if(!isset($user_id))
	{
		if(isset($_GET['user']))
		{
			$result = $mysqli->query('SELECT * FROM moodle_assignments WHERE user_id ='.$user_id);
			if($result->num_rows == 0)
			{
				?>
				<a href="moodle.php?func=join&id=<?php echo $_GET['user'];?>">Enroll to a course...</a>
				<?php
			}
			else
			{
				?>
				<select name="course" required>
					<option>Select a Course...</option>
					<?php
					while($raw = $result->fetch_object())
					{
						?>
					<option value="<?php echo $raw->course_code; ?>"><?php echo $raw->moodle_title; ?></option>
					<?php	
					}	
					?>
				</select>
				<?php
			}	
		}
	}
?>