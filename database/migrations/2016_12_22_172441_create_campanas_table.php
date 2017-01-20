<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanas', function (Blueprint $table) {
        	$table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('start_time');
            $table->string('end_time');

            $table->boolean('enabled');

        	$table->integer('campana_id')
                    ->unique();
            
            $table->integer('location_id')
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
        Schema::dropIfExists('campanas');
    }
}
