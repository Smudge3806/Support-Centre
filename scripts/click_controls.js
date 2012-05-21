	function ClickClear(thisfield, string)
	{
		if(thisfield.value == string)
		{
			thisfield.value = "";
		}
	}
	
	function ClickReturn(thisfield, string)
	{
		if(thisfield.value == "")
		{
			thisfield.value = string;
		}
	}
		
	function unlock()
	{
		document.getElementById("submit").type = "Submit";
	}
