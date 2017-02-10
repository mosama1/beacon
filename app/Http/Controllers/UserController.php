<?php

namespace Beacon\Http\Controllers;

use Beacon\Restaurant;
use Beacon\User;
use Illuminate\Http\Request;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Beacon\Location;
use Beacon\Pasos;
use Beacon\PasosProcesos;



class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}
	/**
	 * Validate if the password matches the password of the resource specified in the store.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function validate_password(Request $request, $id)
	{
		$messages = [
			'current_password'    => 'La contraseña actual no es correcta.',
		];

		$validator = Validator::make($request->all(), [
			'old_password' => 'required|current_password',
		],
		$messages);

		// var_dump($validator->passes());

		// 	echo "<pre>"; var_dump( $validator->messages() );    echo "</pre>";
		// return;

		return (int)$validator->passes();
	}

	/**
	 * Change Password the specified resource in storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function change_password(Request $request, $id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$messages = [
			'password_confirmation'    => 'Las contraseña :attribute no coincide con :other.',
		];


		$validator = Validator::make($request->all(), [
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',
		],
		$messages);

		$user->password = bcrypt($request->get('password'));
		if ($user->save()) {
			return redirect()->route('user_edit_path', $user->user_id)->with(['status' => 'Cambio de contraseña exitoso.', 'type' => 'success']);
		} else {
			return redirect()->route('user_edit_path', $user->user_id)->with(['status' => 'Cambio de contraseña fallido.', 'type' => 'error']);
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$location = $user->location;

		$ultimo_paso = UserController::ultimo_paso();


		if ($user->location):

			return view('users.edit', ['user' => $user, 'location' => $location, 'ultimo_paso' => $ultimo_paso ]);
		else:
			return view('locations.location_add');
		endif;

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	 public function update(Request $request, $id)
	 {
		$user = User::where( 'id', '=', Auth::user()->id )->first();
		$user->language =  $request->get('language');
		$user->email = $request->get('email');
		$user->phone = $request->get('phone');
		$user->save();
		return redirect()->route('user_edit_path', $user->user_id)->with(['status' => 'Se edito el perfil con exito', 'type' => 'success']);
	 }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public static function check_proccess( $paso_actual )
	{
		//Consulto al usuario conectado
		$user = User::where( 'id', '=', Auth::user()->id )->first();

		// Consulto en la tabla Pasos, cual es el paso requerido
		// esto es el paso previo al paso actual.
		$paso_previo = Pasos::where('id', '<', $paso_actual)->orderBy('id', 'desc')->first();

		// Consulto en la tabla bitacora el ultimo paso realizado esto es paso_id
		$ultimo_paso = PasosProcesos::where('user_id', '=', $user->id)->orderBy('paso_id', 'desc')->first();


		echo "user         : " . $user->id . "<br>";
		echo "paso actual  : " . $paso_actual . "<br>";
		echo "paso_previo  : " . $paso_previo->id . "<br>";
		echo "ultimo_paso  : " . $ultimo_paso->paso_id . "<br>";

		// si paso previo es igual a paso_id quiere decir que si va a poder acceder a esa seccion del menu
		// en ese caso se retorna un true

		// en caso contrario se retorna en false
		if ( $ultimo_paso->paso_id >= $paso_previo->id  ){

			return 1;
		};

		return 0;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public static function ultimo_paso()
	{



		if ( !Auth::guest() ) {

			//Consulto al usuario conectado
			$user = User::where( 'id', '=', Auth::user()->id )->first();

			// Consulto en la tabla bitacora el ultimo paso realizado esto es paso_id
			$ultimo_paso = PasosProcesos::where('user_id', '=', $user->id)->orderBy('paso_id', 'desc')->first();

			if ( is_Null($ultimo_paso) ){

				return 0;
			} else {

				return $ultimo_paso->paso_id;
			}
		}
	}
}
