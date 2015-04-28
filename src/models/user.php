<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class User extends Eloquent
{
	protected $table = 'user';
	public $timestamps = [];
	protected $fillable = ['Username', 'email', 'Session_key', 'Votes'];
}