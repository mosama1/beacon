<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use Beacon\Pasos;


class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$ultimo_paso = UserController::ultimo_paso();

		return view('home', ['ultimo_paso' => $ultimo_paso, ] );
	}
}
