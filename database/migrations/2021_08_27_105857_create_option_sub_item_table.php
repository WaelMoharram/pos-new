<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptionSubItemTable extends Migration {

	public function up()
	{
		Schema::create('option_sub_item', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->bigInteger('option_id');
			$table->bigInteger('sub_item_id');
			$table->string('option_value');
		});
	}

	public function down()
	{
		Schema::drop('option_sub_item');
	}
}