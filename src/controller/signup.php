<?php

class Controller_Signup extends Controller
{
	
	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'signup.view.html'
		];
		
		public function onAuth($params = []){
			// This is only avialable when some one is not signed in!
			// Otherwise when an user is signed in send them to the home page.
			return ['home', !System::$Auth->required()];
		}

		public function onPost($params = [], $data = []){
			if(empty($data['username'])){
				$this->data['error']['usernameError'] = 'Please enter a username!';
			}
			if(empty($data['password'])){
				$this->data['error']['passwordError'] = 'Please enter a password!';
			}
			if(empty($data['email'])){
				$this->data['error']['emailError'] = 'Please enter a email!';
			}
			if(!empty($data['email'])){
				$at = strpos($data['email'], '@');
				if($at)
				{
					$eDomain = explode('@', $data['email']);
					$dot = strpos($eDomain, '.');
					if(!$dot){
						$this->data['error']['emailError'] = 'Please enter a valid email!';
					}
				}
				else
				{
					$this->data['error']['emailError'] = 'Please enter a valid email!';
				}
			}
			elseif(count($this->data['error']) === 0){
				echo count($this->data['error']);
			$file = NULL;
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
		
		


			//echo "Before check";
			
			if(isset($_FILES['profile_picture']))
				{
					//echo "Starting Upload";
				$file = $this->uploadFile();
				}
			$date = $_POST['birthyear'] . "-" . $_POST['birthmonth']. "-" . $_POST['birthday'];
			$password = Auth::encrypt($_POST['password']);
			
			$upload_dir = "uploads/";
			Api::$User->create($_POST['username'], $password,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $date, $_POST['profession'], $file, $file);
		
		}
		$this->data['data'] = $data;
		}		

		public function onRequest($params = []){

$this->renderView();

	}


			
		
	// **************************************** //



		public function uploadFile()
		{
			$target_dir = "uploads";

			$file_name = $target_dir . basename ($_FILES['profile_picture']['name']);
			$file_tmp = $_FILES['profile_picture']['tmp_name'];
			$file_size = $_FILES['profile_picture']['size'];
			$file_error = $_FILES['profile_picture']['error'];

			$file_ext = explode('.', $file_name);
			$image_name = $file_ext[0];
			$file_ext = strtolower(end($file_ext));
			$allowed = array('jpg', 'png');
			$base = NULL;
			if(in_array($file_ext, $allowed))
			{
				if ($file_error === 0) 
				{

					$imgbinary = fread(fopen($file_tmp, "r"), filesize($file_tmp));
		             $base = 'data:image/' . $file_ext . ';base64,' . base64_encode($imgbinary);
					
				}
			}
			return $base;
		}



		}
