<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->integer('language_id')->unsigned()
                    ->foreign('language_id')
                    ->references('id')->on('languages')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('menu_id')->unsigned()
                    ->foreign('menu_id')
                    ->references('id')->on('menus')
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
        Schema::dropIfExists('menus_translations');
    }
}
