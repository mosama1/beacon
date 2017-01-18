<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('country');
            $table->string('city');
            $table->string('zip');
            $table->string('street');
            $table->string('street_number');
            $table->string('timezone');
            $table->float('lat');
            $table->float('lng');

            $table->integer('location_id')->unique()
                    ->foreign('location_id')
                    ->references('id')->on('locations')
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
        Schema::dropIfExists('locations');
    }
}
