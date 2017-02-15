<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Beacon\Language;
use Beacon\LanguageUser;
use Beacon\User;

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

		// $user = User::where([
		// 	['user_id', '=', Auth::user()->user_id],
		// ])->get();
		// echo "<pre>"; var_dump($user); echo "</pre>";
		// return;


		$languages = DB::table('languages')
		->join('language_users', 'languages.id', '=', 'language_users.language_id')
		->join('users', 'users.user_id', '=', 'language_users.user_id')
		->select('languages.*')
		->where([
			['language_users.user_id', '=', Auth::user()->user_id],
		])
		->orderBy('name')->get();


		$languages_all = DB::table('languages')
		->orderBy('name')->get();

		$language_users = LanguageUser::where([
			['user_id', '=', Auth::user()->user_id],
		])->get();


		return view('languages.language', ['languages_all' => $languages_all, 'languages' => $languages, 'language_users' => $language_users]);

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

		// $languages = new LanguageUser();

		$languages = LanguageUser::where([
			['user_id', '=', Auth::user()->user_id],
			['language_id', '=', $request->language_id],
		])->first();


		// echo "<pre>"; var_dump($languages); echo "</pre>";
		// return;

		if (!$languages) {
			$language = new LanguageUser();
			$language->user_id = Auth::user()->user_id;
			$language->language_id = $request->language_id;
			$language->save();

			return redirect()->route( 'all_language' )
							->with( [ 'status' => 'Se creo el idioma', 'type' => 'success' ] );
		}else {
			return redirect()->route( 'all_language' )
							->with( [ 'status' => 'El idioma seleccionado ya esta agregado', 'type' => 'success' ] );
		}






	}

	/**
	 * Displays a resource to be edited
	 *
	 * @param  integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id )
	{
		$language = Language::where( 'id', '=', $id )->first();

		return view('languages.language_edit', ['language' => $language]);
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
	public function destroy( $language_id )
	{

        $language_users = LanguageUser::where([
			['language_id', '=', $language_id],
			['user_id', '=', Auth::user()->user_id],
		])->first()->delete();

        return redirect()->route('all_language')
                        ->with(['status' => 'Idioma eliminado con éxito', 'type' => 'success']);

	}

	public function habilitar($id)
	{

		$language_user = LanguageUser::where('id', '=', $id)->first();
		$status = ($language_user->status == 0) ? 1 : 0;
		$language_user->status = $status;
		$language_user->save();


		return $status;
	}


}
