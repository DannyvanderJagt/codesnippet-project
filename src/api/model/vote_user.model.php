<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Model_Vote_User extends Eloquent
{
	protected $table = 'vote_user';
	protected $primaryKey = 'Vote_ID';
	public $timestamps = [];
	protected $fillable = ['User_ID', 'Vote_user_ID', 'Vote_type']; 
}