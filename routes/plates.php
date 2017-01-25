<?php

//Plates

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

//Plates

Route::group(['prefix' => 'platos'], function () {

	Route::get('{menu_id}/detalles', 'PlatesController@show_plate')->name('show_plate')->where('menu_id', '[0-9]+');

	Route::post('{menu_id}/detalles', 'PlatesController@store_plate')->name('store_plate')->where('menu_id', '[0-9]+');

	Route::put('{menu_id}/detalles', 'PlatesController@update_plate')->name('update_plate')->where('menu_id', '[0-9]+');


	//Cliente

	Route::get('{menu_id}/descripcion', 'PlatesController@showDescPlate')->name('showDescPlate')->where('id', '[0-9]+');

});