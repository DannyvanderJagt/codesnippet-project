<?php

class Snippets extends Controller
{
	private $templates = PAGES['snippet']['templates'];

	public function load($params = []){
		$this->user = $this->model('snippet');
		$this->comment = $this->model('comment');
		$this->snippet = $this->model('snippet');

		if(isset($params[0])){
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
			$this->display($this->templates['default'], ['error'=>'This snippet doesn\'t exists!']);
		}
	}

	// Create.
	private function create(){
		$this->snippet = new $this->snippet();
		$this->snippet->create([
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

		$this->display($this->templates['create'], $this->data);
	}
	
	// Edit. (Check for owner)
	private function edit($id){
		$snippet = Snippet::find($id);

		if($snippet){
			$this->data['snippet'] = $snippet;

			// Get all the comments.
			$this->data['snippet']['comments'] = $this->comment->where('Snippet_ID','=', $id)->get();
		}else{
			$this->data['error'] = 'The snippet doesn\'t exists!';
		}
		$this->display($this->templates['default'], $this->data);
	}

	// Show.
	private function show($id){
		$snippet = Snippet::find($id);

		if($snippet){
			$this->data['snippet'] = $snippet;

			// Get all the comments.
			$this->data['snippet']['comments'] = $this->comment->where('Snippet_ID','=', $id)->get();
		}else{
			$this->data['error'] = 'The snippet doesn\'t exists!';
		}
		$this->display($this->templates['default'], $this->data);	
	}

	// Delete. (Check for owner)
	private function delete($id){
		$snippet = Snippet::find($id);
		if($snippet){
			echo 'delete'.$id;
			$snippet->delete();
			// Get all the comments.
			// $this->data['snippet']['comments'] = $this->comment->where('Snippet_ID','=', $id)->get();
		}
		$this->display($this->templates['delete'], $this->data);
	}
}