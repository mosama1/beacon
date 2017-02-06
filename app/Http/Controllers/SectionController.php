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
	 * @return token crud
	 */
	public function crud()
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$response_crud = $client->request('POST', 'https://connect.onyxbeacon.com/oauth/client', [
				'form_params' => [
						'client_id' => 'af1cd006576dc09b7cf7660d4e010fbf434ad4bf',
						'client_secret' => '335c77e0ff4a4d36b97e8464ef880cdef30fb795',
						'scope' => 'crud'
				]
		]);

		$json_c = $response_crud->getBody();

		$token_crud = json_decode($json_c);

		return $token_crud->access_token;
	}


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

		return view('sections.sections', ['sections' => $sections, 'coupon_id' => $coupon_id]);
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
		$section->price = $request->price;
		$section->save();

		$section_translation = new SectionTranslation();
		$section_translation->section_id = $section->id;
		$section_translation->language_id = 1;
		$section_translation->name = $request->name;
		

		$section_translation->save();

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

		$section_translation = SectionTranslation::where( [
													['section_id', '=', $section_id],
													['language_id', '=', $request->language_id]
												])->first();


		 // echo "<pre>";  var_dump($section_translation); echo "</pre>";
		 // return;

		$section_translation->name = $request->name;
		$section_translation->language_id = $request->language_id;
		$section_translation->save();

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

}
