<?php

use Illuminate\Database\Seeder;
use LANMS\Seats;

class SeatStatusesTableSeeder extends Seeder  {

	public function run() {

		SeatStatus::create([
			'name' 		=> 'Open',
			'slug' 		=> 'open',
		]);

		SeatStatus::create([
			'name' 		=> 'Reserved',
			'slug' 		=> 'reserved',
		]);

		SeatStatus::create([
			'name' 		=> 'Temporary Reserved',
			'slug' 		=> 'temporary_reserved',
		]);
	}
}