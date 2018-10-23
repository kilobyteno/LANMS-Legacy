<?php

use Illuminate\Database\Seeder;
use LANMS\SeatRows;

class SeatRowsTableSeeder extends Seeder  {

	public function run() {

		SeatRows::create([
			'name' 		=> 'A',
			'slug' 		=> 'a',
		]);

		SeatRows::create([
			'name' 		=> 'B',
			'slug' 		=> 'b',
		]);

		SeatRows::create([
			'name' 		=> 'C',
			'slug' 		=> 'c',
		]);

		SeatRows::create([
			'name' 		=> 'D',
			'slug' 		=> 'd',
		]);

		SeatRows::create([
			'name' 		=> 'E',
			'slug' 		=> 'e',
		]);

		SeatRows::create([
			'name' 		=> 'F',
			'slug' 		=> 'f',
		]);

		SeatRows::create([
			'name' 		=> 'G',
			'slug' 		=> 'g',
		]);

		SeatRows::create([
			'name' 		=> 'H',
			'slug' 		=> 'h',
		]);

		SeatRows::create([
			'name' 		=> 'I',
			'slug' 		=> 'i',
		]);

		SeatRows::create([
			'name' 		=> 'J',
			'slug' 		=> 'j',
		]);

		SeatRows::create([
			'name' 		=> 'K',
			'slug' 		=> 'k',
		]);

		SeatRows::create([
			'name' 		=> 'L',
			'slug' 		=> 'l',
		]);

	}
}