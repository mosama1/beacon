<?php

//Beacons

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Beacons

Route::group(['prefix' => 'beacons'], function () {

	Route::get('/', 'BeaconController@show')->name('all_beacons');

	Route::get('/add', 'BeaconController@create_beacon')->name('create_beacon');

	Route::get('/{beacon_id}/edit', 'BeaconController@edit')->name('edit_beacon')->where('beacon_id', '[0-9]+');

	Route::post('/', 'BeaconController@store_beacon')->name('store_beacon');

	Route::delete('/{beacon_id}', 'BeaconController@destroy_beacon')->name('destroy_beacon')->where('id', '[0-9]+');

});
