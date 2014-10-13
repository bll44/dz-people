<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maps', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('company_name');
			$table->string('company_code', 6);
			$table->string('street');
			$table->string('city');
			$table->bigInteger('zip', 5);
			$table->integer('floor');
			$table->string('address2')->nullable();
			$table->string('description', 500)->nullable();
			$table->string('image')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('maps');
	}

}
