<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Comment extends Eloquent
{
	protected $table = 'comment';
	public $timestamps = [];
	protected $fillable = ['Comment_ID', 
	'Snippet_ID',
	'Comment_top_ID',
	'User_ID',
	'Comment_text',
	'Comment_date']; 



	public function getBySnippet($id){
		return 'getBySnippet' . $id;
	}
}