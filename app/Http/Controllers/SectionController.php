<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;
use Beacon\Menu;
use Beacon\Section;
use Beacon\SectionTranslation;
use Beacon\User;

class SectionController extends Controller
{


	/**
	 * @return token analytics
	 */
	public function analytics()
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token analytics
		$response_analytics = $client->request('POST', 'https://connect.onyxbeacon.com/oauth/client', [
				'form_params' => [
						'client_id' => '89b88a5f9eaec9ab9b059a56c51e37413be4e043',
						'client_secret' => '7e58c94dafd3751f90b0e4b4de871be7e8b7ae44',
						'scope' => 'analytics'
				]
		]);

		$json_a = $response_analytics->getBody();

		$token_analytics = json_decode($json_a);

		return $token_analytics->access_token;
	}

	//************************************* Section Menu **************************************************//

	public function index($coupon_id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$sections = Section::where([
			['user_id', '=', $user->user_id],
			['coupon_id', '=', $coupon_id]
		])->get();

		foreach ($sections as $key => $section) {
			$section->section_translation;
		}

		$languages = DB::table('languages')
		->join('language_users', 'languages.id', '=', 'language_users.language_id')
		->join('users', 'users.user_id', '=', 'language_users.user_id')
		->select('languages.*')
		->where([
			['language_users.user_id', '=', Auth::user()->user_id],
			['language_users.status', '=', 1],
			['languages.id', '!=', 1],
		])
		->orderBy('name')->get();

		return view('sections.sections', ['sections' => $sections, 'coupon_id' => $coupon_id, 'languages' => $languages]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_section(Request $request)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$section = new Section();
		$section->user_id = $user->user_id;
		$section->coupon_id = $request->coupon_id;
		(isset($request->price)) ?
				$section->price = intval($request->price) :
				$section->price = 0;
		$section->status = 1;
		$section->save();

		$section_translation = new SectionTranslation();
		$section_translation->section_id = $section->id;
		$section_translation->language_id = 1;
		$section_translation->coupon_id = $request->coupon_id;
		$section_translation->name = $request->name;
		$section_translation->coupon_id = $request->coupon_id;
		$section_translation->save();

		for ($i=0; $i < count($request->language_id); $i++) {
			// if ( !empty($request->language_name[$i]) ) {
				$section_translation = new SectionTranslation();
				$section_translation->name = (empty($request->language_name[$i]))
					? $request->name
					: $request->language_name[$i];
				$section_translation->language_id = $request->language_id[$i];
				$section_translation->section_id = $section->id;
				$section_translation->coupon_id = $request->coupon_id;

				$section_translation->save();
			// }
		}

		return redirect()->route('all_section', $request->coupon_id)->with(['status' => 'Se ingreso Section de Menu con exito', 'type' => 'success']);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit_section($id)
	{
		//consulta

		$section = Section::find($id);
		$section->section_translation;
		// echo "<pre>";  var_dump($section->price); echo "</pre>";
		// return;

		return view('sections.section_edit', ['section' => $section, 'coupon_id' => $section->coupon_id]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_section(Request $request, $section_id)
	{

		// for ($i=0; $i < count($request->language_ids); $i++) {
		// 	echo $request->language_ids[$i], '<br>';
		// 	echo $request->language_name[$i], '<br>';
		// 	echo '<br><br><br>';
		//
		// }
		// return;

		$section = Section::find($section_id);
		$section->price = intval($request->price);
		$section->save();

		$section_translation = SectionTranslation::where( [
													['section_id', '=', $section_id],
													['language_id', '=', $request->language_id]
												])->first();

		$section_translation->name = $request->name;
		$section_translation->language_id = $request->language_id;
		$section_translation->save();



		for ($i=0; $i < count($request->language_ids); $i++) {
			// $section_translation = new SectionTranslation();
			$section_translation = SectionTranslation::where( [
														['section_id', '=', $section_id],
														['language_id', '=', $request->language_ids[$i]]
													])->first();
			$section_translation->name = $request->language_name[$i];
			$section_translation->save();
		}
		return redirect()->route('all_section', $request->coupon_id )
				->with(['status' => 'Se actualizó la seccion con exito', 'type' => 'success']);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy_section($id)
	{

		$section =  Section::find($id);

		$coupon = $section->coupon;

		// echo "<pre>"; var_dump($section->coupon); echo "</pre>";
		// return;

		$section->delete();

		return redirect()->route('all_section', ['coupon_id' => $coupon->coupon_id])
				->with(['status' => 'Se ha eliminado la sección con éxito', 'type' => 'success']);

	}

	public function habilitar_section($id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$location = $user->location;

		$section = Section::where([
								['user_id', '=', $user->user_id ],
								['id', '=', $id]
							])->first();

		$status = ( $section->status == 0 ) ? 1 : 0;
		$section->status = $status;
		$section->save();

		return $status;
	}


}
