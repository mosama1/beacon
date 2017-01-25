<?php

//Menus

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

//Menus

Route::group(['prefix' => 'sections'], function () {

	Route::get('{section_id}/menus/{menu_id}', 'MenuController@show_menu')
				->name('show_menu')->where(['section_id' => '[0-9]+', 'menu_id' => '[0-9]+']);

	Route::get('{section_id}/menus', 'MenuController@show_sectionMenus')
				->name('show_sectionMenus')->where('section_id', '[0-9]+');

});


Route::group(['prefix' => 'menus'], function () {

	Route::post('/', 'MenuController@store_menu')->name('store_menu');

	Route::put('{id}', 'MenuController@update_menu')->name('update_menu')->where('menu_id', '[0-9]+');

	Route::get('{id}/edit', 'MenuController@edit_menu')->name('edit_menu')->where('menu_id', '[0-9]+');

	Route::delete('{id}', 'MenuController@destroy_menu')->name('destroy_menu')->where('menu_id', '[0-9]+');

});