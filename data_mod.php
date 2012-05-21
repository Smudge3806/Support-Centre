<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Data Modification Panel</title>
<script type="text/javascript">
	var xmlhttp;
	
	try
	{
		xmlhttp = new XMLHttpRequest();
	}
	catch(err1)
	{
		try
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(err2)
		{
			try
			{
				xmlhttp = new ActiveXObject("MSXML2.XMLHTTP");
			}
			catch(err3)
			{
				alert('There has been a problem: '+err3.message);
			}
		}
	}
	
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			document.getElementById('activeArea').innerHTML = xmlhttp.responseText;
		}
	}
	
	<?php
		if(isset($_GET['dep_id']))
		{
			echo "sendData(".$_GET['dep_id'].", ".$_GET['rec_id'].");";
		}
		elseif(isset($_GET['rec_id']))
		{
			echo "getData(".$_GET['rec_id'].");";
		}
		
	?>
	
	function getData(id)
	{
		xmlhttp.open("GET", "get_course.php?id="+id, true);
		xmlhttp.send();
	}
	
	function sendData(department_id, record_id)
	{
		xmlhttp.open("GET", "set_department.php?rec="+record_id+"&dep="+department_id, true);
		xmlhttp.send();
	}
</script>
</head>

<body>
	<div id="selector">
		<form>
			<input type="text" name="rec_id" placeholder="Record ID">
			<input type="submit" value="Fetch Record">
		</form>
	</div>
	<div id="activeArea">
		<p>Enter a Record ID to Begin.</p>
	</div>
</body>

</html>
