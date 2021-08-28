<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoresTable extends Migration {

	public function up()
	{
		Schema::create('stores', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('address');
			$table->bigInteger('sales_man_id')->nullable();
			$table->boolean('is_pos');
		});
	}

	public function down()
	{
		Schema::drop('stores');
	}
}