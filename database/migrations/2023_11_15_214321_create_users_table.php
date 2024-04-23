<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->char('fname', 50)->nullable();
			$table->char('lname', 50)->nullable();
			$table->char('image', 100)->nullable();
			$table->date('dob')->nullable();
			$table->char('email', 60)->nullable();
			$table->char('phone', 50);
		
			$table->char('otp', 4)->nullable();
			$table->tinyInteger('is_active')->default('0');
			$table->char('updated_phone', 50)->nullable();

      $table->timestamp('phone_verified_at')->nullable();
      $table->rememberToken();
      $table->string('password')->nullable();
      $table->softDeletes();
      $table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}
