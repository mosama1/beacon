<?php

//Coupons

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

//Coupons

Route::group(['prefix' => 'timeframes'], function () {

	Route::get('/', 'TimeframeController@show_timeframe')->name('show_timeframe');

	Route::get('add', 'TimeframeController@create_timeframe')->name('add_timeframe');

	Route::post('/', 'TimeframeController@store_timeframe')->name('store_timeframe');

	Route::get('{timeframe_id}/edit', 'TimeframeController@edit_timeframe')->name('edit_timeframe')->where('timeframe_id', '[0-9]+');

	Route::put('{timeframe_id}', 'TimeframeController@update_timeframe')->name('update_timeframe')->where('timeframe_id', '[0-9]+');

	Route::delete('{timeframe_id}', 'TimeframeController@destroy')->name('destroy_timeframe')->where('timeframe_id', '[0-9]+');

});