<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRevenuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('revenues', function(Blueprint $table) {
			$table->increments('id');
			$table->string('project');
			$table->string('type');
			$table->string('narration');
			$table->bigInteger('amount');
			$table->string('creator');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('revenues');
	}

}
