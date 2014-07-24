<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaggabili extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taggabili', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('tag_id')->unsigned()->index();
			$table->integer('taggabile_id')->unsigned()->index();
			$table->string('taggabile_type', 255);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('taggabili');
	}

}
