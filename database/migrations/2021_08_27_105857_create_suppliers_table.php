<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuppliersTable extends Migration {

	public function up()
	{
		Schema::create('suppliers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('phone')->nullable();
			$table->string('email');
			$table->text('address');
			$table->text('note')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('suppliers');
	}
}