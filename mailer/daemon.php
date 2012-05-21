<?php
	class Daemon
	{
		function __construct($target, $message_type = NULL, $message_addon = NULL)
		{
			global $to;
			$this->to = $target;
			global $sent;
			$sent = false;
			global $message;
			global $headers;
			global $subject;
			global $addon;
			
			$this->subject = "A Message From Support Centre";
			$this->addHeaders("MIME-Version: 1.0" . "\r\n");
			$this->addHeaders("Content-type:text/html;charset=iso-8859-1" . "\r\n");
			$this->addHeaders('From: webmaster@barnsley-ltu.co.uk' . "\r\n" . 'Reply-To: no-reply@barnsley-ltu.co.uk' . "\r\n" . 'X-Mailer: PHP/' . phpversion());
			global $parse_required;
			$this->parse_required = array('required' => false, 'keyword' => NULL);
			
			if(isset($message_addon))
			{
				$this->addon = $message_addon;
			}
			
			if(isset($message_type))
			{
				$this->addTemplate($this->getFilename($message_type));
			}
			
		}
		
		function addHeaders($header)
		{
			$this->headers .= $header;
		}
		
		function addTemplate($filename)
		{
			$this->message = file_get_contents($filename, FILE_USE_INCLUDE_PATH);
			if($this->parse_required['required'])
			{
				$key = $this->parse_required['keyword'];
				$this->message = str_replace($key, $this->addon, $this->message);
			}
		}
		
		function getFilename($input)
		{
			include('list.php');
			if(isset($parse))
			{
				$this->parse_required['required'] = true;
				$this->parse_required['keyword'] = $keyword;
			}
			return $output;
		}
		
		function send()
		{
			$sent = mail($this->to, $this->subject, $this->message, $this->headers);
			
			return $sent;
		}
	}
?>