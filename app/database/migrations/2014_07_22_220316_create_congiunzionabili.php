<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCongiunzionabili extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('congiunzionabili', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('congiunzione_id')->unsigned()->index();
			$table->integer('congiunzionabile_id')->unsigned()->index();
			$table->string('congiunzionabile_type', 255);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('congiunzionabili');
	}

}
