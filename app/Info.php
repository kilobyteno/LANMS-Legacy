<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    
	Info::create([
		'name' 		=> 'when',
		'content'	=> '27. feb - 1. mars',
		'author_id'	=> 1,
		'editor_id'	=> 1,
	]);

	Info::create([
		'name' 		=> 'where',
		'content'	=> '&Oslash;yerhallen',
		'author_id'	=> 1,
		'editor_id'	=> 1,
	]);

	Info::create([
		'name' 		=> 'where_url',
		'content'	=> 'https://goo.gl/maps/PvYyAKpxEyu',
		'author_id'	=> 1,
		'editor_id'	=> 1,
	]);

	Info::create([
		'name' 		=> 'price',
		'content'	=> '300kr',
		'author_id'	=> 1,
		'editor_id'	=> 1,
	]);

	Info::create([
		'name' 		=> 'price_alt',
		'content'	=> '350kr',
		'author_id'	=> 1,
		'editor_id'	=> 1,
	]);

}
