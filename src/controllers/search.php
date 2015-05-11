<?php

class Search extends Controller
{
	private $templates = PAGES['search']['templates'];

	public function load($params = []){
		if(isset($_GET['q']) && isset($_GET['l'])){
			$this->searchNormal($_GET['q'], $_GET['l']);
		}else if(isset($_GET['q'])){
			$this->searchByQuery($_GET['q']);
		}else if(isset($_GET['l'])){
			$this->searchByLanguage($_GET['l']);
		}else{
			// No search query.
			echo 'no search query!';
		}

		$this->display($this->templates['default'], $this->data);
	}

	private function searchByQuery($query){
		$this->snippet = $this->model('snippet');

		$results = $this->snippet
			->where('title', 'LIKE', '%'.$query.'%')
			->orWhere('description', 'LIKE', '%'.$query.'%')
			->get();

		$this->data['results'] = $results;
	}

	private function searchByLanguage($lang){
		$this->snippet = $this->model('snippet');

		$count = $this->snippet->where('Lang','=', $lang)
		->get();

		$this->data['results'] = $results;
	}

	public function searchNormal($search, $lang){
		$this->snippet = $this->model('snippet');

		$results = $this->snippet
			->where('Lang', 'LIKE', 2)
			->where(function($query) use ($search){
				$query
					->where('title', 'LIKE', '%'.$search.'%')
					->orWhere('description', 'LIKE', '%'.$search.'%');
			})
			->get();

		$this->data['results'] = $results;
	}
}
