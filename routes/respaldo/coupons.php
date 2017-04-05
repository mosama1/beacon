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

Route::group(['prefix' => 'coupons'], function () {

	Route::get('/', 'CouponController@index')->name('all_coupon');

	//
	Route::post('/', 'CouponController@store_coupon')->name('store_coupon');

	//habilita las cupones via ajax
	Route::put('{id}/habilitar', 'CouponController@habilitar_coupon')->name('habilitar_coupon')->where('id', '[0-9]+');

	//DUPLICAR CUPON//
	Route::get('{id}/duplicate', 'CouponController@duplicate_coupon')->name('duplicate_coupon')->where('coupon_id', '[0-9]+')->where('coupon_id', '[0-9]+');
	Route::post('/duplicate', 'CouponController@process_duplicate_coupon')->name('process_duplicate_coupon');
	

	Route::get('{coupon_id}/edit', 'CouponController@edit_coupon')->name('edit_coupon')->where('coupon_id', '[0-9]+');

	Route::put('{coupon_id}', 'CouponController@update_coupon')->name('update_coupon')->where('coupon_id', '[0-9]+');

	Route::delete('{coupon_id}', 'CouponController@destroy_coupon')->name('destroy_coupon')->where('coupon_id', '[0-9]+');

});