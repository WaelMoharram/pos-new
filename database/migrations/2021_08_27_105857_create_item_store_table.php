<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemStoreTable extends Migration {

	public function up()
	{
		Schema::create('item_store', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('item_id');
			$table->bigInteger('store_id');
			$table->decimal('amount', 10,2);
		});
	}

	public function down()
	{
		Schema::drop('item_store');
	}
}
