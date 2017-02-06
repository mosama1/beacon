<?php

//FidelityKits

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

//FidelityKits

Route::group(['prefix' => 'kit_fidelidad'], function () {

	Route::get('/', 'FidelityKitController@index')
			->name('all_fidelity_kit');

	Route::get('add', 'FidelityKitController@create_fidelity_kit')
			->name('add_fidelity_kit');

	Route::post('/', 'FidelityKitController@store_fidelity_kit')
			->name('store_fidelity_kit');

	Route::get('{fidelity_kit_id}/edit', 'FidelityKitController@edit_fidelity_kit')
			->name('edit_fidelity_kit')->where('id', '[0-9]+');

	Route::put('{fidelity_kit_id}', 'FidelityKitController@update_fidelity_kit')
			->name('update_fidelity_kit')->where('id', '[0-9]+');

	Route::delete('{fidelity_kit_id}', 'FidelityKitController@destroy_fidelity_kit')
			->name('destroy_fidelity_kit')->where('fidelity_kit_id', '[0-9]+');

});
