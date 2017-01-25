<?php

//Contents

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

//Contents

Route::group(['prefix' => 'campanas'], function () {

	Route::get('{campana_id}/contents', 'ContentController@all_content')
				->name('all_content')->where('campana_id', '[0-9]+');

	Route::post('{campana_id}/contenidos/add', 'ContentController@store_content')
				->name('store_content')->where('campana_id', '[0-9]+');

});