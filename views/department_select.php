<select name="departments">
	<?php 
		while($department = $department_list->fetch_object())
		{
			if($department->did == $did)
			{
				?>
					<option value="<?php echo $department->did; ?>" selected="selected"><?php echo $department->department_name; ?></option>
				<?php
			}
			else
			{
			?>
				<option value="<?php echo $department->did; ?>"><?php echo $department->department_name; ?></option>
			<?php
			}
	 	}
	?>
</select>