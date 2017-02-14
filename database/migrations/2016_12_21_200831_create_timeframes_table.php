<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeframesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeframes', function (Blueprint $table) {
        	$table->increments('id');
        	$table->string('name');
        	$table->string('description')->nullable();
        	$table->string('start_time');
        	$table->string('end_time');
        	$table->string('days')->nullable();

            $table->integer('timeframe_id')
                    ->unique();

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
        Schema::dropIfExists('timeframes');
    }
}
