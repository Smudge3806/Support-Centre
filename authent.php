<?php
	include('controllers/dbconnection.php');
	if($_GET['perm'] == "auto")
	{
		// Session
		session_start();
		$_SESSION['uid'] = $_GET['uid'];
		$uid = $_GET['uid'];
		//$users = $mysqli->query('SELECT * FROM users WHERE uid ='.$uid);
	//	$user = $users->fetch_object();
		//$_SESSION['username'] = $user->first_name.' '.$user->last_name;
		$_SESSION['account'] = "user";
		// Access
		header('location: http://www.barnsley-ltu.co.uk/user');
	}
	elseif($_GET['perm'] == "cookie")
	{
		$code = $_COOKIE['barns_code'];
		$result = $mysqli->query('SELECT * FROM cookie_codes WHERE raw_code = '.$code);
		if($result->num_rows == 1)
		{
			session_start();
			$row = $result->fetch_object();
			$_SESSION['uid'] = $row->user_id;
			require_once('models/user.php');
			$user = new User($row->user_id);
			$_SESSION['account'] = $user->account_type;
			$_SESSION['username'] = $user->username;
			unset($user);
			if(strtolower($_SESSION['account']) == "user")
			{
				header('location: http://www.barnsley-ltu.co.uk/user');
			}
			else
			{
				header('location: http://www.barnsley-ltu.co.uk/index.php');
			}
		}
		else
		{
			setcookie('barns_code', "", time()-3600);
			header('location: http://www.barnsley-ltu.co.uk/login/');
		}
	}
	else
	{
		// Existance
		$email = $_POST['email'];
		$result = $mysqli->query("SELECT * FROM users WHERE email = '{$email}'");
		if($result->num_rows != 0)
		{
			// Authenticate
			if(isset($_POST['password'])||isset($_POST['date']))
			{
				if(isset($_POST['perm']) && $_POST['perm'] == "us-login")
				{
					$date = $_POST['date'];
					$date = $date['day']."/".$date['month']."/".$date['year'];
					$password = MD5(MD5($date));
					unset($date);
				}
				else
				{
					$password = strtolower(MD5(MD5($_POST['password'])));
				}
				$row = $result->fetch_object();
				if(strtolower($row->password) == $password)
				{
					// Access
					session_start();
					$_SESSION['uid'] = $row->uid;
					$_SESSION['account'] = strtolower($row->type);
					$_SESSION['username'] = $row->first_name.' '.$row->last_name;
					$code = md5(md5($_SESSION['username'].time().$_SESSION['uid']));
					$expire = time()+60*60*24*14;
					$mysqli->query('INSERT INTO cookie_codes (raw_code, user_id) VALUES ("'.$code.'", '.$_SESSION['uid'].')');
					setcookie('barns_code', $code, $expire);
					if(strtolower($row->type) == "user")
					{
						include('controllers/ip_add.php');
						header('location: http://www.barnsley-ltu.co.uk/user');
					}
					else
					{
						header('location: http://www.barnsley-ltu.co.uk/index.php');
						//header('location: wall.php');
					}
				}
				else
				{
					// Incorrect Password
					header('location: login.php?e=3');
					//var_dump($_POST,$password, $row->password);
				}
				
			}
			else
			{
				// Missing Password
				header('location: http://www.barnsley-ltu.co.uk/login/e/2');				
			}	
		}
		else
		{
			// No Such User
			header('location: http://www.barnsley-ltu.co.uk/login/e/1');
		}
				
					
	}
?>