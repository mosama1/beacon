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

// Coupon_Promotions

Route::group(['prefix' => 'cupones'], function () {

	// Muestra el formulario de consultar los coupones
	Route::get('/', 'CouponPromotionsController@index')->name('index_coupon_promotions');

	// Lee el status del coupon
	Route::get('{id}/show', 'CouponPromotionsController@show')->name('show_coupon_promotions');

	Route::post('/', 'CouponPromotionsController@update')->name('update_coupon_promotions');

	//**************************//
	// consulta el verification code
	Route::post('code_location', 'CouponPromotionsController@check_code_location')->name('check_code_location')->where('id', '[0-9]+'); 	
	Route::post('code_coupon', 'CouponPromotionsController@check_code_coupon')->name('check_code_coupon')->where('id', '[0-9]+'); 	
});
