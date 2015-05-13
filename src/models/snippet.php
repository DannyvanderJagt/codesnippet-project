<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Snippet extends Eloquent
{
	protected $primaryKey = "ID";
	protected $table = 'snippet';
	public $timestamps = [];
	protected $fillable = ['ID', 
	'Title', 
	'Code', 
	'Description',
	'Lang',
	'Framework',
	'User_ID',
	'Date',
	'Change_date',
	'Views'];

	/* Api:
	getById($id)
		- snippet
		- user
		- comments
		- votes
	*/

	public function getSnippet($id){
		require_once '../' . PATHS['models'] . '/' . 'comment' . '.php';
		$this->comment = new Comment();
		return "snippet ".$id . $this->comment->getBySnippet(3);
	}



}