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

Route::group(['prefix' => 'campanas/{campana_id}/contenidos'], function () {

	Route::get('/', 'ContentController@index')
				->name('all_content')->where('campana_id', '[0-9]+');

	Route::post('/', 'ContentController@store')
				->name('store_content')->where('campana_id', '[0-9]+');

	Route::get('{content_id}', 'ContentController@edit')
				->name('edit_content')->where('campana_id', '[0-9]+')->where('content_id', '[0-9]+');

	Route::put('{content_id}', 'ContentController@update')
				->name('update_content')->where('campana_id', '[0-9]+')->where('content_id', '[0-9]+');

	Route::delete('{content_id}', 'ContentController@destroy')
				->name('destroy_content')->where('campana_id', '[0-9]+')->where('content_id', '[0-9]+');

});


Route::group(['prefix' => 'promotions/{promotion_id}/contenidos'], function () {

	Route::get('/', 'ContentController@index_promotion')
				->name('all_content_promotion')->where('promotion_id', '[0-9]+');

	Route::post('/', 'ContentController@store_promotion')
				->name('store_content_promotion')->where('promotion_id', '[0-9]+');

	Route::get('{content_id}', 'ContentController@edit_promotion')
				->name('edit_content_promotion')->where('promotion_id', '[0-9]+')->where('content_id', '[0-9]+');

	Route::put('{content_id}', 'ContentController@update_promotion')
				->name('update_content_promotion')->where('promotion_id', '[0-9]+')->where('content_id', '[0-9]+');

	Route::delete('{content_id}', 'ContentController@destroy_promotion')
				->name('destroy_content_promotion')->where('promotion_id', '[0-9]+')->where('content_id', '[0-9]+');

});