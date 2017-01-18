<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Beacon\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\Language;
use Illuminate\Support\Facades\Input;

class LanguageController extends Controller
{

	//************************************* Language **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$language = Language::findOrFail($id);

			return  $language;

	}

	/**
	 * Create a new resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function create( Request $request )
	{

		$language = new Language();
		$language->name = $request->name;
		$language->abbreviation = $request->abbreviation;
		$language->save();


		return redirect()->route( 'show_language', $request->language_id )
						->with( [ 'status' => 'Se creo el tipo de plato', 'type' => 'success' ] );

	}

	/**
	 * Stores a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request )
	{

		$language = new Language();
		$language->name = $request->name;
		$language->abbreviation = $request->abbreviation;
		$language->save();


		return redirect()->route( 'show_language' , $request->language_id )
						->with( [ 'status' => 'Se creo el tipo de plato', 'type' => 'success' ] );

	}

	/**
	 * Displays a resource to be edited
	 *
	 * @param  integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id )
	{

	}

	/**
	 * Destroy a resource in storage.
	 *
	 * @param  integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id )
	{

        $language = Language::where('id', '=', $id)
                        ->first()->delete();

        return redirect()->route('show_language')
                        ->with(['status' => 'Lenguaje eliminado con éxito', 'type' => 'success']);

	}


}
