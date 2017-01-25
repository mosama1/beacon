<?php

//Locations

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

//Locations

Route::group(['prefix' => 'locations'], function () {

	Route::get('/', 'LocationController@index')->name('location_beacons');

	Route::get('/add', 'LocationController@create_location')->name('location_add');

	Route::post('/', 'LocationController@store')->name('store_locations');

	Route::get('/{id}/edit', 'LocationController@edit_location')->name('edit_location')->where('id', '[0-9]+');

	Route::post('/{id}', 'LocationController@update_location')->name('location_update')->where('id', '[0-9]+');

	Route::delete('/{id}', 'LocationController@destroy')->where('id', '[0-9]+');

});