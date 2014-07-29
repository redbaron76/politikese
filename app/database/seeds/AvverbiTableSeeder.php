<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class AvverbiTableSeeder extends Seeder {

	public function run()
	{
		DB::table('avverbi')->truncate();

		// $faker = Faker::create();
		$avverbi = Config::get('avverbi');

		foreach($avverbi as $avverbio)
		{
			$avverbio_new = [
				'text' => $avverbio,
			];

			Avverbio::create($avverbio_new);
		}
	}

}