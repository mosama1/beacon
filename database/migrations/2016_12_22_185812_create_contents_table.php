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
        	$table->string('coupon');
        	$table->string('tag');
            $table->string('trigger_name');

            $table->integer('content_id')
                    ->unique();
                    
        	$table->string('timeframe_id')
                    ->foreign('timeframe_id')
                    ->references('id')->on('timeframes')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('campana_id')
                    ->foreign('campana_id')
                    ->references('id')->on('campanas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('coupon_id')
                    ->foreign('coupon_id')
                    ->references('id')->on('coupons')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('user_id')
                    ->foreign('user_id')
                    ->references('id')->on('users')
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
        Schema::dropIfExists('contents');
    }
}
