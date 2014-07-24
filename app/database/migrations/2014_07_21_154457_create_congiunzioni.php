<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCongiunzioni extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('congiunzioni', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('text', 255);
			$table->boolean('congiuntivo')->defaults(0);
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
		Schema::drop('congiunzioni');
	}

}
