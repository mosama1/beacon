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
		return view('auth.login');
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

Route::get('beacons/add', 'BeaconController@edit')->name('create_beacon')->where('id', '[0-9]+');

Route::get('beacons/{id}/edit', 'BeaconController@edit')->name('edit_beacon')->where('id', '[0-9]+');

Route::post('beacons', 'BeaconController@store_beacon')->name('beacon_store_beacon');

Route::delete('beacons/{beacon_id}', 'BeaconController@beacon_destroy')->name('beacon_destroy')->where('id', '[0-9]+');

Route::get('beacons', 'BeaconController@index')->name('location_beacons');

//Locations
Route::get('beacons/locations', 'LocationController@create_location')->name('location_add');

Route::post('beacons/locations', 'LocationController@store')->name('store_locations');

Route::get('beacons/locations/{id}/edit', 'LocationController@edit_location')->name('edit_location')->where('id', '[0-9]+');

Route::post('beacons/locations/{id}', 'LocationController@update_location')->name('location_update')->where('id', '[0-9]+');

Route::delete('beacons/{id}', 'LocationController@destroy')->where('id', '[0-9]+');

//Coupon
Route::get('coupons', 'BeaconController@show_coupon')->name('show_coupon');

Route::post('coupons', 'BeaconController@store_coupon')->name('store_coupon');

Route::get('coupons/{coupon_id}', 'BeaconController@edit_coupon')->name('edit_coupon')->where('id', '[0-9]+');

Route::put('coupons/{id}', 'BeaconController@update_coupon')->name('update_coupon')->where('id', '[0-9]+');

Route::delete('coupons/{coupon_id}', 'BeaconController@destroy_coupon')
			->name('destroy_coupon')->where('coupon_id', '[0-9]+');

//timeframe
Route::get('timeframes', 'BeaconController@show_timeframe')->name('show_timeframe');

Route::get('timeframes/add', 'BeaconController@create_timeframe')->name('add_timeframe');

Route::post('timeframes', 'BeaconController@store_timeframe')->name('store_timeframe');

Route::get('timeframes/{id}/edit', 'BeaconController@edit_timeframe')->name('edit_timeframe')->where('id', '[0-9]+');

Route::put('timeframes/{id}', 'BeaconController@update_timeframe')->name('update_timeframe')->where('id', '[0-9]+');

Route::delete('timeframes/{id}', 'BeaconController@destroy_timeframe')->name('destroy_timeframe')->where('id', '[0-9]+');

//Campa�a
Route::get('campanas', 'CampanaController@show_campana')->name('show_campana');

Route::get('campanas/add', 'CampanaController@create_campana')->name('add_campana');

Route::post('campanas', 'CampanaController@store_campana')->name('store_campana');

Route::get('campanas/{id}/edit', 'CampanaController@edit_campana')->name('edit_campana')->where('id', '[0-9]+');

Route::put('campanas/{id}', 'CampanaController@update_campana')->name('update_campana')->where('id', '[0-9]+');

Route::delete('campanas/{campana_id}', 'CampanaController@destroy_campana')
			->name('destroy_campana')->where('campana_id', '[0-9]+');

//Campa�aContent
Route::get('campanas/{id}/contents', 'CampanaController@show_content')
			->name('show_content')->where('id', '[0-9]+');

Route::post('campanas/{id}/contenidos/add', 'CampanaController@store_campana_content')->name('store_campana_content');

//Section
Route::get('coupons/{coupon_id}/sections', 'SectionController@show_section')->name('show_section');

Route::post('sections', 'SectionController@store_section')->name('store_section');

Route::get('sections/{id}/edit', 'SectionController@edit_section')->name('edit_section');

Route::put('sections/{id}', 'SectionController@update_section')->name('update_section');

Route::delete('sections/{id}', 'SectionController@destroy_section')
			->name('destroy_section')->where('id', '[0-9]+');


//Menu

Route::get('sections/{section_id}/menus/{menu_id}', 'MenuController@show_menu')
			->name('show_menu')->where(['section_id' => '[0-9]+', 'menu_id' => '[0-9]+']);

Route::get('sections/{section_id}/menus', 'MenuController@show_sectionMenus')
			->name('show_sectionMenus')->where('section_id', '[0-9]+');

Route::post('menus', 'MenuController@store_menu')->name('store_menu')->where('id', '[0-9]+');

Route::put('menus/{id}', 'MenuController@update_menu')->name('update_menu')->where('id', '[0-9]+');

Route::get('menus/{id}/edit', 'MenuController@edit_menu')->name('edit_menu')->where('id', '[0-9]+');

Route::delete('menus/{id}', 'MenuController@destroy_menu')->name('destroy_menu')->where('id', '[0-9]+');


//Platos
Route::get('menus/{menu_id}/detalles', 'BeaconController@show_plate')->name('show_plate')->where('menu_id', '[0-9]+');

Route::post('menus/{menu_id}/detalles', 'BeaconController@store_plate')->name('store_plate')->where('menu_id', '[0-9]+');

Route::put('menus/{id}/detalles', 'BeaconController@update_plate')->name('update_plate')->where('id', '[0-9]+');


//Idiomas
Route::get('beacons/languages', 'BeaconController@show_language')->name('show_language');

Route::get('beacons/languageEdit', 'BeaconController@show_languageEdit')->name('show_languageEdit');


//Tipos de Platos

Route::get('beacons/tipoPlatos', 'BeaconController@show_tipoPlato')->name('show_tipoPlato');

Route::post('beacons/tipoPlatos', 'BeaconController@create_tipoPlato')->name('create_tipoPlato');

Route::put('beacons/tipoPlatos/{id}', 'BeaconController@update_type_plate')->name('update_tipoPlato')->where('id', '[0-9]+');

Route::delete('beacons/tipoPlatos/{id}', 'BeaconController@delete_tipoPlato')->name('delete_tipoPlato')->where('id', '[0-9]+');

Route::get('beacons/tipoPlatos/{id}/edit', 'BeaconController@edit_tipoPlato')->name('edit_tipoPlato')->where('id', '[0-9]+');
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


//Rutas para mobil

Route::group(['prefix' => 'movil'], function(){

	Route::get('/campanas/{campanas_id}', ['uses' => 'MovilController@index', 'as' => 'inicio'])->where('id', '[0-9]+');

	Route::get('/campanas/{campanas_id}/secciones/{id}/platos', ['uses' => 'MovilController@show_plate', 'as' => 'movil_show_plate'])->where('id', '[0-9]+')->where('id', '[0-9]+');

	Route::get('/campanas/{campanas_id}/platos/{id}/descripcion', 'MovilController@show_desc_plate')->name('showDescPlate')->where('id', '[0-9]+')->where('id', '[0-9]+');

});

Route::get('token/analytics', 'BeaconController@crud')->name('token_generate');


Auth::routes();
