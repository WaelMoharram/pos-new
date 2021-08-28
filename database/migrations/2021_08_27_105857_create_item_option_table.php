<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemOptionTable extends Migration {

	public function up()
	{
		Schema::create('item_option', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->bigInteger('item_id');
			$table->bigInteger('option_id');
		});
	}

	public function down()
	{
		Schema::drop('item_option');
	}
}