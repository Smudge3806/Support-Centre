var target = 'http://www.barnsley-ltu.co.uk/controllers/event_search_user.php'; // default value for php target
var display = 'mydiv'; // default display target
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
		alert('Hello');
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			document.getElementById('mydiv').innerHTML = xmlhttp.responseText;
		}
	}
	var name = document.getElementById('name').value;
	xmlhttp.open('GET', target+'?name='+name, true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	if(xmlhttp.readyState == 3)
	{
		document.getElementById(display).innerhtml = "<img src='http://www.barnsley-ltu.co.uk/img/loading.gif' alt='loading' />";
	}
}
