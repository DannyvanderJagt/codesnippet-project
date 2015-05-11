<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Prog_lang extends Eloquent
{
	protected $table = 'vote_comment';
	protected $primaryKey = 'Vote_ID';
	public $timestamps = [];
	protected $fillable = ['User_ID', 'Vote_user_ID', 'Comment_ID', 'Vote_type']; 
}