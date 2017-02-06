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

Route::group(['prefix' => 'promotions'], function () {

	Route::get('/', function ()	{
		return view('promotions.promotion');
	})->name('all_promotion');

	Route::get('add', 'PromotionController@create_promotion')->name('add_promotion');

	Route::post('/', 'PromotionController@store_promotion')->name('store_promotion');

	Route::get('{id}/edit', 'PromotionController@edit_promotion')->name('edit_promotion')->where('id', '[0-9]+');

	Route::put('{id}', 'PromotionController@update_promotion')->name('update_promotion')->where('id', '[0-9]+');

	Route::delete('{promotion_id}', 'PromotionController@destroy_promotion')->name('destroy_promotion')->where('promotion_id', '[0-9]+');

});
