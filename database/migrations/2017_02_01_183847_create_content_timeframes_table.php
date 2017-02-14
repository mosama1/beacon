<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTimeframesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_timeframes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('content_id')->unsigned()
                    ->foreign('content_id')
                    ->references('content_id')->on('contents')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('timeframe_id')->unsigned()
                    ->foreign('timeframe_id')
                    ->references('timeframe_id')->on('timeframes')
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
        Schema::dropIfExists('content_timeframes');
    }
}
