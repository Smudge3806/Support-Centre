<?php
	class Daemon
	{
		function __construct($sender_username, $recipient_email, $in_message, $send_mail = false, $extras = false)
		{
			$headers = 'From: webmaster@barnsley-ltu.co.uk' . "\r\n" . 'Reply-To: no-reply@barnsley-ltu.co.uk' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			global $message;
			// Define Default Messages
			
			switch($in_message)
			{
				case "new message":
					$this->message = "You Have a New Message on Support Centre";
					break;
				case "new support":
					$this->message = "There is a new support request on Support Centre";
					break;
				case "reopened support":
					$this->message = "A Support Request has been re-opened on Support Centre";
					break;
				case "request closed":
					$this->message = "One of your support requests has been closed";
					break;
				case "nudge":
					$this->message = "You have been Nudged in reference to: ";
					break;
				case "5012":
					$this->message = "There has been a unauthorised access event:\n\r";
					break;
				case "registered":
					$this->message = "";
					break;
				case "logged":
					$this->message = "Your support request has been logged. Report ID: ";
			}
			if(isset($extras))
			{
				$this->message.=$extras;
			}
			if($send_mail)
			{
				$sent = mail($recipient_email, "Barnsley College LTU Support Centre", $this->message, $headers);
			}
		}
	}
?>