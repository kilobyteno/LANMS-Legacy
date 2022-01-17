<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([
            UserTableSeeder::class,
            NewsTableSeeder::class,
            SettingsTableSeeder::class,
            SeatsTableSeeder::class,
            SeatRowsTableSeeder::class,
            SeatReservationStatusesTableSeeder::class,
            PagesTableSeeder::class,
            CrewTableSeeder::class,
            InfoTableSeeder::class,
            CompoTableSeeder::class,
            EmailTableSeeder::class,
            TicketTypeTableSeeder::class,
        ]);
    }
}
