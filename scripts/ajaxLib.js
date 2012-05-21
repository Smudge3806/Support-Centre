function setupAjax()
{
	var xmlhttp;
	try
	{
		// Modern Browsers
		xmlhttp = new XMLHttpRequest();
	}
	catch(err1)
	{
		try
		{
			// Some versions of Internet Explorer
			xmlhttp = new ActiveXObject('Msxml2.XMLHTTP');
		}
		catch(err2)
		{
			// Some other versions of Internet Explorer
			try
			{
				xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			catch(err3)
			{
				alert("There is a connection problem: " + err3.message);
			}
		}
	}
}

var ajaxCont = setupAjax();
var action  = 'POST'; // Default Post - Alter as needs
var report = true; // Default true - produces a message box
var loading = "<img src='imgs/loading.gif' alt='Information Loading'>"; // default loading image
 
function callAjax(targetURL, values, replaceTarget)
{
	if(action == 'GET')
	{
		targetURL = targetURL+"?"+values;
	}
	else
	{
		ajaxCont.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	}
	ajaxCont.open(action, targetURL, true);
	
	if(action == "GET")
	{
		ajax.send();
	}
	else
	{
		ajax.send(values);
	}
	
	ajaxCont.onreadystatechange = getResponse(replaceTarget);
}

function getResponse(replaceTarget)
{
	if(replaceTarget != "")
	{
		if(ajaxCont.readyState == 4)
		{
			if(ajaxCont.status == 200)
			{
				try
				{
					document.getElementById(replaceTarget).innerHTML = ajaxCont.responseText;
				}
				catch(err1)
				{
					alert("Element Not Found");
				}
			}
			else
			{
				if(replaceTarget)
				{
					document.getElementById(replaceTarget).innerHTML = "There has been an error: "+ajaxCont.statusText;
				}
				else if(report)
				{
					alert("There has been an error: "+ajaxCont.statusText);
				}
			}
		}
		else if(ajaxCont.readyState == 3)
		{
			try
			{
				document.getElementById(replaceTarget).innerHTML = loading;
			}
			catch(err2)
			{
				alert("Element Not Found");
			}
		}
	}
	else if(report)
	{
		if(ajaxCont.readyState == 4)
		{
			if(ajaxCont.status == 200)
			{
				alert("Server Response: "+ajaxCont.responseText);
			}
			else
			{
				alert("Server Error: "+ajaxCont.statusText);
			}
		}
	}
	else if(!replaceTarget && !report)
	{
		alert("Error: No Return Method Specified");		
	}
}