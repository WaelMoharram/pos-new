<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillDetailsTable extends Migration {

	public function up()
	{
		Schema::create('bill_details', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('item_id');
			$table->bigInteger('sub_item_id');
			$table->decimal('amount');
			$table->decimal('price')->nullable();
			$table->decimal('total',10,2)->nullable();
			$table->bigInteger('bill_id');
		});
	}

	public function down()
	{
		Schema::drop('bill_details');
	}
}
