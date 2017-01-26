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
		$locatiom = Location::where('user_id', '=', Auth::user()->id)->first();
		 
		if ($locatiom):
			$user = User::findOrFail($id);
			
			$restaurant = User::findOrFail($id)->location;
			
			return view('users.edit', ['user' => $user, 'location' => $restaurant ]);
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
