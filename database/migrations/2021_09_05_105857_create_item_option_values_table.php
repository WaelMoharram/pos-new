<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemOptionValuesTable extends Migration {

	public function up()
	{
		Schema::create('item_option_values', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->bigInteger('item_option_id');
			$table->text('value');
		});
	}

	public function down()
	{
		Schema::drop('item_option_values');
	}
}
