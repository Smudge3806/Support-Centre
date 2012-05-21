<?php
	/* Delete thread
	*  @params thread_id [int]
	*  @params page [varchar]
	*/
	
	if(isset($_GET['id']))
	{
		$thread = $_GET['id'];
		include('dbconnection.php');
		
		$mysqli->query('DELETE FROM messages WHERE thread_id = '.$thread);
		if($mysqli->affected_rows != 0)
		{
			$mysqli->query('DELETE FROM threads WHERE thread_id = '.$thread);
			if($mysqli->affected_rows != 0)
			{
				if(isset($_GET['page']))
				{
					$page = $_GET['page'];
					switch($page)
					{
						case "notifications":
							$page = "messages/";
							break;
						case "index":
							$page = "index.php";
							break;
					}
				}
				else
				{
					session_start();
					$page = 'messages/';
				}
				header('location: ../'.$page);
				
			}
			else
			{
				var_dump($mysqli);
			}
		}
		else
		{
			var_dump($mysqli);
		}	
		
		
	}
?>