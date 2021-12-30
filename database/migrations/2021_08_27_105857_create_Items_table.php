<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	public function up()
	{
		Schema::create('Items', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('image');
			$table->string('name');
			$table->string('barcode');
			$table->string('code');
			$table->bigInteger('category_id')->unsigned();
			$table->bigInteger('brand_id');
            $table->integer('min_amount')->default(0);

        });
	}

	public function down()
	{
		Schema::drop('Items');
	}
}
