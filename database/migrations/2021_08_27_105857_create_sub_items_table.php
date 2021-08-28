<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubItemsTable extends Migration {

	public function up()
	{
		Schema::create('sub_items', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->decimal('amount', 10,2);
			$table->string('barcode')->nullable();
			$table->text('note')->nullable();
			$table->bigInteger('item_id');
			$table->decimal('price', 10,2)->default('0');
		});
	}

	public function down()
	{
		Schema::drop('sub_items');
	}
}