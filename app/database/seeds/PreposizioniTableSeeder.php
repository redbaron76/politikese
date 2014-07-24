<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class PreposizioniTableSeeder extends Seeder {

	public function run()
	{
		DB::table('preposizioni')->truncate();

		// $faker = Faker::create();
		$preposizioni = Config::get('preposizioni');

		foreach($preposizioni as $preposizione)
		{
			Preposizione::create($preposizione);
		}
	}

}