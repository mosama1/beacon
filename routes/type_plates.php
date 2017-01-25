<?php

//TypePlates

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

//TypePlates

Route::group(['prefix' => 'tipo_platos'], function () {

	Route::get('/', 'TypePlateController@index')->name('all_type_plate');

	Route::post('/', 'TypePlateController@create_type_plate')->name('create_tipoPlato');

	Route::put('{id}', 'TypePlateController@update_type_plate')->name('update_tipoPlato')->where('id', '[0-9]+');

	Route::delete('{id}', 'TypePlateController@delete_type_plate')->name('delete_tipoPlato')->where('id', '[0-9]+');

	Route::get('{id}/edit', 'TypePlateController@edit_type_plate')->name('edit_tipoPlato')->where('id', '[0-9]+');

});