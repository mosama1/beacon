<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promotions', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->integer('number_visits');
			$table->integer('type');
			$table->string('img');

			$table->string('start_time');
			$table->string('end_time');
			$table->tinyInteger('status');


			$table->integer('promotion_id')
					->unique();

			$table->integer('location_id')
					->foreign('location_id')
					->references('location_id')->on('locations')
					->onUpdate('cascade')
					->onDelete('cascade');

			$table->integer('user_id')
					->foreign('user_id')
					->references('user_id')->on('users')
					->onUpdate('cascade')
					->onDelete('cascade');

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
		Schema::dropIfExists('promotions');
	}
}
