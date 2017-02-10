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
		// $languages = Language::all();
		// $languages = Language::where( 'user_id', '=', Auth::user()->user_id )->get();
		// $languages = Language::all();
		// $language_user = LanguageUser::where( 'user_id', '=', Auth::user()->user_id )->get();
		// $language_user->user;
		// $language_user->language;


		$user = User::where( 'user_id', '=', Auth::user()->user_id )->get();

// 		$language = DB::table('languages')
// 					->join('language_user')
//
//
//
// $content_timeframes = DB::table('timeframes')
// ->join('content_timeframes', 'timeframes.timeframe_id', '=', 'content_timeframes.timeframe_id')
// ->join('contents', 'contents.id', '=', 'content_timeframes.content_id')
// ->select('timeframes.*')
// ->where('content_timeframes.content_id', '=', $content->id)
// ->get();
//
		echo "<pre>"; var_dump($user); echo "</pre>";

		foreach ($user->languages as $value) {
			$value->language;
		}

		// foreach ($user->languages as $language) {
		//     echo $language;
		// }

		// foreach ($language_user as $key => $value) {
		// 	$value->language;
		// }

		echo "<pre>"; var_dump($user); echo "</pre>";
		// return;

		// echo count($language_user);
		return;

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

		$language = new LanguageUser();
		$language->user_id = Auth::user()->user_id;
		$language->language_id = $request->language_id;
		$language->save();


		return redirect()->route( 'all_language' )
						->with( [ 'status' => 'Se creo el idioma', 'type' => 'success' ] );

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
	public function destroy( $id )
	{

        $language = Language::where('id', '=', $id)
                        ->first()->delete();

        return redirect()->route('all_language')
                        ->with(['status' => 'Idioma eliminado con éxito', 'type' => 'success']);

	}


}
