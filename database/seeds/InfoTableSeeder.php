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
			'content'	=> '26. feb - 26. feb 2019',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'where',
			'content'	=> 'Gausdal Ungdomskole',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'where_url',
			'content'	=> '#',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'price',
			'content'	=> '250kr',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'price_alt',
			'content'	=> '300kr',
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

		Info::create([
			'name' 		=> 'social_facebook',
			'content'	=> '',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'social_twitter',
			'content'	=> '',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'social_instagram',
			'content'	=> '',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'social_youtube',
			'content'	=> '',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'social_snapchat',
			'content'	=> '',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

		Info::create([
			'name' 		=> 'social_twitch',
			'content'	=> '',
			'author_id'	=> 1,
			'editor_id'	=> 1,
		]);

    }
}
