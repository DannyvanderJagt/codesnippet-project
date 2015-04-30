<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class User extends Eloquent
{
	protected $table = 'user';
	public $timestamps = [];
	protected $primaryKey = "ID";

	protected $guarded = ['ID', 'Password'];
	protected $fillable = [
	'Register_date',
	'Last_online', 
	'First_name', 
	'Last_name', 
	'Username', 
	'Email', 
	'Birthday', 
	'Profession', 
	'Profile_picture', 
	'Votes', 
	'Session_key'];
}