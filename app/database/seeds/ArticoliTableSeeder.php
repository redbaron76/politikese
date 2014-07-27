<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class ArticoliTableSeeder extends Seeder {

	public function run()
	{
		DB::table('articoli')->truncate();

		// $faker = Faker::create();
		$articoli = Config::get('articoli');

		foreach($articoli as $articolo)
		{
			Articolo::create($articolo);
		}
	}

}