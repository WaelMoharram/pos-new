<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryTransfersTable extends Migration {

	public function up()
	{
		Schema::create('inventory_transfers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('store_from_id');
			$table->bigInteger('store_to_id');
			$table->bigInteger('accept_user_id');
		});
	}

	public function down()
	{
		Schema::drop('inventory_transfers');
	}
}