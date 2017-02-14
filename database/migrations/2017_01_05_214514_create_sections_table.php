<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('coupon_id')
                    ->foreign('coupon_id')
                    ->references('coupon_id')->on('coupons')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('user_id')
                    ->foreign('user_id')
                    ->references('user_id')->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->string('price')->default(0.00);
            $table->tinyInteger('status');


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
        Schema::dropIfExists('sections');
    }
}
