<?php
	class TimeStamp
	{
		function __construct($raw)
		{
			global $short;
			global $str_short;
			global $year;
			global $month;
			global $day;
			global $original;
			global $str_datetime;
			global $str_date;	
			global $str_time;
			global $time;
			global $hour;
			global $minutes;
			global $timezone;
			global $str_yol;
			
			$this->original = $raw;
			
			// Short + Date Units + String Short
			
			$d = explode(" ", $raw); // Strip out the time
			$d = explode("-", $d[0]); // Separate each element
			$this->year = $d[0];
			$this->month = $d[1];
			$this->day = $d[2];
			
			$this->short = $this->day."/".$this->month."/".$this->year;
			
			$this->str_short = $this->day." ".date('M', strtotime($this->original))." ".$this->year;
			
			// String Date Time
			
			$this->str_datetime = date('l jS \of F Y h:i:s A', strtotime($this->original));
			
			// String Date
			
			$this->str_date = date('l jS \of F Y', strtotime($this->original));
			
			// String Hour
			
			$this->str_time = date('h:i:s A T', strtotime($this->original));
			
			// Time Units
			
			$t = explode(" ", $this->original);
			$t = explode(":", $t[1]);
			$this->hour = $t[0];
			$this->minutes = $t[1];
			
			// Time Zone
			$this->timezone = date('T', strtotime($this->original));
			
			// Year of our lord
			$yol = explode(" ", $this->str_date);
			$this->str_yol = $yol[0]; // Str_day
			$this->str_yol.= " the ";
			$this->str_yol.= $yol[1]." day of ";
			$this->str_yol.= $yol[3]." on the year of our lord ";
			$this->str_yol.= $yol[4];
		}
	}
?>