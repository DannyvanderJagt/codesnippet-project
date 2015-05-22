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
			
			$file = NULL;
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
			
			if(isset($_FILE['profile_picture']))
				{
				$file = $this->uploadFile($_FILES['profile_picture']);
				}
			$date = $_POST['birthyear'] . "-" . $_POST['birthmonth']. "-" . $_POST['birthday'];
			$password = Auth::encrypt($_POST['password']);
			
			$upload_dir = "uploads/";
			print_r($file);
			Api::$User->create($_POST['username'], $password,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $date, $_POST['profession'], $upload_dir . $file[0] . '_large' . $file[1], $upload_dir . $file[0] . '_thumb' . $file[1]);
		
		}


	}


			$this->renderView();
		
	// **************************************** //

}

public function uploadFile($file)
		{
			$target_dir = "uploads/";
			$file_name = $file['profile_picture'];
			$file_tmp = $file['tmp_name'];
			$file_size = $file['size'];
			$file_error = $file['error'];

			$file_ext = explode('.', $file_name);
			$image_name = $file_ext[0];
			$file_ext = strtolower(end($file_ext));

			$allowed = array('jpg', 'png');

			if(in_array($file_ext, $allowed))
			{
				if ($file_error === 0) 
				{
					$file_name_new = uniqid('', true) . '.' . $file_ext;
					$file_dest = $target_dir . $file_name_new;
					move_uploaded_file($file_tmp, $file_dest);
					$image = $file_dest;
					if($file_ext = 'jpg')
					{
					resizeJPG_thumb($image, $image_name);
					resizeJPG($image, $image_name);

					}
					elseif ($file_ext = 'png') {
						resizeJPNG_thumb($image, $image_name);
						resizeJPNG($image, $image_name);
					}
				}
			}
			return array($file_name_new, $file_ext);
		}

		private function resizeJPG_thumb($image, $image_name)
		{
			$image_size = getimagesize($image);
			$image_width = $image_size[0];
			$image_height = $image_size[1];

			$new_size = ($image_width + $image_height) / ($image_width*($image_height/45));
			$new_width = $image_width * $new_size;
			$new_height = $image_height * $new_size;

			$new_image = imagecreatetruecolor($new_width, $new_height);
			$old_image = imagecreatefromjpeg($image);

			imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
			imagejpeg($new_image, $image_name . '_thumb.jpg' );
		}

		private function resizePNG_thumb($image, $image_name)
		{
			$image_size = getimagesize($image);
			$image_width = $image_size[0];
			$image_height = $image_size[1];

			$new_size = ($image_width + $image_height) / ($image_width*($image_height/45));
			$new_width = $image_width * $new_size;
			$new_height = $image_height * $new_size;

			$new_image = imagecreatetruecolor($new_width, $new_height);
			$old_image = imagecreatefrompng($image);

			imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
			imagepng($new_image, $image_name . '_thumb.png' );
		}

		private function resizeJPG($image, $image_name)
		{
			$image_size = getimagesize($image);
			$image_width = $image_size[0];
			$image_height = $image_size[1];

			$new_size = ($image_width + $image_height) / ($image_width*($image_height/20));
			$new_width = $image_width * $new_size;
			$new_height = $image_height * $new_size;

			$new_image = imagecreatetruecolor($new_width, $new_height);
			$old_image = imagecreatefromjpeg($image);

			imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
			imagejpeg($new_image, $image_name . '_large.jpg' );
		}

		private function resizePNG($image, $image_name)
		{
			$image_size = getimagesize($image);
			$image_width = $image_size[0];
			$image_height = $image_size[1];

			$new_size = ($image_width + $image_height) / ($image_width*($image_height/20));
			$new_width = $image_width * $new_size;
			$new_height = $image_height * $new_size;

			$new_image = imagecreatetruecolor($new_width, $new_height);
			$old_image = imagecreatefrompng($image);

			imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
			imagepng($new_image, $image_name . '_large.png' );
		}
}