<?php
	// models/user_link.php
	class User_Link
	{
		function __construct($user, $rel = "full")
		{
			global $output;
			session_start();
			switch($_SESSION['account'])
			{
				case "admin":
					$page = "admin";
					break;
				case "user":
					$page = "";
					break;
			}
			switch($rel)
			{
				case "full":
					$this->output = "<a href='https://www.barnsley-ltu.co.uk/users/".$user->id."/".$page."' title='Click here to see ".$user->username."'s profile'>".$user->username."</a>";
					break;
				case "url":
					$this->output = "users/".$user->id."/".$page;
					break;
			}
		}
	}
	
?>