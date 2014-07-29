<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class VerbiTableSeeder extends Seeder {

	public function run()
	{
		DB::table('verbi')->truncate();

		// $faker = Faker::create();
		$verbi = Config::get('verbi');

		foreach($verbi as $verbo)
		{
			$verbo_new = [
				'infinito' => $verbo,
				'gerundio' => Verbo::gerundio($verbo),
				'presente1s' => Verbo::presente1s($verbo),
				'presente3s' => Verbo::presente3s($verbo),
				'presente1p' => Verbo::presente1p($verbo),
				'presente3p' => Verbo::presente3p($verbo),
				'passato1s' => Verbo::passato1s($verbo),
				'passato3s' => Verbo::passato3s($verbo),
				'passato1p' => Verbo::passato1p($verbo),
				'passato3p' => Verbo::passato3p($verbo),
				'riflessivo1s' => Verbo::riflessivo('self::presente1s', $verbo, 'mi'),
				'riflessivo3s' => Verbo::riflessivo('self::presente3s', $verbo, 'si'),
				'riflessivo1p' => Verbo::riflessivo('self::presente1p', $verbo, 'ci'),
				'riflessivo3p' => Verbo::riflessivo('self::presente3p', $verbo, 'si'),
				'congiuntivo1s' => Verbo::congiuntivo($verbo, '1s'),
				'congiuntivo3s' => Verbo::congiuntivo($verbo, '3s'),
				'congiuntivo1p' => Verbo::congiuntivo($verbo, '1p'),
				'congiuntivo3p' => Verbo::congiuntivo($verbo, '3p'),
				'partpresente' => Verbo::partpresente($verbo),
				'partpassato' => Verbo::partpassato($verbo)
			];

			Verbo::create($verbo_new);
		}
	}

}