<?php
	
	require_once('models/student.php');
	$student = new Student($_GET['id']);
								
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Moodle ILP Student Data</title>
		<link rel="stylesheet" href="../styles/main.css">
		<link rel="stylesheet" href="../styles/metro.css">
		<link rel="stylesheet" href="../styles/about.css">
		<link rel="stylesheet" href="../styles/pie.css">
		<link rel="shortcut icon" href="../img/favicon.ico">						
	</head>
	<body onload="alert('To print these records, simply right-click on the page, and select print. To navigate back to the homepage, use your browsers navigational buttons.');">
		<?php include('../views/page_header.php'); ?>
		
		<div class="description" style="margin-top:25px">
			<div class="inner" style="opacity:1; box-shadow: #666 0px 0px 15px">
				<h2 id="title">Old Moodle ILP Reports - <?php echo $student->student_name; ?></h2>
			</div>			
		</div>
		<div style="float:left; clear:both; width:603px; margin: -12px 14px 0px 14px;" class="container">
			<?php
				
				echo "<p>".$student->student_number." ".$student->student_name."</p>";
				echo "<hr><h3 id='title'>Concerns</h3>";		
				echo "<br>";
				$x = 0;	
				$concerns = $student->concerns;	
				while($x != count($concerns))
				{
					$concern = $concerns[$x];	
					echo "<b>".$concern->concern_id.". ".$concern->tutor." - ".$concern->course."</b><br><br>";
					echo $concern->comment."<br><br>";		
					$x++;		
				}																		
			?>
			<hr>
			<h3 id="title">Targets</h3>
			<br>		
			<?php
				$x = 0;
				$targets = $student->targets;
				while($x != count($targets))
				{
					$target = $targets[$x];
					echo "<b>".$target->target_id.". ".$target->tutor." - ".$target->course."</b><br><br>";
					echo $target->targets."<br><br>";
					$x++;
				}							
			?>							
		</div>					
	</body>			
</html>