<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesBillsTable extends Migration {

	public function up()
	{
		Schema::create('purchases_bills', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('supplier_id')->nullable();
			$table->bigInteger('store_id');
			$table->string('code');
			$table->text('note')->nullable();
			$table->decimal('discount', 10,2)->nullable();
			$table->string('discount_type')->nullable();
			$table->decimal('tax', 10,2)->nullable();
			$table->string('tax_type')->nullable();
			$table->enum('type', array(''));
			$table->decimal('total', 10,2);
			$table->date('date');
			$table->bigInteger('accept_user_id');
		});
	}

	public function down()
	{
		Schema::drop('purchases_bills');
	}
}