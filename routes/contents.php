<?php

//Contents

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

//Contents

Route::group(['prefix' => 'campanas'], function () {

	Route::get('{campana_id}/contents', 'ContentController@index')
				->name('all_content')->where('campana_id', '[0-9]+');

	Route::post('{campana_id}/contenidos/add', 'ContentController@store')
				->name('store_content')->where('campana_id', '[0-9]+');

	Route::get('{campana_id}/contenidos/edit', 'ContentController@edit')
				->name('edit_content')->where('campana_id', '[0-9]+');

	Route::put('{campana_id}/contenidos/{content_id}', 'ContentController@update')
				->name('update_content')->where('campana_id', '[0-9]+')->where('content_id', '[0-9]+');

	Route::delete('{campana_id}/contenidos/{content_id}', 'ContentController@destroy')
				->name('destroy_content')->where('campana_id', '[0-9]+')->where('content_id', '[0-9]+');

});