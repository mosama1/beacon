<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Beacon\Tag;
use Beacon\User;
use Beacon\Menu;
use Beacon\Plate;
use Beacon\Beacon;
use Beacon\Coupon;
use Beacon\Section;
use Beacon\Content;
use Beacon\Campana;
use Beacon\Location;
use Beacon\Timeframe;
use Beacon\TypesPlates;
use Beacon\MadirajePhoto;
use Beacon\PlateTranslation;
use Beacon\CouponTranslation;

class PlateController extends Controller
{

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

		if ( $plate ) {
			$plate->plate_translation;
			$plate->madiraje_photo;
		}
		// return;

		$menu = Menu::where('id', '=', $menu_id)->first();

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
		// dd($menu->madirajes);

		if ( empty($plate) | empty($plate->plate_translation) ):
			return view('plates.add_plato',['section_id' => $menu->section_id, 'menu_id' => $menu_id, 'languages' => $languages]);
		else:

			return view('plates.detail_plato',['plate' => $plate , 'section_id' => $menu->section_id, 'menu_id' => $menu_id, 'madirajes' => $menu->madirajes  ]);
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
		$user = Auth::user();
		$menu = Menu::where([
						['user_id', '=', $user->user_id],
						['id', '=', $menu_id ]
					])->first();

		$coupon = Menu::where( 'id', '=', $request->menu_id )->first();

		$plate = new Plate();
		$plate->menu_id = $menu_id;
		$plate->coupon_id = $coupon->coupon_id;
		$plate->type_plate_id = $menu->type;
		$plate->user_id = $user->user_id;

		// se valida si esta seteada la variable de la imagen para ser actualizada
		$file_logo = Input::file('plato');
		if ( !empty($file_logo) ) {

			$name_logo = $file_logo->getClientOriginalName();
			$name_logo = date('dmyhis').'-'.$name_logo;

			//Ruta donde se va a guardar la img
			$storage_logo = 'assets/images/platos';

			// Muevo el docuemnto a la ruta
			$file_logo = $file_logo->move($storage_logo, $name_logo);
			$plate->img = $storage_logo.'/'.$name_logo;
		}
		$plate->save();

		// se valida si esta seteada la variable de la imagen del madiraje
		// y lo guardo en la tabla de madiraje_photo
		$file_madiraje = Input::file('img_madiraje');
		if ( !empty( $file_madiraje ) ) {

			if ( count( $file_madiraje ) > 3 ){ //si excede el maximo de fotos lo retorno

				return redirect()->route('all_menu')
					->with(['status' => 'Ha superado el máximo de fotos permitido (3 fotos máximo)', 'type' => 'error']);
			}

			foreach ($file_madiraje as $key => $value) {

				$name_madiraje = $value->getClientOriginalName();
				$name_madiraje = date('dmyhis').'-'.$name_madiraje;

				//Ruta donde se va a guardar la img
				$storage_madiraje = 'assets/images/madirajes';

				// Muevo el docuemnto a la ruta
				$value->move($storage_madiraje, $name_madiraje);
				$plate->img_madiraje = $storage_madiraje.'/'.$name_madiraje;

				//guardo en la tabla correpondiente
				$madiraje_photo = New MadirajePhoto();
				$madiraje_photo->plate_id = $plate->id;
				$madiraje_photo->img_madiraje = $storage_madiraje.'/'.$name_madiraje;
				$madiraje_photo->save();
			}
		}

		$plate_translation = new PlateTranslation();
		$plate_translation->description = $request->description;
		$plate_translation->madiraje = $request->madiraje;
		$plate_translation->coupon_id = $coupon->coupon_id;

		//$plate_translation->language_id = $request->language_id;
		$plate_translation->language_id = 1;
		$plate_translation->plate_id = $plate->id;
		$plate_translation->price_madiraje = $request->price_madiraje;
		$plate_translation->status = 1;
		$plate_translation->save();

		for ($i=0; $i < count($request->language_id); $i++) {
				$plate_translation = new PlateTranslation();
				$plate_translation->description = (empty($request->language_description[$i]))
					? $request->description
					: $request->language_description[$i];

				$plate_translation->madiraje = (empty($request->language_madiraje[$i]))
					? $request->madiraje
					: $request->language_madiraje[$i];

				$plate_translation->coupon_id = $coupon->coupon_id;

				//	$plate_translation->language_id = $request->language_id;
				$plate_translation->language_id = $request->language_id[$i];
				$plate_translation->plate_id = $plate->id;
				$plate_translation->price_madiraje = $request->price;
				$plate_translation->status = 1;
				$plate_translation->save();
		}

		$menu = Menu::where([
						['user_id', '=', $user->user_id],
						['id', '=', $menu_id]
					])->first();

		return redirect()->route('all_menu', ['section_id' => $menu->section_id])
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
							['user_id', '=', Auth::user()->user_id],
							['menu_id', '=', $menu_id],
						])->first();

			// se valida si esta seteada la variable de la imagen para ser actualizada
			$file_logo = Input::file('plato');
			if ( !empty($file_logo) ) {

				$name_logo = $file_logo->getClientOriginalName();
				$name_logo = date('dmyhis').'-'.$name_logo;

				//Ruta donde se va a guardar la img
				$storage_logo = 'assets/images/platos';

				// Muevo el docuemnto a la ruta
				$file_logo = $file_logo->move($storage_logo, $name_logo);
				$plate->img = $storage_logo.'/'.$name_logo;
			}
			// se valida si esta seteada la variable de la imagen del madiraje
			$file_madiraje = Input::file('img_madiraje');
			if ( count( $file_madiraje ) > 3 ){

				return redirect()->route('all_menu')
					->with(['status' => 'Ha superado el máximo de fotos permitido (3 fotos máximo)', 'type' => 'error']);
			}
			if ( !empty($file_madiraje) ) {

				$name_madiraje = $file_madiraje->getClientOriginalName();
				$name_madiraje = date('dmyhis').'-'.$name_madiraje;

				//Ruta donde se va a guardar la img
				$storage_madiraje = 'assets/images/madirajes';

				// Muevo el docuemnto a la ruta
				$file_madiraje = $file_madiraje->move($storage_madiraje, $name_madiraje);
				$plate->img_madiraje = $storage_madiraje.'/'.$name_madiraje;
			}
			$plate->save();

			$tipo_platos = TypesPlates::where([
								['language_id', '=', 1]
							])->get();

			$plate->plate_translation[0];
			$plate->plate_translation[0]->description = $request->description;
			$plate->plate_translation[0]->madiraje = $request->madiraje;
			$plate->plate_translation[0]->price_madiraje = $request->price_madiraje;
			$plate->plate_translation[0]->save();

			for ($i=0; $i < count($request->language_id); $i++) {
				// $plate->plate_translation;
				$plate_translation = PlateTranslation::where
									([
										['plate_id', '=', $plate->id],
										['language_id', '=', $request->language_id[$i]]
									])->first();

				$plate_translation->description = $request->language_description[$i];
				$plate_translation->madiraje = $request->language_madiraje[$i];
				$plate_translation->price_madiraje  = $request->price_madiraje;
				$plate_translation->save();
				// echo $plate_translation;
			}

			$menu = Menu::where([
							['user_id', '=', Auth::user()->user_id],
							['id', '=', $menu_id]
						])->first();

			return redirect()->route('all_menu',
									[
										'section_id' => $menu->section_id
									])
							->with(['status' => 'Se editó descripción de plato', 'type' => 'success', 'type_plates_names' => $tipo_platos]);

		}



}
