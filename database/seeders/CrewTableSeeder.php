<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LANMS\Crew;
use LANMS\CrewCategory;
use LANMS\CrewSkill;

class CrewTableSeeder extends Seeder  {

    public function run()
    {

        CrewCategory::create([
            'title'     => 'Core',
            'slug'      => 'core',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        CrewCategory::create([
            'title'     => 'Crew',
            'slug'      => 'crew',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        CrewSkill::create([
            'title'     => 'Admin',
            'slug'      => 'admin',
            'icon'      => 'fa fa-user-secret',
            'class'     => 'badge badge-primary',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        CrewSkill::create([
            'title'     => 'Network',
            'slug'      => 'network',
            'icon'      => 'fa fa-wifi',
            'class'     => 'badge badge-success',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        CrewSkill::create([
            'title'     => 'Security',
            'slug'      => 'security',
            'icon'      => 'fa fa-lock',
            'class'     => 'badge badge-warning',
            'author_id' => 1,
            'editor_id' => 1,
        ]);

        Crew::create([
            'user_id'       => 1,
            'category_id'   => 1,
            'author_id'     => 1,
            'editor_id'     => 1,
            'year'          => date('Y'),
        ]);

        Crew::create([
            'user_id'       => 2,
            'category_id'   => 2,
            'author_id'     => 1,
            'editor_id'     => 1,
            'year'          => date('Y'),
        ]);

        Crew::create([
            'user_id'       => 3,
            'category_id'   => 2,
            'author_id'     => 1,
            'editor_id'     => 1,
            'year'          => date('Y'),
        ]);

    }
    
}