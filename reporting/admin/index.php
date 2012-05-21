<?php
	if(isset($_POST['stud_num']))
	{
		$tbl = $_POST['type'];
		if($tbl == "Concerns")
		{
			$fields = "`ConcernID`, ";
		}
		else
		{
			$fields = "`TargetID`, ";
		}									
		$fields .= "`Student Name`, `Student Number`, `Tutor Name/Number`, ";
		$data = "NULL, '".$_POST['stud_name']."', ".$_POST['stud_num'].", '".$_POST['tutor']."', '";	
		if(isset($_POST['course']) && $_POST['course'] != "" )
		{	
			$fields .= "`Course`, ";
			$data .= $_POST['course']."', '";	
		}				
		if($tbl == "Concerns")
		{
			$fields .= "`Comments`, `Created On`";
		}
		else
		{
			$fields .= "`Targets`, `Created On`";
		}
		$data .= $_POST['comments']."', CURRENT_TIMESTAMP";
		
		$stmt = "INSERT INTO ".$tbl." (".$fields.") VALUES (".$data.")";
		
		DEFINE('DB_USER', 'barnsle2_ilp', true);
		DEFINE('DB_PASS', 'barnsle12', true);
		DEFINE('DB_NAME', 'barnsle2_ilp', true);
		$mysqli = @new Mysqli('localhost', DB_USER, DB_PASS, DB_NAME);
		if ($mysqli->connect_error) 
		{
	    		die('Connect Error: ' . $mysqli->connect_error);
		}		
		else
		{
			$mysqli->query($stmt);
			if($mysqli->insert_id != 0)
			{
				$message = "Save Successful";
			}
			else
			{
				$message = "Save Unsuccessful - ".$mysqli->error;
				var_dump($mysqli);
				echo $stmt;			
			}				
		}													
	}		
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Moodle ILP Data Entry</title>
		<link rel="stylesheet" href="../../styles/main.css">
		<link rel="stylesheet" href="../../styles/metro.css">
		<link rel="stylesheet" href="../../styles/about.css">
		<link rel="stylesheet" href="../../styles/pie.css">
		<link rel="shortcut icon" href="../../img/favicon.ico">
		<style type="text/css">
			.button	
			{
				float:left;
				background-color:silver;
				border: thin grey solid;
				color:grey;
				padding: 2px 12px;
				margin-right:4px;	
			}
			.button:hover
			{
				background-color:grey;
				border: thin black solid;
				color:black;
			}							
		</style>				
		<script type="text/javascript">
			function counter(thisfield)
			{
				$count = thisfield.value.length;
				$left = 2000 - $count;
				document.getElementById('count').value = $left;		
			}
			function clear_saves()
			{
				$var = window.document.getElementById('stud_num').removeAttribute('value');
				$var = window.document.getElementById('stud_name').removeAttribute('value');	
			}				
			
		</script>	
	</head>
	<body>
		<?php include('../../views/page_header.php'); ?>
		
		<div class="description" style="float:left;clear:both;margin-top:25px">
			<div class="inner" style="opacity:1; box-shadow: #666 0px 0px 15px; position:relative">
				<h2 id="title">Old ILP Data Entry Form</h2>
			</div>
		</div>
		<div class="container" style="width:603px;float:left;clear:both;margin: -20px 14px 0px 14px; padding:25px">
			<?php if(isset($message))
				{
			?>			
			<div style="background-color:infobackground; border: thin black solid; padding: 5px">
				<b><?php echo $message; ?></b>
			</div>		
			<?php } unset($message) ?>	
			<form name="old_ilp" method="post">
				<table>
					<tr>
						<td><label>Student Number: </label></td>
						<?php if(isset($_POST['stud_num']))
						{
						?>
							<td><input type="text" name="stud_num" id="stud_num" placeholder="0000000" value="<?php echo $_POST['stud_num']; ?>" required></td>
						<?php		
						}
						else
						{?>
							<td><input type="text" name="stud_num" placeholder="0000000" required></td>
						<?php } ?>					
					</tr>
					<tr>
						<td><label>Student Name: </label></td>
						<?php if(isset($_POST['stud_name'])) { ?>
						<td><input type="text" name="stud_name" id="stud_name" placeholder="Joe Bloggs" value="<?php echo $_POST['stud_name']; ?>" required></td>
						<?php } else { ?>			
						<td><input type="text" name="stud_name" placeholder="Joe Bloggs" required></td>
						<?php } unset($_POST); ?>	
					</tr>	
				</table>
				<hr>
				<table>
					<tr>
						<td><label>Tutor: </label></td>
						<td><input type="text" name="tutor" placeholder="Joe Bloggs" required></td>
					</tr>
					<tr>
						<td><label>Course: </label></td>
						<td><input type="text" name="course" placeholder="No Course Recorded"></td>
					</tr>								
				</table>	
				<hr>
				<table>
					
					<tr>	
						<td><textarea cols="50" rows="10" name="comments" maxlength="2000" placeholder="Comments/Targets" required onkeydown="counter(this)"></textarea></td>
						<td><input type="text" readonly="readonly" value="2000" id="count" style="width:32px;border:none">Characters</td>
					</tr>
					<tr>
						<td><label>Concern: </label><input type="radio" name="type" id="type" value="Concerns"><label> Target: </label><input type="radio" name="type" id="type" value="Targets"></td>	
					</tr>			
					<tr>
						<td colspan="2"><input type="submit" value="Save" class="button"><input type="reset" value="Clear" class="button" onclick="clear_saves()"></td>
					</tr>			
							
				</table>									
			</form>		
		</div>										
	</body>									
</html>