<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use LANMS\TicketType;

class TicketTypeTableSeeder extends Seeder
{
    public function run()
    {
        TicketType::create([
            'title' => 'Deltaker',
            'slug' => Str::slug('Deltaker'),
            'description' => 'Torsdag kl16 til søndag kl12, Selvvalgt plass, 56stk plasser',
            'price' => 300,
            'color' => '10ac84',
            'default' => true,
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'title' => '2-dagers',
            'slug' => Str::slug('2-dagers'),
            'description' => 'Tors-fre (16-20) eller lør-søn (08-12), Egen plass på rad K, Kun 8stk',
            'price' => 200,
            'color' => '0abde3',
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'title' => 'Dagsbillett',
            'slug' => Str::slug('Dagsbillett'),
            'description' => '10-22 (12 timer), Tilfeldig ledig plass, Veldig begrenset',
            'price' => 100,
            'color' => '48dbfb',
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'title' => 'Premium',
            'slug' => Str::slug('Premium'),
            'description' => 'Torsdag kl.12 til søndag kl.12, Selvalgt plass på premium radene B og C, Kun 10stk, Premium goder: Tidligere innslipp (4 timer), større plasser (ca 120cm), 1stk frokost, 1stk Baguett, 1stk brus, 1stk pizza, medlemskap i Downlink DG som gir deg rabatt på t-skjorte og hettegenser*, og mulig flere goder.',
            'price' => 500,
            'color' => '341f97',
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'title' => 'Besøk',
            'slug' => Str::slug('Besøk'),
            'description' => 'Kun mellom 07 og 23, besøk utenfor dette tidsrommet koster 50kr',
            'price' => 0,
            'color' => '4bcffa',
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'title' => 'Crew',
            'slug' => Str::slug('Crew'),
            'description' => '',
            'price' => 0,
            'color' => '222f3e',
            'active' => false,
            'editor_id' => 1,
            'author_id' => 1,
        ]);
    }
}
