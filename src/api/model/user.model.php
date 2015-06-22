<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Model_User extends Eloquent
{
	protected $table = 'user';
	public $timestamps = [];
	protected $primaryKey = "ID";

	protected $hidden = array('Password', 'Session_key');
	protected $guarded = ['ID'];
	protected $fillable = [
	'Register_date',
	'Last_online', 
	'First_name', 
	'Last_name', 
	'Username', 
	'Email', 
	'Birthday', 
	'Profession', 
	'Profile_picture_large',
	'Profile_picture_thumb', 
	'Votes', 
	'Session_key',
	'Password'];
}