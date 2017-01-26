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

Route::group(['prefix' => 'movil'], function(){

	Route::get('/campanas/{campanas_id}', 'MovilController@index')
			->name('inicio')->where('id', '[0-9]+');

	Route::get('/campanas/{campanas_id}/secciones/{section_id}/platos', 'MovilController@all_plate')
			->name('movil_all_plate')->where('campanas_id', '[0-9]+')->where('section_id', '[0-9]+');

	Route::get('/campanas/{campanas_id}/platos/{id}/descripcion', 'MovilController@show_desc_plate')
			->name('show_desc_plate')->where('id', '[0-9]+')->where('id', '[0-9]+');

});