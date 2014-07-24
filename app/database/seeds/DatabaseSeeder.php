<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UtentiTableSeeder');
		$this->call('EspressioniTableSeeder');
		$this->call('PreposizioniTableSeeder');
		$this->call('CongiunzioniTableSeeder');
	}

}
