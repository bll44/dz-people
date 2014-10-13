<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->string('objectguid')->primary();
			$table->string('username');
			$table->string('email')->nullable();
			$table->string('firstname')->nullable();
			$table->string('lastname')->nullable();
			$table->string('displayname')->nullable();
			$table->string('company')->nullable();
			$table->string('department')->nullable();
			$table->string('title')->nullable();
			$table->bigInteger('phone')->nullable();
			$table->date('start_date')->nullable();
			$table->string('profile_photo')->default('images/profiles/no_photo.jpg');
			$table->tinyInteger('admin')->default(0);
			$table->timestamps();
			$table->dateTime('last_refresh')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
