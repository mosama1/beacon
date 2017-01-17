<?php

use Beacon\Session;

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

Route::get('/', function () {
  if (Auth::guest()) {
    return view('index');
  } else {
    return view('home');
  }
});

Route::get('login', function () {
	if (Auth::guest()) {
		return view('auth.login');
	} else {
		return view('home');
	}
});



Route::get('home', 'HomeController@index');

//Beacons
Route::get('beacons/list', 'BeaconController@show')->name('list_beacons');

Route::get('beacons/add', 'BeaconController@edit')->name('edit_beacon')->where('id', '[0-9]+');

Route::post('beacons/add', 'BeaconController@store_beacon')->name('beacon_store_beacon')->where('id', '[0-9]+');;

Route::get('beacons', 'BeaconController@index')->name('location_beacons');

//Locations
Route::get('beacons/location', 'BeaconController@create_location')->name('location_add');

Route::post('beacons/locations', 'BeaconController@store')->name('store_locations');

Route::get('beacons/location/{id}/edit', 'BeaconController@edit_location')->name('edit_location')->where('id', '[0-9]+');

Route::post('beacons/location/{id}/edit', 'BeaconController@update_location')->name('location_update')->where('id', '[0-9]+');

Route::get('beacons/delete', 'BeaconController@destroy')->where('id', '[0-9]+');

//Coupon

Route::post('beacons/coupon', 'BeaconController@store_coupon')->name('store_coupon');

//timeframe
Route::get('beacons/timeframe', 'BeaconController@show_timeframe')->name('show_timeframe');

Route::get('beacons/timeframe/add', 'BeaconController@create_timeframe')->name('add_timeframe');

Route::post('beacons/timeframe/add', 'BeaconController@store_timeframe')->name('store_timeframe');

Route::get('beacons/timeframe/{id}/edit', 'BeaconController@edit_timeframe')->name('edit_timeframe')->where('id', '[0-9]+');

Route::post('beacons/timeframe/{id}/edit', 'BeaconController@update_timeframe')->name('location_timeframe')->where('id', '[0-9]+');

//Campa�a
Route::get('beacons/campana', 'BeaconController@show_campana')->name('show_campana');

Route::get('beacons/campana/add', 'BeaconController@create_campana')->name('add_campana');

Route::post('beacons/campana/add', 'BeaconController@store_campana')->name('store_campana');

Route::get('beacons/campana/{id}/edit', 'BeaconController@edit_campana')->name('edit_campana')->where('id', '[0-9]+');

Route::post('beacons/campana/{id}/edit', 'BeaconController@update_campana')->name('update_campana')->where('id', '[0-9]+');

//Campa�aContent
Route::get('beacons/campana/{id}/contenido', 'BeaconController@show_campana_content')->name('show_campana_content');

Route::post('beacons/campana/{id}/contenido/add', 'BeaconController@store_campana_content')->name('store_campana_content');

//Session
Route::get('beacons/menu', 'BeaconController@show_coupon')->name('show_coupon');

Route::get('beacons/{id}/session', 'BeaconController@show_session')->name('show_session');

Route::post('beacons/session/add', 'BeaconController@store_session')->name('store_session');

Route::get('beacons/session/delete', 'BeaconController@destroy_session')->where('id', '[0-9]+');


//Menu
Route::get('beacons/{id}/menu', 'BeaconController@show_menu')->name('show_menu')->where('id', '[0-9]+');

Route::post('beacons/menu', 'BeaconController@store_menu')->name('store_menu')->where('id', '[0-9]+');

Route::get('beacons/{id}/plato', 'BeaconController@show_plate')->name('show_plate')->where('id', '[0-9]+');

Route::post('beacons/plate', 'BeaconController@store_plate')->name('store_plate')->where('id', '[0-9]+');

Route::post('beacons/{id}/plate', 'BeaconController@update_plate')->name('update_plate')->where('id', '[0-9]+');

Route::get('beacons/tipoPlato', 'BeaconController@show_tipoPlato')->name('show_tipoPlato');

Route::post('beacons/tipoPlato', 'BeaconController@create_tipoPlato')->name('create_tipoPlato');

Route::put('beacons/tipoPlato', 'BeaconController@edit_tipoPlato')->name('edit_tipoPlato');
// Route::get('beacons/campana',     'BeaconController@show_campana')->name('show_campana');




//Cliente
Route::get('platos/{id}', 'BeaconController@showPlate')->name('showPlate')->where('id', '[0-9]+');

Route::get('platos/{id}/descripcion', 'BeaconController@showDescPlate')->name('showDescPlate')->where('id', '[0-9]+');

//End

Route::get('user/{id}', 'UserController@edit')->name('user_edit_path')->where('id', '[0-9]+');

Route::post('user/{id}/edit', 'UserController@update')->name('user_patch_path')->where('id', '[0-9]+');

Auth::routes();
