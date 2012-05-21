<?php
	switch($input)
	{
		case "test":
			$output = "templates/test.txt";
			break;
		case "register":
			$output = "templates/user_register_confirmation.txt";
			$parse = true;
			$keyword = "[[code]]";
			break;
		case "reset password":
			$output = "templates/user_reset_password";
			break;
		
		case "new support":
			$output = "templates/support_new.txt";
			$parse true;
			$keyword ="[[id]]";
			break;
		case "support logged":
			$output = "templates/support_logged.txt";
			break;
		case "support message":
			$output = "templates/support_message.txt";
			break;
		case "support closed":
			$output = "templates/support_closed.txt";
			break;
		case "support reopened":
			$output = "templates/support_reopened.txt";
			break;
		case "nudge":
			$output = "templates/support_nudge.txt";
			break;
		
		case "training new":
			$output = "templates/training_new.txt";
			break;
		case "training invite":
			$output = "templates/training_invite.txt";
			break;
		case "training message":
			$output = "templates/training_message.txt";
			break;
		case "training reminder":
			$ouput = "templates/training_reminder.txt";
			break;
			
		case "system update":
			$output = "templates/system_update.txt";
			break;
		case "system news":
			$output = "templates/system_news.txt";
			break;
		
	}
?>