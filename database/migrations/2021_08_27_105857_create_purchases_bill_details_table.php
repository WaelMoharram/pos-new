<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesBillDetailsTable extends Migration {

	public function up()
	{
		Schema::create('purchases_bill_details', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('item_id');
			$table->bigInteger('sub_item_id');
			$table->decimal('amount');
			$table->decimal('price');
			$table->decimal('total');
			$table->bigInteger('bill_id');
		});
	}

	public function down()
	{
		Schema::drop('purchases_bill_details');
	}
}