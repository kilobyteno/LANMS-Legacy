<?php

use Illuminate\Database\Seeder;

class CompoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \LANMS\Compo::create([
            'name' => 'CS:GO '.(\Carbon\Carbon::now()->year + 1),
            'slug' => str_slug('CS:GO '.(\Carbon\Carbon::now()->year + 1), '-'),
            'description' => 'This is a test compo.',
            'page_id' => 1,
            'year' => \Carbon\Carbon::now()->year + 1,
            'author_id' => 1,
            'editor_id' => 1,
            'start_at' => \Carbon\Carbon::now()->addDays(-1),
            'last_sign_up_at' => \Carbon\Carbon::now()->addDays(-1)->addHours(-1),
            'end_at' => \Carbon\Carbon::now()->addDays(3),
            'type' => 1,
            'signup_type' => 1,
            'signup_size' => 5,
        ]);
        \LANMS\Compo::create([
            'name' => 'Minecraft: Creative '.(\Carbon\Carbon::now()->year + 1),
            'slug' => str_slug('Minecraft: Creative '.(\Carbon\Carbon::now()->year + 1), '-'),
            'description' => 'Here you would describe some general info about the compo.',
            'page_id' => 1,
            'year' => \Carbon\Carbon::now()->year + 1,
            'author_id' => 1,
            'editor_id' => 1,
            'start_at' => \Carbon\Carbon::now(),
            'last_sign_up_at' => \Carbon\Carbon::now()->addDays(1),
            'end_at' => \Carbon\Carbon::now()->addDays(3),
            'type' => 2,
            'signup_type' => 2,
            'signup_size' => 1,
        ]);
        \LANMS\Compo::create([
            'name' => 'Rocket League ' .(\Carbon\Carbon::now()->year + 1),
            'slug' => str_slug('Rocket League '.(\Carbon\Carbon::now()->year + 1), '-'),
            'description' => 'This is a test compo.',
            'page_id' => 1,
            'year' => \Carbon\Carbon::now()->year + 1,
            'author_id' => 1,
            'editor_id' => 1,
            'start_at' => \Carbon\Carbon::now()->addDays(2),
            'last_sign_up_at' => \Carbon\Carbon::now()->addDays(1),
            'end_at' => \Carbon\Carbon::now()->addDays(3),
            'type' => 1,
            'signup_type' => 1,
            'signup_size' => 3,
        ]);
        $team = \LANMS\CompoTeam::create([
            'name' => 'A Cool Team',
            'user_id' => 1,
        ]);
        $team->players()->attach([2,3]);
        $team = \LANMS\CompoTeam::create([
            'name' => 'Another Cool Team',
            'user_id' => 2,
        ]);
        $team->players()->attach([2,3,4,5]);
    }
}
