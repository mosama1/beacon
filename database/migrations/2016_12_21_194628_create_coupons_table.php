<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('coupon_id')->unique();
        	$table->integer('user_id');
        	$table->string('name');
        	$table->string('description');
        	$table->string('message');
        	$table->string('type');
        	$table->string('url');
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
        Schema::dropIfExists('coupons');
    }
}
