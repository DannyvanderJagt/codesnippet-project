<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Prog_lang extends Eloquent
{
	protected $table = 'framework';
	protected $primaryKey = 'Framework_ID';
	public $timestamps = [];
	protected $fillable = ['Lang_ID', 'Framework_name']; 
}