function switchTab(link)
	{
		var par = link.parentNode;
		try
		{	
			// Check for a last active link and remove the active id
			try
			{
				var last = document.getElementById('active');
				try
				{	
					var target = last.firstChild.rel;
					var elm = document.getElementById(target);
					elm.style.display = 'none';
				}
				catch(err2)
				{
					// do nothing
				}
				last.removeAttribute('id');
			}
			catch(err4)
			{
				// There mustn't not be a last active
			}
			
			par.setAttribute('id', 'active');
			try
			{
				var target = link.rel;
				target = document.getElementById(target);
				target.style.display = 'block';
			}
			catch(err3)
			{
				// do nothing
				alert("Setting Error: " + err3.message);
			}
			
		}
		catch(err1)
		{
			// do nothing
			alert("Parent Error: " + err1.message);
		}
		
	}