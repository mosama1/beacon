<?php
// Login

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
|
| Set of routes to Login
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