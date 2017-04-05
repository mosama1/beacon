<?php

//movil

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

//movil

Route::group(['prefix' => 'movil/campanas/{campana_id}'], function(){

	Route::get('/', 'MovilController@index')
			->name('inicio')->where('id', '[0-9]+');

	Route::get('/{language_id}/secciones/{section_id}/platos', 'MovilController@all_plate')
			->name('movil_all_plate')->where('campana_id', '[0-9]+')->where('section_id', '[0-9]+')->where('language_id', '[0-9]+');

	Route::get('/{language_id}/platos/{menu_id}/descripcion', 'MovilController@show_desc_plate')
			->name('show_desc_plate')->where('campana_id', '[0-9]+')->where('menu_id', '[0-9]+')->where('language_id', '[0-9]+');

	// rutas para el filtro por tipo de platos

	Route::get('/{language_id}/tipos_platos/{type_plate_id}/platos/{menu_id}/descripcion', 'MovilController@show_desc_plate_by_type')
			->name('show_desc_plate_by_type')->where('campana_id', '[0-9]+')->where('type_plate_id', '[0-9]+')->where('menu_id', '[0-9]+')->where('language_id', '[0-9]+');

	Route::get('/{language_id}/tipos_platos/{type_plate_id}/platos', 'MovilController@all_types_plates')
			->name('movil_all_types_plates')->where('campana_id', '[0-9]+')->where('type_plate_id', '[0-9]+')->where('language_id', '[0-9]+');

	Route::get('/{language_id}', 'MovilController@index_language')
			->name('inicio_language')->where('id', '[0-9]+')->where('language_id', '[0-9]+');


});

