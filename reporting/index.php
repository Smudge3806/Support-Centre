<?php
	DEFINE('DB_USER', 'barnsle2_ilp', true);
	DEFINE('DB_PASS', 'barnsle12', true);
	DEFINE('DB_NAME', 'barnsle2_ilp', true);
	$mysqli = @new Mysqli('localhost', DB_USER, DB_PASS, DB_NAME);
	if ($mysqli->connect_error) 
	{
    		die('Connect Error: ' . $mysqli->connect_error);
	}		
				
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Moodle ILP Data</title>
		<link rel="stylesheet" href="../styles/main.css">
		<link rel="stylesheet" href="../styles/metro.css">
		<link rel="stylesheet" href="../styles/about.css">
		<link rel="stylesheet" href="../styles/pie.css">
		<link rel="shortcut icon" href="../img/favicon.ico">							
	</head>
	<body>
		<?php include('../views/page_header.php'); ?>
		
		<div class="description" style="margin-top:25px">
			<div class="inner" style="opacity:1; box-shadow: #666 0px 0px 15px">
				<h2 id="title">Old Moodle ILP Reports</h2>
			</div>			
		</div>
		<div style="float:left; clear:both; width:603px; margin: -12px 14px 0px 14px" class="container">
			<h3 id="title">Choose a Student</h3>
			<br>		
			<?php
				$students = array();	
				$conc_students = $mysqli->query('SELECT * FROM get_student_numbers_conc');
				while($studs = $conc_students->fetch_object())
				{
					require_once('models/student.php');
					$stud = new Student($studs->num);
					$students[] = $stud;		
				}
				$targ_students = $mysqli->query('SELECT `Student Number` AS num FROM Targets');
				while($studs = $targ_students->fetch_object())	
				{
					$x = 0;	
					while($x != count($students))
					{
						$stud = $students[$x];
						if(!$studs->num == $stud->student_number)
						{
							require_once('models/student.php');
							$student = new Student($studs->num);
							$students[] = $student;			
						}
						
						$x++;						
					}
					unset($x);				
						
				}
				
				$mysqli->kill;																		
			?>
			<ul>
				<?php
				$x =0;	
					while($x != count($students))
					{
						?>
						<li><a href="student.php?id=<?php echo $students[$x]->student_number; ?>" title="Click here to see <?php echo $students[$x]->student_name; ?>"><?php echo $students[$x]->student_number." - ".$students[$x]->student_name; ?></a>
						<?php
						$x++;			
					}			
				?>		
			<ul>				
		</div>					
	</body>			
</html>