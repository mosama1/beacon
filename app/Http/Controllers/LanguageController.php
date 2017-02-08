<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Beacon\Language;

class LanguageController extends Controller
{

	//************************************* Language **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$languages = Language::all();

		return view('languages.language', ['languages' => $languages]);
	}

	/**
	 * Display a specific resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id )
	{
		$language = Language::findOrFail($id);

			return  $language;

	}

	/**
	 * Displays the view to create a new resource.
	 *
	 * @param  integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return "vista para crear el idioma";
	}

	/**
	 * Create a new resource in storage.
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


		return redirect()->route( 'all_language' )
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
		return view('languages.language_edit');
	}

	/**
	 * Stores a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id )
	{

		$language = Language::where('id', '=', $id)->first();
		$language->name = $request->name;
		$language->abbreviation = $request->abbreviation;
		$language->save();


		return redirect()->route( 'all_language' )
						->with( [ 'status' => 'Se actualizó el idioma con éxito', 'type' => 'success' ] );

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

        return redirect()->route('all_language')
                        ->with(['status' => 'Idioma eliminado con éxito', 'type' => 'success']);

	}


}
