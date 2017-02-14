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
            $table->string('description')->nullable();
            $table->enum('type', array('1', '2', '3'));
            $table->string('img')->nullable();
            $table->string('start_time');
            $table->string('end_time');
            $table->tinyInteger('status')->default(1);

        	$table->integer('campana_id')
                    ->unique();

            $table->integer('location_id')
                    ->foreign('location_id')
                    ->references('location_id')->on('locations')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

        	$table->integer('user_id')
                    ->foreign('user_id')
                    ->references('user_id')->on('users')
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
