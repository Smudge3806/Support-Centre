<?php
	//Create a Calendar
	//Lets select a Year. 2012
	
	// First Month
	
	$days = array();
	if(isset($_GET['year']))
	{
		$y = $_GET['year'];
	}
	else
	{
		$y = "2012";
	}
	$x = 1;
	while($x != 13)
	{
		$time = $y.'-'.$x.'-1 12:00:00';
		$days[date('M', strtotime($time))] = date('t', strtotime($time));
		
		$x++;
	}

?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Test::Calendar</title>
</head>

<body>
	<form method="GET">
		<select name="year">
			<option value="2012">2012</option>
			<option value="2011">2011</option>
			<option value="2010">2010</option>
		</select>
		<input type="submit" value="Go">
	</form>
<table>
	<thead>
		<tr>
			<th>Month</th>
			<th>Number of Days</th>
			<th>First Day</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$year_num = 0;
			$mon = 1;
			while($month = current($days))
			{
				?>
				<tr>
					<td id="month"><?php echo key($days); ?></td>
					<td id="days"><?php echo current($days); ?> </td>
					<td id="first-day"><?php echo date('l', mktime(0,0,0,$mon,1,$y)); ?></td>
				</tr>
			<?php
				$mon++;
				$year_num += current($days);
				next($days);
			}
		?>
			<tr>
				<td><b>Total:</b></td>
				<td><?php echo $year_num; ?></td>
			</tr>
	</tbody>
</table>
</body>

</html>
