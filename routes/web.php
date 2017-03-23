<?php

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




// Routa de las promociones
// 
Route::group(['prefix' => 'movil/promocion/'], function(){
	
	Route::get('{promotion_id}', 'WelcomeKitController@generate_code_image')
			->name('promotion_view')->where('promotion_id', '[0-9]+');	
});

Route::group(['middleware' => 'auth'], function () {
	require (__DIR__ . '/beacons.php');
	require (__DIR__ . '/campanas.php');
	require (__DIR__ . '/contents.php');
	require (__DIR__ . '/coupons.php');
	require (__DIR__ . '/fidelity_kit.php');
	require (__DIR__ . '/guest.php');
	require (__DIR__ . '/home.php');
	require (__DIR__ . '/languages.php');
	require (__DIR__ . '/locations.php');
	require (__DIR__ . '/menus.php');
	require (__DIR__ . '/promotions.php');
	require (__DIR__ . '/plates.php');
	require (__DIR__ . '/sections.php');
	require (__DIR__ . '/timeframes.php');
	require (__DIR__ . '/type_plates.php');
	require (__DIR__ . '/users.php');
	require (__DIR__ . '/welcome_kit.php');	
	require (__DIR__ . '/madirajes.php');
	require (__DIR__ . '/statistics.php');
	Route::get('home', 'HomeController@index');
});

	// Rutas que no van a ser validadas
	//
	require (__DIR__ . '/movil.php');
	require (__DIR__ . '/coupon_promotions.php');

Route::get('token/analytics', 'BeaconController@crud')->name('token_generate');


Auth::routes();
