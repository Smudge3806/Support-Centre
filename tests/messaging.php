<?php
	session_start();
	if(!isset($_SESSION['account']) && $_SESSION['account'] != "admin")
	{
		header('location: profile.php?m=You Dont Have Permission to be there!');
	}		
	if(!isset($_GET['id']))
	{	
		include('../controllers/dbconnection.php');
		$result = $mysqli->query('SELECT * FROM users WHERE type = "Admin" AND uid <> '.$_SESSION['uid']);
		if($result->num_rows == 0)
		{
			echo "Theres Been a Problem!";
		}				
		else
		{
							
		}			
		
	}
	else
	{
		require_once('../models/user.php');
		$user = new User($_GET['id'], false);		
		$id = $_GET['id'];
	}						
			
?>
<!doctype html>
<html>
	<head>
		<title>Test::Messaging</title>
		<link rel="stylesheet" href="../styles/main.css">
		<link rel="stylesheet" href="../styles/metro.css">
		<link rel="stylesheet" href="../styles/pie.css">
		<link rel="stylesheet" href="../styles/about.css">
		<script type="text/javascript">
			function showStep3()
			{
				$elem = document.getElementById('step3').style.display = "block";
				$elem = document.getElementById('step2').style.display = "none";	
			}				
		</script>							
	</head>
	<body>
		<?php include('../views/page_header.php'); ?>
			
		<div class="description" style="margin-top:25px">
			<div class="inner">		
				<h2 id="title">Messaging Test</h2>
			</div>
		</div>		
			
		
	<div id="content" style="margin:13px;margin-top:25px;float:left;clear:both">
		<div id="step1" style="background-color:white; box-shadow: #666 0px 0px 15px; padding:25px; width:100%; margin:25px">		
		<h2>Step 1</h2>	
		<?php
			if(!isset($id))
			{
				?>
					<p>Select a User to Message</p>
				<?php	
					require_once('../models/user.php');
				?>
					<form method="get">
						<select name="id">	
				<?php				
				while($raw = $result->fetch_object())
				{
					$user = new User($raw->uid, false);
				?>	
							<option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
				<?php
				}
				?>
						</select>
						<input type="submit" value="Select User">	
					</form>	
				<?php				
						
			}
			else
			{
				?>
					<p><span style="color:lime">Complete!</span> You selected <?php echo $user->username; ?>.</p>
					<a href="messaging.php">Click to clear this selection</a>	
				<?php		
			}							
		?>
		</div>
		<?php if(isset($id)){ ?>	
		<div id="step2" style="background-color:white; box-shadow: #666 0px 0px 15px; padding:25px; width:100%; margin:25px; margin-left:25px">
			<h2>Step 2</h2>
			<p><a href="../message.php?recip=<?php echo $user->id?>" target="_blank" onclick="showStep3()">Send a Message to <?php echo $user->username; ?></a>.</p>	
		</div>
		<div id="step3" style="background-color:white; box-shadow: #666 0px 0px 15px; padding:25px; width:100%; margin:25px; margin-left:25px;display:none">
			<h2>Step 3</h2>
			<p>Great! Now go to the Wall, and see if you can find your message thread. Try sending a Knock Knock Joke to the other person.</p>
			<a href="../index.php" title="The Administrative Wall">Click to go to the Wall</a>	
		</div>	
		<?php } ?> 						
		</div>							
	</body>
</html>				
