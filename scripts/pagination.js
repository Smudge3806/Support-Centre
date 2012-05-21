<script type="text/javascript">
	var pageNum = 1;
	var numOfPages = 1; // Default number of pages - alter in function paginationSetup()
	var displayTarget = 'pageDisplay'; // default name of target tbody
	var displayIncrementName = 'page_'; // default prefix of each instance of the raw pagination i.e. page_1
	var report = true; // Report caught errors to the user
	
	// error log vars
	var errorLog;
	var errorNum = 1;
	
	function paginationSetup(pages)
	{
		numOfPages = pages;
	}
	
	function pagination(action)
	{
		switch(action)
		{
			case "next":
				if(pageNum <= numOfPages)
				{
					pageNum++;
				}
				break;
			case "prev":
				if(pageNum >= numOfPages)
				{
					pageNum--;
				}
				break;
			case "last":
				pageNum = numOfPages;
				break;
			case "first":
				pageNum = 1;
				break;
			case "all":
				// add all elements into target tbody
				break;
		}
		
		try
		{
			if(action != "all")
			{
				document.getElementById(displayTarget).innerHTML = document.getElementById(displayIncrementName+pageNum).innerHTML;
			}
			else
			{
				for(x = 1;x != numOfPages; x++)
				{
					output = output + document.getElementById(displayIncrementName+x).innerHTML;
				}
			}
		}
		catch(err1)
		{
			if(report)
			{
				alert("There is a problem: "+err1.message);
			}
			errorLog = errorLog + "error "+errorNum+": " + err1.message; 
			errorNum++;
		}
	}
</script>