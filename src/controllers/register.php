<?php

class Register extends Controller
{
	private $templates = PAGES['register']['templates'];

	public function load($params = []){
		$this->display($this->templates['default']);
		
		if(isset($_POST['submit'])){
				if(isset($_POST['username'])){

				}
				else
				{
					$this->data['error.username'] = "Username not filled in.";
				}
					if(isset($_POST['password'])){
						$passwordMD5 = md5($_POST['password']);
				$passwordSHA1 = sha1($passwordMD5);
					}
					else
				{
					$this->data['error.password'] = "Password not filled in.";
				}
					if(isset($_POST['first_name'])){

					}
					else
				{
					$this->data['error.first_name'] = "First name not filled in.";
				}
					if(isset($_POST['last_name'])){

					}
					else
				{
					$this->data['error.last_name'] = "Last name not filled in.";
				}
					if(isset($_POST['email'])){

					}
					else
				{
					$this->data['error.email'] = "E-mail not filled in.";
				}
					if(isset($_POST['birthday']) && isset($_POST['birthmonth']) && isset($_POST['birthyear'])){
						$date = $_POST['birthyear'] . "-" . $_POST['birthmonth']. "-" . $_POST['birthday'];
					}
					else
				{
					$this->data['error.birthday'] = "Birthday not filled in.";
				}
					if(isset($_POST['profession'])){

					}
					else
				{
					$this->data['error.profession'] = "Profession not filled in.";
				}
			}
			
			if (count($data['error']) > 0)
			{
			$this->data['username'] = $_POST['username'];
			$this->data['password'] = $_POST['password'];
			$this->data['first_name'] = $_POST['first_name'];
			$this->data['last_name'] = $_POST['last_name'];
			$this->data['email'] = $_POST['email'];
			$this->data['birthday'] = $_POST['birthday'];
			$this->data['birthmonth'] = $_POST['birthmonth'];
			$this->data['birthyear'] = $_POST['birthyear'];
			$this->data['profession'] = $_POST['profession'];
			if(isset($_POST['profile_picture']))
			{
				$this->data['profile_picture'] = $_POST['profile_picture'];
			}
		}
		
		else
		{
			$picture = 'NULL';
			// if(isset($_POST['profile_picture']))
			// 	{
			// 	$picture =  $_POST['profile_picture'];
			// 	}
			$this->user = new $this->user();
			$this->user->create([
				'ID' => 'NULL',
				'Username' => $_POST['username'],
				'Password' => $passwordSHA1,
				'First_name' => $_POST['first_name'],
				'Last_name' => $_POST['last_name'],
				'Email' => $_POST['email'],
				'Birthday' => $date,
				'Profession' => $_POST['profession'],
				'Profile_picture' => $picture,
				'Votes' => 'NULL',
				'Session_key' => 'NULL',
				'Last_online' => 'NULL',
				'Register_date' => 'NULL',
			]);
		}
		}
	}

