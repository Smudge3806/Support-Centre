<?php
	$result = $mysqli->query('SELECT * FROM departments ORDER BY department_name ASC');
	if($result->num_rows == 0)
	{
	?>
		<b>There are no departments in the database... Therefore the can be no courses!</b>
	<?php
	}
	else
	{
		require_once('models/department.php');
		$departments = array();
		?>
		<div class="MoodleDepartmentList">
		<select onchange="MoodleDepartmentList(this.options[this.selectedIndex])">
		<?php
		while($row = $result->fetch_object())
		{
			$departments[] = new Department($row->did);			
			?>
			<option style="cursor:pointer" rel="MoodleCourses<?php echo $row->department_name; ?>" class="MoodleDepartmentListItem" onselect="MoodleDepartmentList(this)"><?php echo $row->department_name; ?></option>
			<?php
		}
		?>
		</select>
		</div>
		<div id="MoodleControls">
			<span class="MoodleControlNew">
				<a href="https://www.barnsley-ltu.co.uk/courses/new">Create a Course</a>
			</span>
		</div>
		<hr>
		<div id="MoodleDisplay">
			
		</div>
		<div id="MoodleCourses" style="display:none">
			<?php
				$x = 0;
				while($x != count($departments))
				{
					$result = $mysqli->query('SELECT * FROM moodle_pages WHERE department_id = '.$departments[$x]->id.' ORDER BY course_title ASC');
					if($result->num_rows == 0)
					{
						?>
						<b>There are no Courses registered to this department!</b>
						<?php
					}
					else
					{
						require_once('models/moodle.php');
						?>
						<div id="MoodleCourses<?php echo $departments[$x]->name; ?>">
						<?php
						while($course = $result->fetch_object())
						{
							$course = new MoodleCourse($course->page_id);
							?>
								<span class="MoodleTile">
									<a href="https://www.barnsley-ltu.co.uk/courses/<?php echo $course->id; ?>/view" class="MoodleTileTitle"><?php echo $course->moodle_title; ?></a>
									<a href="<?php echo $course->url; ?>" class="MoodleTileURL"><?php echo $course->url; ?></a>
								</span>
							<?php
						}
						?>
						</div>
						<?php
					}
					$x++;
				}
			?>
		</div>
		<?php
	}
?>