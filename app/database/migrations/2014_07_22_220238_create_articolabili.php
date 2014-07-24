<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticolabili extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articolabili', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('articolo_id')->unsigned()->index();
			$table->integer('articolabile_id')->unsigned()->index();
			$table->string('articolabile_type', 255);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articolabili');
	}

}
