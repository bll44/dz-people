<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('x1');
			$table->integer('y1');
			$table->integer('x2');
			$table->integer('y2');
			$table->string('user_id')->nullable();
			$table->integer('map_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seats');
	}

}
