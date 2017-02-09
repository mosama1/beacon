<?php

use Beacon\Http\Controllers\UserController;
use Beacon\Pasos;

// Login

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
|
| Set of routes to Login
|
*/
 
Route::get('/', function () { // cuando se hace el login 
	if (Auth::guest()) {
		
		return view('auth.login');
	} else {

		$ultimo_paso = UserController::ultimo_paso();

		return view('home', ['ultimo_paso' => $ultimo_paso,] );
	}
});

Route::get('login', function () {
	if (Auth::guest()) {

		return view('auth.login');
	} else {

		$ultimo_paso = UserController::ultimo_paso();

		return view('home', ['ultimo_paso' => '$ultimo_paso', ]);
	}
});