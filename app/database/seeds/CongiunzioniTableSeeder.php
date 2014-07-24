<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class CongiunzioniTableSeeder extends Seeder {

	public function run()
	{
		DB::table('congiunzioni')->truncate();

		// $faker = Faker::create();
		$congiunzioni = Config::get('congiunzioni');

		foreach($congiunzioni as $congiunzione)
		{
			Congiunzione::create($congiunzione);
		}
	}

}