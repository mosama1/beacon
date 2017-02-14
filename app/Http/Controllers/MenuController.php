<?php

namespace Beacon\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Beacon\Menu;
use Beacon\MenuTranslation;
use Beacon\Section;
use Beacon\TypesPlates;
use Beacon\User;
use Beacon\Http\Controllers\UserController;

class MenuController extends Controller
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

	/**
	 * Display a listing of the resource.
	 *
	 * @param  Integer $section_id
	 * @return \Illuminate\Http\Response
	 */
	public function index($section_id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$type_plates = TypesPlates::where([
		   [ 'user_id', '=', $user->user_id ],
		   ['language_id', '=', 1],
		])->orderBy('name', 'asc')->get();

		$menu = new Menu;

		$menus = $menu->where([
			['section_id', '=', $section_id],
		])->get();

		foreach ($menus as $key => $menu) {
			$menu->menu_translation;
			foreach ($type_plates as $key => $type) {
				if ($menu->type == $type->id ) {
					$menu->type = $type->name;
				}
			}
		}

		$section = Section::where('id', '=', $section_id)->first();
		$section->coupon();

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

		return view('menus.plates',['menus' => $menus,'type_plates' => $type_plates, 'section_id' => $section_id, 'coupon' => $section->coupon, 'section' => $section, 'languages' => $languages]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_menu($section_id, $menu_id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$type_plates = TypesPlates::where([
		   [ 'user_id', '=', $user->user_id ],
		   [ 'language_id', '=', 1 ],
		])->get();

		$menu = new Menu;

		$menus = $menu->where([
			['user_id', '=', $user->user_id],
			['section_id', '=', $section_id]
		])->get();

		foreach ($menus as $key => $menu) {
			$menu->menu_translation;
			foreach ($type_plates as $key => $tipo) {
				if ($menu->type == $tipo->id ) {
					$menu->type = $tipo->name;
				}
			}
		}

		$section = Section::where('id', '=', $section_id)->first();
		$section->coupon();

		return view('menus.plates',
					[
						'menus' => $menus,
						'type_plates' => $type_plates,
						'section_id' => $section_id,
						'coupon' => $section->coupon
					]);
	}

	//************************************* Plato Cliente **************************************************//
	// /**
	//  * Display a listing of the resource.
	//  *
	//  * @return \Illuminate\Http\Response
	//  */
	// public function show_menu($section_id)
	// {

	//	$user = User::where( 'id', '=', Auth::user()->id )->first();
	// 	$plates = Menu::where([
	// 					['user_id', '=', $user->user_id],
	// 					['section_id', '=', $section_id]
	// 				])->get();
	// 	$sections = Section::all(Auth::user()->id);

	// 	return view('movil.plates', ['plates' => $plates, 'sections' => $sections]);
	// }

	/**
	 * Show view to edit a stored resource
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
		 public function store_menu(Request $request)
		{

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$menu = new Menu();
			$menu->section_id = $request->section_id;
			$menu->coupon_id = $request->coupon_id;
			$menu->user_id = $user->user_id;

			$menu->type = $request->type;
			$menu->status = 1;
			if ( empty($request->price) )
				$menu->price = 0;
			else
				$menu->price = $request->price;
			$menu->save();


			$menu_translation = new MenuTranslation();
			$menu_translation->menu_id = $menu->id;
			$menu_translation->language_id = 1;
			$menu_translation->coupon_id = $request->coupon_id;
			$menu_translation->name = $request->name;
			$menu_translation->save();


			for ($i=0; $i < count($request->language_id); $i++) {
				if ( !empty($request->language_name[$i]) ) {
					$menu_translation = new MenuTranslation();
					$menu_translation->name = $request->language_name[$i];
					$menu_translation->language_id = $request->language_id[$i];
					$menu_translation->menu_id = $menu->id;
					$menu_translation->coupon_id = $request->coupon_id;

					$menu_translation->save();
				}
			}

			return redirect()->route('all_menu', $menu->section_id)->with(['status' => 'Se creo el plato', 'type' => 'success']);
		}

	/**
	 * Show view to edit a stored resource
	 *
	 * @param  Integer $menu_id
	 * @return \Illuminate\Http\Response
	 */
	public function edit_menu($menu_id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$menu = Menu::where([
		   ['id', '=', $menu_id],
		])->first();

		$type_plates = TypesPlates::where([
		   [ 'user_id', '=', $user->user_id ],
		   ['language_id', '=', 1],
		])->get();

		$section = Section::where('id', '=', $menu->section_id)->first();


		return view('menus.plate_edit', ['type_plates' => $type_plates, 'menu' => $menu, 'section' => $section]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_menu(Request $request, $id)
	{

		$menu = Menu::find($id);
		$menu->type = $request->type;
		$menu->price = $request->price;
		$menu->save();

		$menu_translation = MenuTranslation::where([
										['menu_id', '=', $menu->id],
										['language_id', '=', 1]
									])->first();
		$menu_translation->name = $request->name;
		$menu_translation->save();

		for ($i=0; $i < count($request->language_id); $i++) {
			// $section_translation = new SectionTranslation();
			$menu_translation = MenuTranslation::where( [
														['menu_id', '=', $menu->id],
														['language_id', '=', $request->language_id[$i]]
													])->first();
			$menu_translation->name = $request->language_name[$i];
			$menu_translation->save();
		}


		return redirect()->route('all_menu', $menu->section_id)->with(['status' => 'Se ha actualizado el plato', 'type' => 'success']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy_menu($id)
	{

		$menu =  Menu::find($id);
		$section_id = $menu->section_id;
		$menu->delete();

		if($menu):

			return redirect()->route('all_menu', $section_id )
						->with(['status' => 'Plato eliminado con éxito', 'type' => 'success']);

		else:

			return redirect()->route('all_menu', $section_id )
						->with(['status' => 'Error al eliminar plato', 'type' => 'error']);


		endif;
	}

	public function habilitar_menu($id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$location = $user->location;

		$menu = Menu::where([
								['user_id', '=', $user->user_id ],
								['id', '=', $id]
							])->first();

		$status = ( $menu->status == 0 ) ? 1 : 0;
		$menu->status = $status;
		$menu->save();

		return $status;
	}



}
