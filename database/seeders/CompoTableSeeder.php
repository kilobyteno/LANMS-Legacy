<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use LANMS\Compo;
use LANMS\CompoTeam;

class CompoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Compo::create([
            'name' => 'CS:GO '.(Carbon::now()->year),
            'slug' => str_slug('CS:GO '.(Carbon::now()->year), '-'),
            'description' => 'This is a test compo.',
            'page_id' => 1,
            'year' => Carbon::now()->year,
            'author_id' => 1,
            'editor_id' => 1,
            'start_at' => Carbon::now()->addDays(-1),
            'last_sign_up_at' => Carbon::now()->addDays(-1)->addHours(-1),
            'end_at' => Carbon::now()->addDays(3),
            'type' => 1,
            'signup_type' => 1,
            'signup_size' => 5,
        ]);
        Compo::create([
            'name' => 'Minecraft: Creative '.(Carbon::now()->year),
            'slug' => str_slug('Minecraft: Creative '.(Carbon::now()->year), '-'),
            'description' => 'Here you would describe some general info about the compo.',
            'page_id' => 1,
            'year' => Carbon::now()->year,
            'author_id' => 1,
            'editor_id' => 1,
            'start_at' => Carbon::now(),
            'last_sign_up_at' => Carbon::now()->addDays(1),
            'end_at' => Carbon::now()->addDays(3),
            'type' => 2,
            'signup_type' => 2,
            'signup_size' => 1,
        ]);
        Compo::create([
            'name' => 'Rocket League ' .(Carbon::now()->year),
            'slug' => str_slug('Rocket League '.(Carbon::now()->year), '-'),
            'description' => 'This is a test compo.',
            'page_id' => 1,
            'year' => Carbon::now()->year,
            'author_id' => 1,
            'editor_id' => 1,
            'start_at' => Carbon::now()->addDays(2),
            'last_sign_up_at' => Carbon::now()->addDays(1),
            'end_at' => Carbon::now()->addDays(3),
            'type' => 1,
            'signup_type' => 1,
            'signup_size' => 3,
        ]);
        $team = CompoTeam::create([
            'name' => 'A Cool Team',
            'user_id' => 1,
        ]);
        $team->players()->attach([2,3]);
        $team = CompoTeam::create([
            'name' => 'Another Cool Team',
            'user_id' => 2,
        ]);
        $team->players()->attach([2,3,4,5]);
    }
}
