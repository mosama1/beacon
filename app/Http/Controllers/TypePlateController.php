<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Beacon\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\TypesPlates;
use Illuminate\Support\Facades\Input;

class TypePlateController extends Controller
{	
	
	//************************************* Tipo Plato **************************************************//

	public function index()
	{
		$tiposplatos = TypesPlates::get();

		return view('typeplates.tipoPlato', ['tiposplatos' => $tiposplatos] );
	}

	/**
	 * Create a new resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function create_type_plate( Request $request )
	{

		$tipo_plato = new TypesPlates();
		$tipo_plato->name = $request->name;
		$tipo_plato->description = $request->description;
		$tipo_plato->language_id = 1;
		$tipo_plato->save();


		return redirect()->route( 'all_type_plate' )
						->with( [ 'status' => 'Se creo el tipo de plato', 'type' => 'success' ] );
	}

	/**
	 * Edit a new resource in storage.
	 *
	 * @param  Integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit_type_plate( $id )
	{

		$tipo_plato = TypesPlates::where('id', '=', $id)->first();

		return view('menus.tipoPlatoEdit', ['tipo_plato' => $tipo_plato]);
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

		$type_plate = TypesPlates::find($type_plate_id);

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
	public function delete_type_plate( $id )
	{

		$tipo_plato = TypesPlates::where('id', '=', $id)
						->first()->delete();

		return redirect()->route('all_type_plate')
						->with(['status' => 'Tipo de plato eliminado con éxito', 'type' => 'success']);
	}

}
