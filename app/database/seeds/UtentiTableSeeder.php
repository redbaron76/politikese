<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class UtentiTableSeeder extends Seeder {

	public function run()
	{
		DB::table('utenti')->truncate();

		// $faker = Faker::create();
		$admin = [
			'username' => 'admin',
			'email' => 'admin@admin',
			'password' => Hash::make('politikese'),
			'gender' => 'm'
		];
		
		Utente::create($admin);
	}

}