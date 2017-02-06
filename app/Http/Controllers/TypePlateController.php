<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Beacon\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\TypesPlates;
use Beacon\User;
use Illuminate\Support\Facades\Input;

class TypePlateController extends Controller
{

	//************************************* Tipo Plato **************************************************//

	public function index()
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$tiposplatos = TypesPlates::where([
							['user_id', '=', $user->user_id],
						])->orderBy('name', 'asc')->get();

		// echo "<pre>";  var_dump($tiposplatos); echo "</pre>";
		// return;

		return view('type_plates.types_plates', ['tiposplatos' => $tiposplatos] );
	}

	/**
	 * Create a new resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function create_type_plate( Request $request )
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$tipo_plato = new TypesPlates();
		$tipo_plato->user_id = $user->user_id;
		$tipo_plato->name = $request->name;
		$tipo_plato->description = $request->description;
		$tipo_plato->language_id = 1;
		$tipo_plato->save();




		if (empty($request->section_id)) {
			return redirect()->route( 'all_type_plate' )
						 ->with( [ 'status' => 'Se creo el tipo de plato', 'type' => 'success' ] );
		}else {
			return redirect()->route( 'all_menu',  $request->section_id)
						 ->with( [ 'status' => 'Se creo el tipo de plato', 'type' => 'success' ] );
		}



	}

	/**
	 * Edit a new resource in storage.
	 *
	 * @param  Integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit_type_plate( $type_plate_id )
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$tipo_plato = TypesPlates::where([
							[ 'user_id', '=', $user->user_id ],
							[ 'id', '=', $type_plate_id ]
						])->first();

		return view('type_plates.types_plates_edit', ['tipo_plato' => $tipo_plato]);
	}


	/**
	 * Store an updated resource in storage.
	 *
	 * @param  Integer $type_plate_id
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_type_plate(Request $request, $type_plate_id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$type_plate = TypesPlates::where([
							[ 'user_id', '=', $user->user_id ],
							[ 'id', '=', $type_plate_id ]
						])->first();

		$type_plate->name = $request->name;
		$type_plate->description = $request->description;
		//$type_plate->language_id = $request->language_id;
		$type_plate->language_id = 1;
		$type_plate->save();

		return redirect()->route('all_type_plate')
			->with(['status' => 'Se ha actualizado el tipo de plato satisfactoriamente', 'type' => 'success']);
	}

	/**
	 * Delete a resource in storage.
	 *
	 * @param  $id integer
	 * @return \Illuminate\Http\Response
	 */
	public function delete_type_plate( $type_plate_id )
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$tipo_plato = TypesPlates::where([
							[ 'user_id', '=', $user->user_id ],
							[ 'id', '=', $type_plate_id ]
						])->first()->delete();

		return redirect()->route('all_type_plate')
						->with(['status' => 'Tipo de plato eliminado con éxito', 'type' => 'success']);
	}

}
