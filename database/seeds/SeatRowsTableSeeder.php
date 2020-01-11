<?php

use Illuminate\Database\Seeder;
use LANMS\SeatRows;

class SeatRowsTableSeeder extends Seeder
{
    public function run()
    {
        SeatRows::create([
            'name' => 'A',
        ]);

        SeatRows::create([
            'name' => 'B',
        ]);
        
        SeatRows::create([
            'name' => 'C',
        ]);

        SeatRows::create([
            'name' => 'D',
        ]);

        SeatRows::create([
            'name' => 'E',
        ]);

        SeatRows::create([
            'name' => 'F',
        ]);

        SeatRows::create([
            'name' => 'G',
        ]);

        SeatRows::create([
            'name' => 'H',
        ]);

        SeatRows::create([
            'name' => 'I',
        ]);

        SeatRows::create([
            'name' => 'J',
        ]);

        SeatRows::create([
            'name' => 'TF',
            'sort_order' => 98,
        ]);

        SeatRows::create([
            'name' => 'LS',
            'sort_order' => 99,
        ]);

        SeatRows::create([
            'name' => 'L',
        ]);
    }
}
