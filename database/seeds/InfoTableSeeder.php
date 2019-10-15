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
            'name'      => 'when',
            'content'   => '01. jan - 02. jan 1970',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'where',
            'content'   => 'Infihex Arena',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'where_url',
            'content'   => '#',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'price',
            'content'   => '250kr',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'price_alt',
            'content'   => '300kr',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'address_street',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'address_postal_code',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);
        
        Info::create([
            'name'      => 'address_city',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'address_county',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'address_country',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'social_facebook',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'social_twitter',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'social_instagram',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'social_youtube',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'social_snapchat',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'social_twitch',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'social_discord',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Info::create([
            'name'      => 'social_discord_server_id',
            'content'   => '',
            'author_id' => 1,
            'editor_id' => 1,
        ]);
    }
}
