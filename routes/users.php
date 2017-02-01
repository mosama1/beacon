<?php

//Users

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

//Users

Route::group(['prefix' => 'user'], function () {

	Route::get('{id}', 'UserController@edit')->name('user_edit_path')->where('id', '[0-9]+');

	Route::post('{id}/edit', 'UserController@update')->name('user_patch_path')->where('id', '[0-9]+');

	Route::post('{id}/validate_password', 'UserController@validate_password')->name('validate_password')->where('id', '[0-9]+');

 	Route::post('{id}/change_password', 'UserController@change_password')->name('change_password')->where('id', '[0-9]+');

});
