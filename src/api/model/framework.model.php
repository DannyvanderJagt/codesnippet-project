<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Model_Framework extends Eloquent
{
	protected $table = 'framework';
	protected $primaryKey = 'Framework_ID';
	public $timestamps = [];
	protected $fillable = ['Lang_ID', 'Framework_name']; 
}