<?php

namespace Beacon\Http\Controllers;

use Beacon\Restaurant;
use Beacon\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
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

		$location= $user->location;
		 
		if ($location):
			
			return view('users.edit', ['user' => $user, 'location' => $location ]);
		else:
			return view('beacons.location_add');
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
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->phone = $request->get('phone');
		if ( empty($request->get('password_update')) ) {
		  $user->save();
		} else {
		  $user->password = bcrypt($request->get('password_update'));
		  $user->save();
		}

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
}
