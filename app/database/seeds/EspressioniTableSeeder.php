<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class EspressioniTableSeeder extends Seeder {

	public function run()
	{
		DB::table('espressioni')->truncate();

		// $faker = Faker::create();
		$espressioni = Config::get('espressioni');

		foreach($espressioni as $espressione)
		{
			Espressione::create($espressione);
		}
	}

}