<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Model_Proglang extends Eloquent
{
	protected $table = 'prog_lang';
	protected $primaryKey = 'language_ID';
	public $timestamps = [];
	protected $fillable = ['language_name']; 
}