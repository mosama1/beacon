<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->integer('language_id')->unsigned()
                    ->foreign('language_id')
                    ->references('id')->on('languages')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('section_translations');
    }
}
