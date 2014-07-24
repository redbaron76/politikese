<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAggettivi extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aggettivi', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('text', 255);
			$table->string('genere', 1);
			$table->string('numero', 1);
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
		Schema::drop('aggettivi');
	}

}
