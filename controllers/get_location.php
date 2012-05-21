<?php
		$result = $mysqli->query('SELECT l.location FROM locations AS l, departments AS d WHERE l.lid = d.location AND d.did ='.$did);
		if($result->num_rows == 1)
		{
			var_dump($result);
			$temp = $result->fetch_object();
			$location = $temp->location;
		}
		else
		{
			if($result->num_rows == 0)
			{
				$location = "Theres Been a Problem."
			}
		}
?>