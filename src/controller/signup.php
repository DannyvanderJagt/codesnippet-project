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

		private function uploadFile($file)
		{
			$target_dir = "uploads/";
			$file_name = $file['profile_picture'];
			$file_tmp = $file['tmp_name'];
			$file_size = $file['size'];
			$file_error = $file['error'];

			$file_ext = explode('.', $file_name);
			$file_ext = strtolower(end($file_ext));

			$allowed = array('jpg', 'png', 'bmp');

			if(in_array($file_ext, $allowed))
			{
				if ($file_error === 0) {
					$file_name_new = uniqid('', true) . '.' . $file_ext;
					$file_dest = $target_dir . $file_name_new;
					move_uploaded_file($file_tmp, $file_dest);
				}
			}

		}

		public function onRequest($params = []){
			if(isset($_POST['submit'])){
			$this->data['error'] = [];
				if(isset($_POST['username'])){

				}
				else
				{
					$this->data['error']['username'] = "Username not filled in.";
				}
					if(isset($_POST['password'])){
						
					}
					else
				{
					$this->data['error']['password'] = "Password not filled in.";
				}
					if(isset($_POST['first_name'])){

					}
					else
				{
					$this->data['error']['first_name'] = "First name not filled in.";
				}
					if(isset($_POST['last_name'])){

					}
					else
				{
					$this->data['error']['last_name'] = "Last name not filled in.";
				}
					if(isset($_POST['email'])){

					}
					else
				{
					$this->data['error']['email'] = "E-mail not filled in.";
				}
					if(isset($_POST['birthday']) && isset($_POST['birthmonth']) && isset($_POST['birthyear'])){
						
					}
					else
				{
					$this->data['error']['birthday'] = "Birthday not filled in.";
				}
					if(isset($_POST['profession'])){

					}
					else
				{
					$this->data['error']['profession'] = "Profession not filled in.";
				}
			
			
			if (count($this->data['error']) > 0)
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
			if(isset($_FILE['profile_picture']))
				{
				$picture =  $_FILE['profile_picture'];
				}
			$date = $_POST['birthyear'] . "-" . $_POST['birthmonth']. "-" . $_POST['birthday'];
			$password = Auth::encrypt($_POST['password']);
			uploadFile($picture);
			Api::$User->create($_POST['username'], $password,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $date, $_POST['profession'], $picture);
		
		}
	}
			$this->renderView();
		
	// **************************************** //

}

}