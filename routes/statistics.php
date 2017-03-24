<?php

//Statistics

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

//Statistics

Route::group(['prefix' => 'estadisticas'], function () {

	Route::get('/', 'StatisticsController@index')->name('statistics');
	Route::get('/main', 'StatisticsController@getData');
});