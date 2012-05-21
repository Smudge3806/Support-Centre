function getRequestObject()
{
	var req = false;
	if(window.XMLHttpRequest)
	{
		req = new XMLHttpRequest();
	}
	else
	{
		if(window.ActiveXObject)
		{
			try
			{
				req = new ActiveXObject('Msxml2.XMLHTTP');
			}
			catch(err1)
			{
			
				try
				{
					req = new ActiveXObject('Microsoft.XMLHTTP');
				}
				catch(err2)
				{
					req = false;
				}
			}
		}
	}
	return req;
}

var output_area = "default";

var request = getRequestObject();

var path_to_img = "img/";

function callAjax(values, target)
{	
	var url = target;
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	request.open("POST", url, true);
	
	request.onreadystatechange = responseAjax;
	
	request.send(values);

}

function setOutputArea(strDestination)
{
	output_area = strDestintion;
}

function setPathToImg(strPath)
{
	path_to_img = strPath;
]

function responseAjax()
{
	if(request.readyState == 4)
	{
		if(request.status == 200)
		{
			document.getElementById(output_area).innerHTML = request.reponseText;
		}
		else
		{
			alert("An Error has occurred: "+request.statusText);
		}
	}
	else
	{
		document.getElementById(output_area).innerHTML = '<img src="'+path_to_img+'loading.gif" alt="Processing Request">';
	}	
}