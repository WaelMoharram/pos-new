<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryTransferDetailsTable extends Migration {

	public function up()
	{
		Schema::create('inventory_transfer_details', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('sub_item_id');
			$table->decimal('amount', 10,2);
		});
	}

	public function down()
	{
		Schema::drop('inventory_transfer_details');
	}
}