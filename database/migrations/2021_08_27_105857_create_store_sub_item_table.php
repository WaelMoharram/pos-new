<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreSubItemTable extends Migration {

	public function up()
	{
		Schema::create('store_sub_item', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('sub_item_id');
			$table->bigInteger('store_id');
			$table->decimal('amount', 10,2);
		});
	}

	public function down()
	{
		Schema::drop('store_sub_item');
	}
}