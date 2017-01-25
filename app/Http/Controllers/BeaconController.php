<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Beacon\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\Tag;
use Beacon\Coupon;
use Beacon\CouponTranslation;
use Beacon\Timeframe;
use Beacon\Campana;
use Beacon\Content;
use Beacon\Beacon;
use Beacon\Section;
use Beacon\Menu;
use Beacon\Plate;
use Beacon\PlateTranslation;
use Beacon\TypesPlates;
use Illuminate\Support\Facades\Input;
use Beacon\User;
use Log;

class BeaconController extends Controller
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

		Log::info('This is some useful information.');

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
	 * @return \Illuminate\Http\Response
	 */
	public function show()
	{
		$beacons = Beacon::where('user_id', '=', Auth::user()->id)->get();

		return view('beacons.beacons', ['beacons' => $beacons]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit()
	{
		return view('beacons.beacon_edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function store_beacon(Request $request)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = BeaconController::crud();

		//Beacons
		$beacon_update = $client->get('https://connect.onyxbeacon.com/api/v2.5/beacons?filter[major]='.$request->major.'&filter[minor]='.$request->minor.'', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
		]);

		//Json parse
		$json_b = $beacon_update->getBody();

		$beacon_ = json_decode($json_b);


		if ($beacon_->beacons):

			$beacons = Beacon::where([
									['user_id', '=', Auth::user()->id],
									['beacon_id', '=', $beacon_->beacons[0]->id]
								])->first();

			if (!$beacons):

				$locations_id = Location::where('user_id', '=', Auth::user()->id)->first();

				//Location
				$beacons_location = $client->post('https://connect.onyxbeacon.com/api/v2.5/beacons/'.$beacon_->beacons[0]->id.'/update', [
						// un array con la data de los headers como tipo de peticion, etc.
						'headers' => ['Authorization' => 'Bearer '.$crud ],
						// array de datos del formulario
						'form_params' => [
						//		'location' => '3987'
								'location' => ''
						]
				]);

				$beac = new BeaconController;
				$beac->beacon_id = $beacon_->beacons[0]->id;
				$beac->user_id = Auth::user()->id;
				$beac->name = $beacon_->beacons[0]->name;
				$beac->major = $beacon_->beacons[0]->major;
				$beac->minor = $beacon_->beacons[0]->minor;
				$beac->update();

				return redirect()->route('all_beacons');

			else:

				return redirect()->route('edit_beacon', $beac->beacon_id )->with(['status' => 'El beacons ya esta registrado', 'type' => 'error']);

			endif;

		else:

			return redirect()->route('all_beacons')->with(['status' => 'El beacons no existe', 'type' => 'error']);

		endif;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy_beacon(Request $request)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = BeaconController::crud();

		//Beacons
		$beacon_update = $client->get('https://connect.onyxbeacon.com/api/v2.5/beacons?filter[major]='.$request->major.'&filter[minor]='.$request->minor.'', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
		]);

		//Json parse
		$json_b = $beacon_update->getBody();

		$beacon_ = json_decode($json_b);


		if ($beacon_->beacons):

			$beacons = Beacon::where(
								['user_id', '=', Auth::user()->id],
								['beacon_id', '=', $beacon_->beacons[0]->id]
							)->first();

			if (!$beacons):

				$locations_id = Location::where('user_id', '=', Auth::user()->id)->first();

				//Location
				$beacons_location = $client->post('https://connect.onyxbeacon.com/api/v2.5/beacons/'.$beacon_->beacons[0]->id.'/update', [
						// un array con la data de los headers como tipo de peticion, etc.
						'headers' => ['Authorization' => 'Bearer '.$crud ],
						// array de datos del formulario
						'form_params' => [
		//						'location' => '3987'
								'location' => ''
						]
				]);

				$beacons->delete();

				return redirect()->route('all_beacons');

			else:

				return redirect()->route('all_beacons')->with(['status' => 'El beacons ya esta registrado', 'type' => 'error']);

			endif;

		else:

			return redirect()->route('all_beacons')->with(['status' => 'El beacons no existe', 'type' => 'error']);

		endif;
	}

	public function show_language()
	{
		$languages = Language::all()->get();

		return view('menus.language', ['languages' => $languages]);
	}

	public function show_languageEdit()
	{
		return view('menus.languageEdit');
	}


	//************************************* Plato Menu **************************************************//
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_section($coupon_id)
	{
		$sections = Section::where(
							['user_id', '=', Auth::user()->id],
							['coupon_id', '=', $coupon_id]
						)->get();

		return view('menus.home', ['sections' => $sections, 'coupon_id' => $coupon_id]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_menu($section_id, $id)
	{
		$menus = Menu::where(
						['user_id', '=', Auth::user()->id],
						['section_id', '=', $section_id]
					)->get();

		return view('menus.plato',['menus' => $menus , 'section_id' => $section_id]);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_menu(Request $request)
	{

		$menu = new Menu();
		$menu->section_id = $request->section_id;
		$menu->user_id = Auth::user()->id;
		$menu->name = $request->name;
		$menu->type = $request->type;
		$menu->price = $request->price;
		$menu->save();


		return redirect()->route('show_menu', $menu->section_id, $menu->id)
			->with(['status' => 'Se creo el plato', 'type' => 'success']);

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_plate($menu_id)
	{
		$plate = Plate::where([
							['menu_id', '=', $menu_id]
						])->first();
		if ($plate) {
			$plate->plate_translation;
		}

		$menu = Menu::where('id', '=', $menu_id)->first();

		if ($plate):
			return view('menus.detailPlato',['plate' => $plate , 'section_id' => $menu->section_id, 'menu_id' => $menu_id]);
		else:
			return view('menus.addPlato',['section_id' => $menu->section_id, 'menu_id' => $menu_id]);
		endif;

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_plate(Request $request, $menu_id)
	{

		//Obtengo el nombre del documento

		$menu = Menu::where([
						['user_id', '=', Auth::user()->id],
						['id', '=', $menu_id ]
					])->first()->get();

		$plate = new Plate();
		$plate->menu_id = $menu_id;
		$plate->type_plate_id = $menu[0]->type;
		$plate->user_id = Auth::user()->id;

		// se valida si esta seteada la variable de la imagen para ser actualizada
		$file_logo = Input::file('plato');
		if ( !empty($file_logo) ) {

			$name_logo = $file_logo->getClientOriginalName();
			$plate->img = $name_logo;
			//Ruta donde se va a guardar la img
			$storage_logo = 'assets/images/platos';

			// Muevo el docuemnto a la ruta
			$file_logo = $file_logo->move($storage_logo, $name_logo);
		}
		else{
			$location = Location::where( 'user_id', '=', Auth::user()->id )->first();

			$plate->img = $location->logo;
		}

		$plate->save();

		$plate_translation = new PlateTranslation();
		$plate_translation->description = $request->description;
		//	$plate_translation->language_id = $request->language_id;
		$plate_translation->language_id = 1;
		$plate_translation->plate_id = $plate->id;
		$plate_translation->save();

		$menu = Menu::where([
						['user_id', '=', Auth::user()->id],
						['id', '=', $menu_id]
					])->first();

		return redirect()->route('show_sectionMenus', ['section_id' => $menu->section_id])
			->with(['status' => 'Descripción del plato almacenada exitosamente', 'type' => 'success']);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_plate(Request $request, $menu_id)
	{

		$plate = Plate::where([
							['user_id', '=', Auth::user()->id],
							['menu_id', '=', $menu_id]
						])->first();

		// se valida si esta seteada la variable de la imagen para ser actualizada
		$file_logo = Input::file('plato');
		if ( !empty($file_logo) ) {

			$name_logo = $file_logo->getClientOriginalName();
			//Ruta donde se va a guardar la img
			$storage_logo = 'assets/images/platos';

			// Muevo el docuemnto a la ruta
			$file_logo = $file_logo->move($storage_logo, $name_logo);
			$plate->img = $storage_logo.'/'.$name_logo;
		}
		else{
			$location = Location::where( 'user_id', '=', Auth::user()->id )->first();

			$plate->img = $location->logo;
		}

		$tipo_platos = TypesPlates::where([
							['language_id', '=', 1]
						])->get();

		$plate->plate_translation;

		$plate->plate_translation->description = $request->description;
		$plate->plate_translation->save();

		$plate->save();

		$menu = Menu::where([
						['user_id', '=', Auth::user()->id],
						['id', '=', $menu_id]
					])->first();

		return redirect()->route('show_menu',
								[
									'section_id' => $menu->section_id,
									'menu_id' => $menu_id,
									'type_plates_names' => $tipo_platos
								])	
						->with(['status' => 'Se editó descripción de plato', 'type' => 'success']);

	}

	//************************************* Plato Cliente **************************************************//
	// /**
	//  * Display a listing of the resource.
	//  *
	//  * @return \Illuminate\Http\Response
	//  */
	// public function showPlate($section_id)
	// {
	// 	$plates = Menu::where([
	// 					['user_id', '=', Auth::user()->id],
	// 					['section_id', '=', $section_id]
	// 				])->get();
	// 	$sections = Section::all(Auth::user()->id);

	// 	return view('clientes.plates', ['plates' => $plates, 'sections' => $sections]);
	// }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showDescPlate($id)
	{
		$plate = Plate::where(
					['user_id', '=', Auth::user()->id],
					['menu_id', '=', $id]
				)->first();

		$plateName = Menu::where(
					['user_id', '=', Auth::user()->id],
					['id', '=', $id]
				)->first();

		$plateName->menu_translation;

		return view('clientes.detailPlato', ['plate' => $plate, 'name' => $plateName]);
	}

}
