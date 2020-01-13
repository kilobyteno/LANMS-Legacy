<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use LANMS\TicketType;

class TicketTypeTableSeeder extends Seeder
{
    public function run()
    {
        TicketType::create([
            'name' => 'Besøk',
            'slug' => Str::slug('Besøk'),
            'description' => '<ul><li>Kun mellom 07 og 23</li><li>Besøk utenfor dette tidsrommet koster 50kr</li></ul>',
            'price' => 0,
            'color' => '535c68',
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'name' => 'Dagsbillett',
            'slug' => Str::slug('Dagsbillett'),
            'description' => '<ul><li>10-22 (12 timer)</li><li>Tilfeldig ledig plass</li><li>Veldig begrenset</li><li>Gjelder kun fredag og lørdag</li></ul>',
            'price' => 100,
            'color' => 'badc58',
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'name' => '2-dagers (tors-fre)',
            'slug' => Str::slug('2-dagers'),
            'description' => '<ul><li>Torsdag kl.17 til Fredag kl.21</li><li>Egen plass</li><li>Kun 8 plasser</li></ul>',
            'price' => 200,
            'color' => '0abde3',
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'name' => '2-dagers (lør-søn)',
            'slug' => Str::slug('2-dagers (lør-søn)'),
            'description' => '<ul><li>Lørdag kl.08 til Søndag kl.12</li><li>Egen plass</li><li>Kun 8 plasser</li></ul>',
            'price' => 200,
            'color' => '0abde3',
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'name' => 'Deltaker',
            'slug' => Str::slug('Deltaker'),
            'description' => '<ul><li>Torsdag kl.16 til Søndag kl.12</li><li>Egen plass</li><li>56 plasser</li></ul>',
            'price' => 300,
            'color' => '10ac84',
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'name' => 'Premium',
            'slug' => Str::slug('Premium'),
            'description' => '<ul><li>Torsdag kl.12 til Søndag kl.12</li><li>Egen plass</li><li>Kun 10 plasser</li><li>Premium goder:</li><ul><li>Tidligere innslipp (4 timer)</li><li>Større plass (ca 120cm bredde)</li><li>1stk Baguett</li><li>1stk Brus</li><li>1stk Pizza</li><li>Medlemskap i Downlink DG som gir deg bladt annet rabatt på t-skjorte og hettegenser (kun 1stk av hver under arrangementet)</li><li>1stk super myk Downlink t-skjorte</li></ul></li></ul>.',
            'price' => 500,
            'color' => '341f97',
            'editor_id' => 1,
            'author_id' => 1,
        ]);

        TicketType::create([
            'name' => 'Crew',
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
