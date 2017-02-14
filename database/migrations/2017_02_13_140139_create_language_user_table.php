<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('language_user', function(Blueprint $table)
       {
           $table->increments('id');


           $table->integer('language_id')->unsigned()
                   ->foreign('language_id')
                   ->references('id')->on('languages')
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
        //
    }
}
