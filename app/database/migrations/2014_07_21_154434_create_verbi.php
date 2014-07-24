<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVerbi extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('verbi', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('infinito', 255);
			$table->string('gerundio', 255);
			$table->string('participio', 255);
			$table->string('presente1s', 255);
			$table->string('presente3s', 255);
			$table->string('presente1p', 255);
			$table->string('presente3p', 255);
			$table->string('passato1s', 255);
			$table->string('passato3s', 255);
			$table->string('passato1p', 255);
			$table->string('passato3p', 255);
			$table->string('riflessivo1s', 255);
			$table->string('riflessivo3s', 255);
			$table->string('riflessivo1p', 255);
			$table->string('riflessivo3p', 255);
			$table->string('congiuntivo1s', 255);
			$table->string('congiuntivo3s', 255);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('verbi');
	}

}
