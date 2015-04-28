<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class User extends Eloquent
{
	protected $table = 'user';
	public $timestamps = [];
	protected $fillable = ['ID', 
	'Register_date',
	'Last_online', 
	'First_name', 
	'Last_name', 
	'Username', 
	'Password', 
	'Email', 
	'Birthday', 
	'Profession', 
	'Profile_picture', 
	'Votes', 
	'Session_key'];
}