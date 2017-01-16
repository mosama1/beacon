<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('content_id')->unique();
        	$table->integer('user_id');
        	$table->string('coupon');
        	$table->string('tag');
        	$table->string('timeframes');
        	$table->string('trigger_name');
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
        Schema::dropIfExists('contents');
    }
}
