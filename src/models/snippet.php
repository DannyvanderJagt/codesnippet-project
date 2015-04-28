<?php

use Illuminate\Database\Eloquent\Model as Eloquent; 

class Snippet extends Eloquent
{
	protected $table = 'snippet';
	public $timestamps = [];
	protected $fillable = ['Snippet_ID', 
	'Snippet_title', 
	'Snippet_code', 
	'Snippet_description',
	'Snippet_lang',
	'Snippet_framework',
	'User_ID',
	'Snippet_date',
	'Snippet_change_date',
	'Snippet_views'];
}