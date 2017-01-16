<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeaconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacons', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('beacon_id')->unique();
        	$table->integer('user_id');
        	$table->string('name');
        	$table->integer('major');
        	$table->integer('minor');
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
        Schema::dropIfExists('beacons');
    }
}
