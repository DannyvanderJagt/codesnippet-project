<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Model_Comment extends Eloquent
{
	protected $primaryKey = 'Comment_ID';
	protected $table = 'comment';
	public $timestamps = [];
	protected $fillable = ['Comment_ID', 
	'Snippet_ID',
	'Comment_top_ID',
	'User_ID',
	'Comment_text',
	'Comment_date']; 

	public function User(){
		return $this->belongsTo('Model_User', 'User_ID', 'ID');
	}
}