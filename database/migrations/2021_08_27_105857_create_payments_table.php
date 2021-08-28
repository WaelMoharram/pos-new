<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->morphs('bill');
			$table->decimal('amount');
			$table->date('date');
			$table->enum('type', array('in', 'out'));
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}