<?php

//Campanas

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

//Campanas

Route::group(['prefix' => 'campanas'], function () {

	Route::get('/', 'CampanaController@show_campana')->name('show_campana');

	Route::get('add', 'CampanaController@create_campana')->name('add_campana');

	Route::post('/', 'CampanaController@store_campana')->name('store_campana');

	Route::get('{id}/edit', 'CampanaController@edit_campana')->name('edit_campana')->where('id', '[0-9]+');

	Route::put('{id}', 'CampanaController@update_campana')->name('update_campana')->where('id', '[0-9]+');

	Route::delete('{campana_id}', 'CampanaController@destroy_campana')->name('destroy_campana')->where('campana_id', '[0-9]+');

});