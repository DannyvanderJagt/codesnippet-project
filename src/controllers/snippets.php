<?php

class Snippets extends Controller
{
	private $templates = PAGES['snippet']['templates'];

	public function load($params = []){
		global $Session;
		$this->user = $this->model('user');
		$this->comment = $this->model('comment');
		$this->snippet = $this->model('snippet');

		if(isset($params[0])){
			if($Session->isLoggedin()){
				if($params[0] === 'create'){
					$this->create();
				}else if(isset($params[1]) && $params[1] === 'edit'){
					$this->edit($params[0]);
				}else if(isset($params[1]) && $params[1] === 'delete'){
					$this->delete($params[0]);
				}else{
					$this->show($params[0]);
				}
			}else{
				if(isset($params[1])){
					redirectToPage('signin');
				}else if(intval($params[0]) > 0){
					$this->show($params[0]);
				}else{
					redirectToPage('home');
				}
			}
		}else{
			$this->display($this->templates['default'], ['error'=>'This snippet doesn\'t exists!']);
		}
	}

	// Create.
	private function create(){

		if(isset($_POST['submit'])){
			$snippet = new $this->snippet();
			$snippet->create([
				'ID' => 'NULL',
				'Title' => 'Test',
				'Code' => 'testCode',
				'Description' => 'Description test',
				'Lang' => 2,
				'User_ID' => 2,
				'Framework' => 0,
				'Date' => date('Y-m-d'),
				'Views' => 0
			]);
		}

		$this->display($this->templates['create'], $this->data);
	}
	
	// Edit. (Check for owner)
	private function edit($id){
		global $Session;

		if(isset($_POST['submit'])){
			$snippet = Snippet::find($id);
			$snippet->update([
				'Title' => $_POST['title'],
				'Code' => $_POST['code'],
				'Description' => $_POST['description']
			]);
			$this->data['message'] = 'The snippet is updated!';
		}
		$snippet = Snippet::find($id);

		if($snippet->User_ID !== $Session->getUser()->ID){
			$this->data['error'] = 'You don\'t have the right permissions!';
		}else{	
			if($snippet){
				$this->data['snippet'] = $snippet;

				// Get all the comments.
				$this->data['snippet']['comments'] = $this->comment->where('Snippet_ID','=', $id)->get();
			}else{
				$this->data['error'] = 'The snippet doesn\'t exists!';
			}
		}

		$this->display($this->templates['edit'], $this->data);
	}

	// Show.
	private function show($id){
		$snippet = Snippet::find($id);

		if($snippet){
			$this->data['snippet'] = $snippet;
			// Get all the comments.
			$this->data['snippet']['comments'] = $this->comment->where('Snippet_ID','=', $id)->get();
			$this->data['snippet']['writer'] = $this->user->where('User_ID', '=', $snippet->User_ID);
			//print_r($this->data);
		}else{
			$this->data['error'] = 'The snippet doesn\'t exists!';
		}
		$this->display($this->templates['default'], $this->data);	
	}

	// Delete. (Check for owner)
	private function delete($id){
		global $Session;
		$snippet = Snippet::find($id);

		if($snippet){
			// Check for user permission.
			if($snippet->User_ID == $Session->getUser()->ID){
				// Not the owner.
				$snippet->delete();
				$this->data['deleted'] = true;
			}else{
				$this->data['error'] = 'Your are not the owner of this snippet!';
			}
		}else{
			$this->data['error'] = 'The snippet doesn\'t exists!';
		}

		$this->display($this->templates['delete'], $this->data);
	}
}