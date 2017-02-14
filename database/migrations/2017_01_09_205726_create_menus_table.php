<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->decimal('price', 5, 2);

            $table->integer('section_id')->unsigned()
                    ->foreign('section_id')
                    ->references('id')->on('sections')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('coupon_id')->unsigned()
                    ->foreign('coupon_id')
                    ->references('coupon_id')->on('coupons')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('user_id')->unsigned()
                    ->foreign('user_id')
                    ->references('user_id')->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('menus');
    }
}
