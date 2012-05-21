<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Test::AJAX PHP</title>
<script type="text/javascript">
	function loadText()
	{
		var xmlhttp;
		if(window.XMLHttpRequest)
		{
			// Modern Browser
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById('mydiv').innerHTML = xmlhttp.responseText;
			}
		}
		var name = document.getElementById('name').value;
		xmlhttp.open('GET', '../controllers/test_parsename.php?name='+name, true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send();
		if(xmlhttp.readyState == 3)
		{
			document.getElementById('mydiv').innerhtml = "<img src='../img/loading.gif' alt='loading' />";
		}
	}
		
</script>
</head>

<body>

		<input type="search" id="name" placeholder="Begin typing a name"  onkeyup="loadText()" autocomplete="off">
	
	<div id="mydiv">
	</div>
	
</body>

</html>
