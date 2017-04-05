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

Route::group(['prefix' => 'madirajes'], function () {

	Route::get('/', 'MadirajeController@index')->name('all_madiraje');

	Route::post('/', 'MadirajeController@store')->name('store_madiraje');

	Route::post('/check', 'MadirajeController@check_madiraje')->name('check_madiraje');

	Route::get('/search', 'MadirajeController@search')->name('search_madiraje');

 	//habilita las campanas via ajax
	Route::put('{id}/habilitar', 'MadirajeController@habilitar_madiraje')->name('habilitar_madiraje')->where('id', '[0-9]+');

	Route::get('{id}/edit', 'MadirajeController@edit')->name('edit_madiraje')->where('id', '[0-9]+');

	Route::put('{id}', 'MadirajeController@update')->name('update_madiraje')->where('id', '[0-9]+');

	Route::delete('{id}', 'MadirajeController@destroy')->name('destroy_madiraje')->where('madiraje_id', '[0-9]+');

});