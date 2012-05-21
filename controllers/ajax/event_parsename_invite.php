<?php
	$name = "NONE";

	if(isset($_GET['name']))
	{
		$name = $_GET['name'];
	}
			
	include('../dbconnection.php');
	if($name == "NONE")
	{
		$stmt = "SELECT * FROM users";
	}
	else
	{
		$sch_string = explode(":", $name);
		if(count($sch_string) >= 1)
		{
			// a parameter search
			$prefix = $sch_string[0];
			switch($prefix) //No need for switch at the moment but allows the adding of search parameters later
			{
				case "department":
					$result = $mysqli->query('SELECT * FROM departments WHERE department_name LIKE "%'.$sch_string[1].'%"');
					if($result->num_rows == 1)
					{
						$raw = $result->fetch_object();
						$did = $raw->department_id;
					}
					$stmt = "SELECT * FROM users WHERE department_id = ".$did;
					break;
			}
		}
		
			$spl_name = explode(" ", $name);
			if(count($spl_name)>1)
			{
				$fname = $spl_name[0];
				$lname = $spl_name[1];
				$stmt = "SELECT * FROM users WHERE first_name LIKE '%".$fname."%' AND last_name LIKE '%".$lname."%'";
			}
			else
			{		
				// no break between the name... check for . @
				$init_name = explode(".", $name);
				if(count($init_name) > 1)
				{
					// Success??
					// check for @
					$init_name = explode("@", $name);
					if(count($init_name)>1)
					{
						// email address
						$stmt = "SELECT * FROM users WHERE email LIKE '%".$name."%'";
					}
					else
					{
						// see if it was initals ie. c.smith
						$delimiter = false;
						for($x = 0, $char = $name[$x]; $x != count($name); $x++)
						{
							if($char == ".")
							{
								$delimiter = true;
								break;
							}
							else
							{
								if(!$delimiter)
								{
									$before_delimiter.= $char;
								}
								else
								{
									// Make sure there isn't another inital and save the two in separate variables
									if($char != ".")
									{
										$after_delimiter.= $char;
									}
									else
									{
										$after_delimiter = "";
									}
								}
							}
							
						} // end for
						if(count($before_delimiter) < 2)
						{
							$stmt = "SELECT * FROM users WHERE first_name LIKE '%".$before_delimiter."%' AND last_name LIKE '%".$after_delimiter."%'";
						}
					} // end else
				} // end if
				
			}// end else
			
		if(isset($stmt))
		{
			
			$result = $mysqli->query($stmt);
		}
		else
		{
			$result = $mysqli->query("SELECT * FROM users");
		}
		
			if($result->num_rows != 0)
			{
				require_once('../../models/user.php');
				require_once('../../models/user_link.php');
				?>
				<table>
					<thead>
						<tr>
							<th>Username</th>
							<th>Department</th>
							<th>Email</th>
							<th>Invite</th>
						</tr>
					</thead>
					<tbody>
						<?php
							while($raw = $result->fetch_object())
							{
								$src_user = new User($raw->uid, true, true);
						?>
							<tr>
								<td><?php $link = new User_Link($src_user); echo $link->output; ?></td>
								<td><?php echo $src_user->department->name; ?></td>
								<td><?php echo $src_user->email; ?></td>
								<td><a href="" onclick="$.fancybox.close(); invite_user(<?php echo $src_user->id; ?>)">Invite</a></td>
							</tr>					
						<?php
							}
						?>
					</tbody>
				</table>			
				<?php	
			}
			else
			{
				echo "<p>There are no users by this name.</p>";
				
			}
		
		
	}
		
?>