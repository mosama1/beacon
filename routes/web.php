<?php

use Beacon\Section;

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

//Section
Route::get('sections/{id}', 'SectionController@show_section')->name('show_section');

Route::post('sections', 'SectionController@store_section')->name('store_section');

Route::delete('sections', 'SectionController@destroy_section')->name('destroy_section');


//Menu
Route::get('bacons/menu', 'BeaconController@show_coupon')->name('show_coupon');

Route::get('menus/{id}', 'MenuController@show_menu')->name('show_menu')->where('id', '[0-9]+');

Route::post('menus', 'MenuController@store_menu')->name('store_menu')->where('id', '[0-9]+');

//Platos
Route::get('beacons/{id}/plato', 'BeaconController@show_plate')->name('show_plate')->where('id', '[0-9]+');

Route::post('beacons/plate', 'BeaconController@store_plate')->name('store_plate')->where('id', '[0-9]+');

Route::post('beacons/{id}/plate', 'BeaconController@update_plate')->name('update_plate')->where('id', '[0-9]+');


//Idiomas
Route::get('beacons/language', 'BeaconController@show_language')->name('show_language');

Route::get('beacons/languageEdit', 'BeaconController@show_languageEdit')->name('show_languageEdit');


//Tipos de Platos

Route::get('beacons/tipoPlato', 'BeaconController@show_tipoPlato')->name('show_tipoPlato');

Route::post('beacons/tipoPlato', 'BeaconController@create_tipoPlato')->name('create_tipoPlato');

Route::put('beacons/tipoPlato', 'BeaconController@edit_tipoPlato')->name('edit_tipoPlato');

Route::delete('beacons/tipoPlato/{id}', 'BeaconController@delete_tipoPlato')->name('delete_tipoPlato')->where('id', '[0-9]+');

Route::get('beacons/tipoPlatoEdit/{id}', 'BeaconController@edit_tipoPlato')->name('edit_tipoPlato')->where('id', '[0-9]+');
// Route::get('beacons/campana',     'BeaconController@show_campana')->name('show_campana');




//Cliente
Route::get('platos/{id}', 'BeaconController@showPlate')->name('showPlate')->where('id', '[0-9]+');

Route::get('platos/{id}/descripcion', 'BeaconController@showDescPlate')->name('showDescPlate')->where('id', '[0-9]+');

//Language
Route::get('idiomas', 'LanguageController@index')->name('index');
Route::get('idiomas/{id}', 'LanguageController@show')->name('show')->where('id', '[0-9]+');
Route::get('idiomas/new', 'LanguageController@news')->name('new');
Route::get('idiomas/{id}/edit', 'LanguageController@edit')->name('edit')->where('id', '[0-9]+');
Route::post('idiomas', 'LanguageController@create')->name('create');
Route::put('idiomas/{id}', 'LanguageController@update')->name('update')->where('id', '[0-9]+');
Route::delete('idiomas/{id}', 'LanguageController@destroy')->name('delete')->where('id', '[0-9]+');

//End

Route::get('user/{id}', 'UserController@edit')->name('user_edit_path')->where('id', '[0-9]+');

Route::post('user/{id}/edit', 'UserController@update')->name('user_patch_path')->where('id', '[0-9]+');

Auth::routes();
