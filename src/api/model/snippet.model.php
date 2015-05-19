<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Model_Snippet extends Eloquent
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

	public function User(){
		return $this->belongsTo('Model_User', 'User_ID', 'ID');
	}


}