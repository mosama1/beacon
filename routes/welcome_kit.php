<?php

//WelcomeKits

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

//WelcomeKits

Route::group(['prefix' => 'kit_bienvenida'], function () {

	Route::get('/', 'WelcomeKitController@index')
			->name('all_welcome_kit');

	Route::get('add', 'WelcomeKitController@create_welcome_kit')
			->name('add_welcome_kit');

	//habilita los kits de bienvenida via ajax
	Route::put('{id}/habilitar', 'WelcomeKitController@habilitar_welcomekit')->name('habilitar_welcomkit')->where('id', '[0-9]+');
		
	Route::post('/', 'WelcomeKitController@store_welcome_kit')
			->name('store_welcome_kit');

	Route::get('{welcome_kit_id}/edit', 'WelcomeKitController@edit_welcome_kit')
			->name('edit_welcome_kit')->where('id', '[0-9]+');

	Route::put('{welcome_kit_id}', 'WelcomeKitController@update_welcome_kit')
			->name('update_welcome_kit')->where('id', '[0-9]+');

	Route::delete('{welcome_kit_id}', 'WelcomeKitController@destroy_welcome_kit')
			->name('destroy_welcome_kit')->where('welcome_kit_id', '[0-9]+');

	// genera la imagen con el cogigo de seguridad
	Route::get('{id}', 'WelcomeKitController@generate_code_image')
			->name('promotion_view')->where('id', '[0-9]+');
});
