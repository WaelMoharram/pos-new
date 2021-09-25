<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptionssTable extends Migration {

	public function up()
	{
		Schema::create('optionss', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->text('note');
			$table->string('image');
		});
	}

	public function down()
	{
		Schema::drop('optionss');
	}
}
