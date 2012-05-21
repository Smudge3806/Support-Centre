<?php 
	include('controllers/dbconnection.php');
	?>
	<p style="padding-right:10px">Sort By:</p>
	<div id="adminList">
		<a rel="allReport" style="cursor:pointer" id="activeSOR" onclick="showReports(this)">All</a>
		<?php
			$officers = $mysqli->query('SELECT * FROM users WHERE type = "admin" AND uid != 35');
			while($officer = $officers->fetch_object())
			{
				?>
		<a rel="<?php echo $officer->first_name.$officer->last_name; ?>Report" style="cursor:pointer" onclick="showReports(this)"><?php echo $officer->first_name." ".$officer->last_name; ?></a>
				<?php
			}						
		?>
		<a rel="ClosedReport" style="cursor:pointer" onclick="showReports(this)">Closed Reports</a>
	</div>
<?php
	//unset($mysqli);
?>