<?php
	// Get a Date Time to Convert... any will do.
	include('../controllers/dbconnection.php');
	$result = $mysqli->query('SELECT joined_on FROM users LIMIT 1');
	if($result->num_rows == 0)
	{
		echo "<b>Console: </b>Theres been a problem.<br>No Users Found<br>";
	}	
	else
	{
		$temp = $result->fetch_object();
		$dt = $temp->joined_on;
		//	Tidy Up
		unset($temp);
		$mysqli->close();
		unset($mysqli);
		echo "<b>Console: </b>Test Begun<br><b>Console: </b>DateTime Found: ".$dt."<br>";
		// Using Library Functions date() + strtotime()
		// collect the output of date function in a variable.
		// use a string of predefined characters to provide a format (l(Wednesday) j(16)S(th) \of F(November) Y(2011))
		// nest the strtotime() function to transform the database output from a string (PHP Default State) into a DateTime Object
		// More Information at: http://php.net/manual/en/function.date.php
		$d = date('l jS \of F Y', strtotime($dt));
		$t = date('h:i:s A T', strtotime($dt));
		echo "<b>Console: </b>Date: ".$d."<br>";
		echo "<b>Console: </b>Time: ".$t."<br>";
	}
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Test::DateTime Conversion</title>
</head>

<body>

</body>

</html>
