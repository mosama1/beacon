<?php

namespace Beacon\Http\Controllers;

use Beacon\Restaurant;
use Beacon\User;
use Illuminate\Http\Request;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Beacon\Location;

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

		$user = User::findOrFail($id);

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
			return redirect()->route('user_edit_path', $id)->with(['status' => 'Cambio de contraseña exitoso.', 'type' => 'success']);
		} else {
			return redirect()->route('user_edit_path', $id)->with(['status' => 'Cambio de contraseña fallido.', 'type' => 'error']);
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
		$user = User::findOrFail($id);

		$locatiom = Location::where('user_id', '=', $user->user_id)->first();

		if ($locatiom):

			$restaurant = $user->location;

			return view('users.edit', ['user' => $user, 'location' => $restaurant ]);
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
		$user = User::findOrFail($id);
		$user->language =  $request->get('language');
		$user->email = $request->get('email');
		$user->phone = $request->get('phone');
		$user->save();

		return redirect()->route('user_edit_path', $id)->with(['status' => 'Se edito el perfil con exito', 'type' => 'success']);
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
}
