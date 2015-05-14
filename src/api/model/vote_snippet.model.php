<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Model_Vote_Snippet extends Eloquent
{
	protected $table = 'vote_snippet';
	protected $primaryKey = 'Vote_ID';
	public $timestamps = [];
	protected $fillable = ['Vote_user_ID', 'User_ID', 'Vote_type', 'Snippet_ID']; 
}