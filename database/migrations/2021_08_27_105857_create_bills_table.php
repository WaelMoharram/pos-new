<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillsTable extends Migration {

	public function up()
	{
		Schema::create('bills', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->nullableMorphs('model');
			$table->bigInteger('store_id')->nullable();
			$table->string('code');
			$table->text('note')->nullable();
			$table->decimal('discount', 10,2)->nullable();
			$table->string('discount_type')->nullable();
			$table->decimal('tax', 10,2)->nullable();
			$table->string('tax_type')->nullable();
			$table->enum('type', array('sale_in','sale_out','purchase_in','purchase_out','payment_in','payment_out','store','cash_in','cash_out'));
			$table->enum('status',['new','saved','cancelled']);
			$table->boolean('need_discount');
			$table->date('date');
            $table->bigInteger('store_from_id')->nullable();
            $table->bigInteger('store_to_id')->nullable();
			$table->bigInteger('accept_user_id');
            $table->bigInteger('sales_man_id')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('bills');
	}
}
