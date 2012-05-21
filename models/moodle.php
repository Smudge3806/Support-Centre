<?php
	class MoodleCourse
	{
		function __construct($prov_id, $get_department = false, $get_enrolments = false)
		{
			global $id;
			global $moodle_title;
			global $course_code;
			global $course_title;
			global $url;
			global $created_on;
			global $department;
			global $enrolments;
			include('dbconnection.php');
			$result = $mysqli->query('SELECT * FROM moodle_pages WHERE page_id = '.$prov_id);
			if($result->num_rows != 0)
			{
				$this->id = $prov_id;
			}
			else
			{
				header('location: ../errors/moodle.php?e=No Record of Moodle Page');
			}
			
				$raw = $result->fetch_object();
				$this->moodle_title = $raw->moodle_title;
				$this->course_code = $raw->course_code;
				$this->course_title = $raw->course_title;
				$this->created_on - $raw->created_on;
				$this->department = $raw->department_id;
				$this->url = $raw->url;
				if($get_department)
				{
					require_once('department.php');
					$this->department = new Department($this->department, true);
				}
				
				
				$result = $mysqli->query('SELECT * FROM moodle_assignments WHERE page_id = '.$this->id);
				if($result->num_rows == 0)
				{
					$this->enrolments = "There are no enrolments for this course.";
				}
				else
				{
					$this->enrolments = array();
					if($get_department)
					{
						$user = $this->department->support_officer;
					}
					else
					{
						require_once('department.php');
						$temp = new Department($this->department);
						$user = $temp->support_officer;
						unset($temp);
					}
						
					if($get_enrolments)
					{
						$enrolment = array('user' => $user, 'role' => "Support Officer");
						$this->enrolments[] = $enrolment;
						while($raw = $result->fetch_object())
						{
							require_once('user.php');
							$enrolment = array('user' => $user = new User($raw->user_id), 'role' => $raw->role);
							$this->enrolments[] = $enrolment;
						}
					}
					else
					{
						$enrolment = array('user' => $user->id, 'role' => "Support Officer");
						$this->enrolments[] = $enrolment;
						while($raw = $result->fetch_object())
						{
							$enrolment = array('user' => $raw->user_id, 'role' => $raw->role);
							$this->enrolments[] = $enrolment;
						}
					}
				}
				
				$mysqli->kill;
				unset($mysqli);
		}
	}
?>