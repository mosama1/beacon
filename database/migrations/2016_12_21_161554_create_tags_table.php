<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
        	$table->increments('id');
        	$table->string('name');

            $table->integer('tag_id')->unique()
                    ->foreign('tag_id')
                    ->references('id')->on('tags')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('tags');
    }
}
