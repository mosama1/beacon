<?php

//Sections

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

//Sections

	Route::get('coupons/{coupon_id}/sections', 'SectionController@index')->name('all_section')->where('id', '[0-9]+');

Route::group(['prefix' => 'sections'], function () {

	Route::post('/', 'SectionController@store_section')->name('store_section');

	//habilita las sesiones via ajax
	Route::put('{id}/habilitar', 'SectionController@habilitar_section')->name('habilitar_section')->where('id', '[0-9]+');


	Route::get('{id}/edit', 'SectionController@edit_section')->name('edit_section')->where('id', '[0-9]+');

	Route::put('{id}', 'SectionController@update_section')->name('update_section')->where('id', '[0-9]+');

	Route::delete('{id}', 'SectionController@destroy_section')
				->name('destroy_section')->where('id', '[0-9]+');

});