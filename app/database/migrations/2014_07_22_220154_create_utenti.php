<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUtenti extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('utenti', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 20);
			$table->string('email', 100);
			$table->string('password', 64);
			$table->string('remember_token', 100)->nullable();
			$table->string('gender', 1);
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
		Schema::drop('utenti');
	}

}
