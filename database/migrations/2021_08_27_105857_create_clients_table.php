<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->text('address')->nullable();
			$table->text('notes')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}