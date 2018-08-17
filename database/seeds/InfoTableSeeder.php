<?php

use Illuminate\Database\Seeder;

use LANMS\Info;

class InfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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

		Info::create([
			'name' 		=> 'address_street',
			'content'	=> 'Jernbanegata 1',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'address_postal_code',
			'content'	=> '2609',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);
		
		Info::create([
			'name' 		=> 'address_city',
			'content'	=> 'Lillehammer',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'address_county',
			'content'	=> 'Oppland',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'address_country',
			'content'	=> 'Norge',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);
    }
}
