<?php

//Languages

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

//Languages

Route::group(['prefix' => 'languages'], function () {

	Route::get('/', 'LanguageController@index')->name('all_language');

	Route::get('{language_id}/edit', 'LanguageController@edit')->name('edit_language')->where('language_id', '[0-9]+');

	Route::post('/', 'LanguageController@store')->name('store_language');

	Route::put('{language_id}', 'LanguageController@update')->name('update_language')->where('language_id', '[0-9]+');

	// Route::put('{language_id}/habilitar', 'LanguageController@update')->name('update_language')->where('language_id', '[0-9]+');
	// habilitar
	Route::put('{language_id}/habilitar', 'LanguageController@habilitar')->name('habilitar_language')->where('id', '[0-9]+');


	Route::delete('{language_id}', 'LanguageController@destroy')->name('destroy_language')->where('language_id', '[0-9]+');

});
