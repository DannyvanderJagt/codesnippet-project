<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class User extends Eloquent
{
	public $name;

	protected $table = 'user';

	public $timestamps = [];

	protected $fillable = ['Username', 'email'];
}