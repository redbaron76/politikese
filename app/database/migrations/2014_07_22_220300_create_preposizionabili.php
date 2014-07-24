<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePreposizionabili extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preposizionabili', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('preposizione_id')->unsigned()->index();
			$table->integer('preposizionabile_id')->unsigned()->index();
			$table->string('preposizionabile_type', 255);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('preposizionabili');
	}

}
