<?php
	include('controllers/is_logged_in.php');
	include('controllers/dbconnection.php');
	$uid = $_SESSION['uid'];
	$result = $mysqli->query('SELECT * FROM users WHERE uid = '.$uid);
	$user = $result->fetch_object();
	$did = $user->department_id;
	$result = $mysqli->query("SELECT * FROM departments WHERE did = ".$did);
	$department = $result->fetch_object();
?>
<!DOCTYPE html>
<html>

<head>


<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/metro.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/main.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/about.css">
<link rel="stylesheet" href="https://www.barnsley-ltu.co.uk/styles/pie.css">
<link rel="shortcut icon" href="https://www.barnsley-ltu.co.uk/img/favicon.ico" >
<script type="text/javascript">
	var lastElem = "none"; // Default ["none"] - the active Element or Last element in use
	var lastElemDefault = ""; // The Original Text Entry
	var lastElemStart = ""; // A Copy of the starting values.
	function switchActiveElem(newElem)
	{
		if(newElem.id != lastElem.id) // if not the same
		{
			if(lastElem.value != lastElemStart.value)
			{
				var answer = confirm("You have not submitted this change, are you sure you want to continue without saving?");
				if(answer)
				{
					if(lastElem != "none")
					{
						lastElem.parentNode.innerHTML = lastElemStart;
					}
					lastElem = document.getElementById('field_'+newElem.id);
					lastElemDefault = newElem.parentNode.innerHTML;
					lastElemStart = lastElem;		
				}
			}
			else
			{
				var answer = confirm("Are you finished with this?");
				if(answer)
				{
					if(lastElem != "none")
					{
						lastElem.parentNode.innerHTML = lastElemDefault;
					}
					lastElem = document.getElementById('field_'+newElem.id);
					lastElemDefault = newElem.parentNode.innerHTML;
					lastElemStart = lastElem;
				}
			}
		}
		else // if the same, close
		{
			lastElem.parentNode.innerHTML = lastElemDefault;
			lastElem = "none"; // Override and Nullify the lastElems store
		}
	}
</script>
<title>Account Settings</title>

</head>

<body>	
	<div class="header"  style="float:right;display:inline">
	<?php include('views/page_header.php'); ?>
	</div>
		<div class="metro">
		<?php include('views/metro_navigation.php'); ?>
	</div>
	<div class="container" style="clear:both;border-radius:5px">
	<?php if(isset($_GET['m']))
	{?>
	<div class="notice" style="float:none;padding:25px">
		<?php echo $_GET['m']; ?>
	</div>
<?php } ?>
		<table class="user_info">
			<tr>
				<td id="label">Forename:</td>
				<td id="info"><!--<span id="forename" onclick="switchActiveElem(this)"><?php echo $user->first_name; ?></span>-->
					<form name="forename" action="https://www.barnsley-ltu.co.uk/controllers/change_name.php" method="post">
						<input type="hidden" name="page" value="account.php">
						<input type="hidden" name="field" value="forename">
						<input type="text" name="info" value="<?php echo $user->first_name; ?>">
						<input type="submit" value="Change"> 
					</form>
				</td>
			</tr>
			<tr>
				<td id="label">Surname:</td>
				<td id="info"><form name="surname" action="https://www.barnsley-ltu.co.uk/controllers/change_name.php" method="post">
					<input type="hidden" name="page" value="account.php">
					<input type="hidden" name="field" value="surname">
					<input type="text" name="info" value="<?php echo $user->last_name; ?>">
					<input type="submit" value="Change"> 
				</form></td>
			</tr>
			<tr>
				<td id="label">Email:</td>
				<td id="info"><?php echo $user->email; ?></td>
			</tr>
			<tr>
				<td id="label">Extension:</td>
				<td id="info"><form name="telephone" method="post" action="https://www.barnsley-ltu.co.uk/controllers/change_telephone.php">
					<input type="hidden" name="page" value="account.php">
					<input type="text" name="ext" value="<?php echo $user->telephone; ?>">
					<input type="submit" value="Change">
				</form></td>
			</tr>
			<tr>
				<?php include("controllers/department_list.php"); ?>
				<td id="label">Department:</td>
				<!-- auto-select -> selected="selected" -->
				<td id="info"><form name="department" action="controllers/change_department.php" method="post">
				<input type="hidden" name="page" value="https://www.barnsley-ltu.co.uk/account.php">
				<?php include('views/department_select.php'); ?>
				<input type="submit" value="Change">
				</form></td>
			</tr>
			
		</table>
	
	</div>
	<div id="fields" style="display:none">
		<div id="field_forename">
			<form name="forename" action="https://www.barnsley-ltu.co.uk/controllers/change_name.php" method="post">
				<input type="hidden" name="page" value="account.php">
				<input type="hidden" name="field" value="forename">
				<input type="text" name="info" value="<?php echo $user->first_name; ?>">
				<input type="submit" value="Change"> 
			</form>
		</div>
	</div>
		<?php
		include('views/page_footer.php');
	?>

</body>

</html>
