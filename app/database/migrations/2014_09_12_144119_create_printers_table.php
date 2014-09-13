<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('printers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('path');
			$table->integer('x1')->nullable();
			$table->integer('y1')->nullable();
			$table->integer('x2')->nullable();
			$table->integer('y2')->nullable();
			$table->integer('map_id');
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
		Schema::drop('printers');
	}

}
