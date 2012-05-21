<?php
	$str = $_GET['name'];
	include('dbconnection.php');
	if(strlen($str) == 0)
	{
		$mysqli->kill;
		unset($mysqli);
		echo "Enter a Name.";
	}	
	else
	{
		$result = $mysqli->query('SELECT * FROM users WHERE CONCAT(first_name, " ", last_name) LIKE "%'.$str.'%"');
		if($result->num_rows == 0)
		{
			$mysqli->kill;
			unset($mysqli);
			echo "No Results Found";
		}
		else
		{
			$output="";
			$output.="<table>";
			while($raw = $result->fetch_object())
			{
				$output.="<tr>";
				$output.="<td><a href='../user_profile.php?id=".$raw->uid."'>".$raw->first_name." ".$raw->last_name."</a></td>";
				$output.="<td>".$raw->type."</td>";
				$output.="</tr>";
			}
			$output.="</table>";
			$mysqli->kill;
			unset($mysqli);
			echo $output;
		}
	}
?>