<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationsPlatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations_plates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');

            $table->integer('language_id')->unsigned()
                    ->foreign('language_id')
                    ->references('id')->on('languages')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('plate_id')->unsigned()
                    ->foreign('plate_id')
                    ->references('id')->on('plates')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations_plates');
    }
}
