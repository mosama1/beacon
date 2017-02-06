<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Beacon\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\Tag;
use Beacon\Coupon;
use Beacon\Timeframe;
use Beacon\Campana;
use Beacon\Content;
use Beacon\Beacon;
use Beacon\Section;
use Beacon\Menu;
use Beacon\Plate;
use Beacon\TypesPlates;
use Illuminate\Support\Facades\Input;
use Beacon\User;
use Log;

class LocationController extends Controller
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

	//************************************* LOCATION **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$locations = Location::where('user_id', '=', $user->user_id)->get();

		return view('locations.locations',['locations' => $locations]);
	}


		function uniqidReal($lenght = 20) {
			if (function_exists("random_bytes")) {
				$bytes = random_bytes(ceil($lenght / 2));
			} elseif (function_exists("openssl_random_pseudo_bytes")) {
				$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
			} else {
				throw new Exception("el sistema no dispone de funciones segura para critografia");
			}
			return substr(bin2hex($bytes), 0, $lenght);
		}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// Nuevo cliente con un url base
		$client = new Client();

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			// echo "<pre>"; var_dump($user); echo "</pre>";
			// return;

			if ( empty($user->user_id) ) {

				//Token Crud
				$crud = LocationController::crud();

				$user_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/uuids', [
						// un array con la data de los headers como tipo de peticion, etc.
						'headers' => ['Authorization' => 'Bearer '.$crud ],
						// array de datos del formulario
						'form_params' => [
								'name' => $user->name,
								//implementar clase Uuid oara generar el codigo del usuario
								'identifier' => $this->uniqidReal(32),
						]
				]);

				//Json parse
				$json_c = $user_api->getBody();

				$user_response = json_decode($json_c);

				// echo "<pre>"; var_dump($user_response); echo "</pre>";
				// return;

				if ($user_response->status_code === 200 ):
						$user->user_id = $user_response->uuid->id;
						$user->save();
				endif;
				//$user
			}

		//se obtiene el logo
		$imagen = $request->file('logo');

				if ( !is_null( $imagen ) ) {

			//mime del logo
			$logo_mime = $imagen->getMimeType();

			//path donde se almacenara el logo
			$path = 'assets/images/logos/';
			// $path = public_path().'/assets/images/logos/';

					// $path = '/home/demente/public_html/prueba/final/assets/images/logos/';


			switch ($logo_mime)
			{
				case "image/jpeg":
				case "image/png":
					if ($imagen->isValid())
					{

						$nombre = $imagen->getClientOriginalName();
											$nombre = date('dmyhis').'-'.$nombre;

						$imagen->move($path, $nombre);

						$logo = 'assets/images/logos/'.$nombre;

					}
				break;
			}
				}
				else {
				 $logo = "";
				}

		//Token Crud
		$crud = LocationController::crud();

		//Location
		$location__ = $client->post('https://connect.onyxbeacon.com/api/v2.5/locations', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				// array de datos del formulario
				'form_params' => [
						'name' => $request->name,
						'country' => 'ES',
						'city' => $request->city,
						'zip' => $request->zip,
						'street' => $request->street,
						'street_number' => $request->street_number,
						'floor' => ' ',
						'timezone' => 'Europe/Madrid',
						'lat' =>  0,
						'lng' =>  0
				]
		]);

		//Json parse
		$json_l = $location__->getBody();

		$locations = json_decode($json_l);


		if ($locations->status_code === 200):

			//tag
			$tag__ = $client->post('https://connect.onyxbeacon.com/api/v2.5/tags', [
					// un array con la data de los headers como tipo de peticion, etc.
					'headers' => ['Authorization' => 'Bearer '.$crud ],
					// array de datos del formulario
					'form_params' => [
							'name' => $request->name
					]
			]);

			//Json parse
			$json_t = $tag__->getBody();

			$tag = json_decode($json_t);


			$loca = new Location;
			$loca->location_id = $locations->location->id;
			$loca->user_id = $user->user_id;
			$loca->name = $locations->location->name;
			$loca->country = $locations->location->country;
			$loca->city = $locations->location->city;
			$loca->zip = $locations->location->zip;
			$loca->street = $locations->location->street;
			$loca->street_number = $locations->location->street_number;
			$loca->timezone = $locations->location->timezone;
			$loca->logo = $logo;
			$loca->lat =  0;
			$loca->lng =  0;
			$loca->save();

			$tag_ = new Tag;
			// $tag_->tag_id = $tag->tag->id;
			// $tag_->location_id = $locations->location->id;
			// $tag_->user_id = $user->user_id;
			// $tag_->name = $tag->tag->name;
			// $tag_->save();

			return redirect()->route('user_edit_path', $user->user_id)->with(['status' => 'Se ha almacenado la localidad exitosamente', 'type' => 'success']);

		else:

			return redirect()->route('user_edit_path', $user->user_id)->with(['status' => 'Error al ingresar la localidad', 'type' => 'error']);

		endif;

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit_location($id)
	{
		//consulta

		$location = Location::where('location_id', '=', $id)->first();


		return view('locations.location_edit', ['location' => $location]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_location(Request $request, $id)
	{
		// Nuevo cliente con un url base
		$client = new Client();


		if ( empty( $request->file('logo') ) ) {
			$logo = null;

		} else {
			//se obtiene el logo
			$imagen = $request->file('logo');

			//mime del logo
			$logo_mime = $imagen->getMimeType();

			//path donde se almacenara el logo
			$path = 'assets/images/logos/';
					// $path = '/home/demente/public_html/prueba/final/assets/images/logos/';


			switch ($logo_mime)
			{
				case "image/jpeg":
				case "image/png":
					if ($imagen->isValid())
					{

										$nombre = $id.$imagen->getClientOriginalName();
										$nombre = date('dmyhis').'-'.$nombre;

						$imagen->move($path, $nombre);

						$logo = 'assets/images/logos/'.$nombre;

					}
				break;
			}
		}

		//Token Crud
		$crud = LocationController::crud();

		//Location
		$location_edit = $client->post('https://connect.onyxbeacon.com/api/v2.5/locations/'.$id.'/update', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				// array de datos del formulario
				'form_params' => [
						'name' => $request->name,
						'city' => $request->city,
						'zip' => $request->zip,
						'street' => $request->street,
						'street_number' => $request->street_number,
						'lat' =>  $request->lat,
						'lng' =>  $request->lng
				]
		]);

		//Json parse
		$json_l = $location_edit->getBody();

		$locations = json_decode($json_l);

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		if ($locations->status_code === 200):

			$loca = Location::where('location_id', '=', $id)->first();

			$loca->name = $locations->location->name;
			$loca->city = $locations->location->city;
			$loca->zip = $locations->location->zip;
			$loca->street = $locations->location->street;
			$loca->street_number = $locations->location->street_number;
			(is_null($logo)) ?
				$loca->logo :
				$loca->logo = $logo;
			// $loca->lat => $locations->location->lat,
			// $loca->lng =>  $locations->location->lng
			$loca->update();

			return redirect()->route('user_edit_path', $user->user_id)->with(['status' => 'Se edito la ubicacion con exito', 'type' => 'success']);

		else:

			return redirect()->route('user_edit_path', $user->user_id)->with(['status' => 'Error al editar la ubicacion', 'type' => 'error']);

		endif;

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($location_id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = LocationController::crud();

		//Location delete
		$location_delete = $client->post('https://connect.onyxbeacon.com/api/v2.5/locations/'.$location_id.'/delete', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
		]);

		//Json parse
		$json_ld = $location_delete->getBody();

		$location_delete = json_decode($json_ld);

		if ($location_delete->status_code === 200):

			$location =  Location::where('location_id', '=', $location_id);

			$location->delete();

			return redirect()->route('user_edit_path')
							 ->with(['status' => 'Se ha Eliminado la Locación con éxito', 'type' => 'success']);

		else:

			return redirect()->route('user_edit_path')
							->with(['status' => 'Error al eliminar la Locación', 'type' => 'error']);

		endif;

	}

}
