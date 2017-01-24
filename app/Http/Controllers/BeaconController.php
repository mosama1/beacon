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

				return redirect()->route('list_beacons');

			else:

				return redirect()->route('edit_beacon', $beac->beacon_id )->with(['status' => 'El beacons ya esta registrado', 'type' => 'error']);

			endif;

		else:

			return redirect()->route('list_beacons')->with(['status' => 'El beacons no existe', 'type' => 'error']);

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

				return redirect()->route('list_beacons');

			else:

				return redirect()->route('list_beacons')->with(['status' => 'El beacons ya esta registrado', 'type' => 'error']);

			endif;

		else:

			return redirect()->route('list_beacons')->with(['status' => 'El beacons no existe', 'type' => 'error']);

		endif;
	}

	//************************************* LOCATION **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$locations = Location::where('user_id', '=', Auth::user()->id)->get();

		return view('beacons.locations',['locations' => $locations]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create_location()
	{
		$locatiom = Location::where('user_id', '=', Auth::user()->id)->first();

		if ($locatiom):
			return redirect()->route('user_edit_path', Auth::user()->id);
		else:
			return view('beacons.location_add');
		endif;
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

		//Token Crud
		$crud = BeaconController::crud();

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
						'lat' =>  $request->lat,
						'lng' =>  $request->lng,
						'logo' =>  $request->logo
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
			$loca->user_id = Auth::user()->id;
			$loca->name = $locations->location->name;
			$loca->country = $locations->location->country;
			$loca->city = $locations->location->city;
			$loca->zip = $locations->location->zip;
			$loca->street = $locations->location->street;
			$loca->street_number = $locations->location->street_number;
			$loca->timezone = $locations->location->timezone;
			$loca->logo = $locations->location->logo;
			$loca->lat =  0;
			$loca->lng =  0;
			$loca->save();

/*	    	$tag_ = new Tag;
			$tag_->tag_id = $tag->tag->id;
			$tag_->location_id = $locations->location->id;
			$tag_->user_id = Auth::user()->id;
			$tag_->name = $tag->tag->name;
			$tag_->save();
*/
			return redirect()->route('user_edit_path', Auth::user()->id);

		else:
			//var_dump($locations);
			//return;

			return redirect()->route('location_add')->with(['status' => 'Error al ingresar la localidad', 'type' => 'error']);

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


		return view('beacons.location_edit', ['location' => $location]);
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

		//Token Crud
		$crud = BeaconController::crud();

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


		if ($locations->status_code === 200):

			$loca = Location::where('location_id', '=', $id)
					->update(array(
									'name' => $locations->location->name,
									'city' => $locations->location->city,
									'zip' => $locations->location->zip,
									'street' => $locations->location->street,
									'street_number' => $locations->location->street_number,
									'lat' => $locations->location->lat,
									'lng' =>  $locations->location->lng
								));

			return redirect()->route('user_edit_path', Auth::user()->id)->with(['status' => 'Se edito la ubicacion con exito', 'type' => 'success']);

		else:

			return redirect()->route('user_edit_path', Auth::user()->id)->with(['status' => 'Error al editar la ubicacion', 'type' => 'error']);

		endif;

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = BeaconController::crud();

		//Location delete
		$location_delete = $client->post('https://connect.onyxbeacon.com/api/v2.5/locations/'.$request->id.'/delete', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
		]);

		//Json parse
		$json_ld = $location_delete->getBody();

		$location_delete = json_decode($json_ld);

		if ($location_delete->status_code === 200):

			$location =  Location::where('location_id', '=', $request->id);

			$location->delete();

			return 1;

		else:

			return 0;

		endif;

	}

	//************************************* COUPON **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_coupon()
	{

		$coupon = Coupon::where('user_id', '=', Auth::user()->id)->get();

		return view('beacons.coupon', ['coupon' => $coupon]);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_coupon(Request $request)
	{


		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = BeaconController::crud();

		//Location
		$coupon_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				// array de datos del formulario
				'form_params' => [
						'name' => $request->name,
						'description' => $request->description,
						'message' => 'newMessage',
						'type' => 'url',
						'url' => 'google.com',
				]
		]);

		//Json parse
		$json_c = $coupon_->getBody();

		$coupon = json_decode($json_c);



		if ($coupon->status_code === 200 ):

			$cou = new Coupon();
			$cou->coupon_id = $coupon->coupon->id;
			$cou->user_id = Auth::user()->id;
			$cou->type = $coupon->coupon->type;
			(empty($request->price)) ?
				$cou->price = 0.0 :
				$cou->price = $request->price;
			$cou->url = $coupon->coupon->url;

			  // echo "<pre>"; var_dump($cou); echo "</pre>";
			  // return;

			$cou->save();


			$coupon_translation = new CouponTranslation();
			$coupon_translation->name = $coupon->coupon->name;
			(isset($coupon->coupon->description)) ?
				$coupon_translation->description = $coupon->coupon->description :
				$coupon_translation->description = "";

			$coupon_translation->message = $coupon->coupon->message;

			$coupon_translation->language_id = 1;
			$coupon_translation->coupon_id = $cou->id;
			$coupon_translation->save();

			return redirect()->route('show_coupon', $request->section_id)->with(['status' => 'El menu se registro con exito', 'type' => 'success']);

		else:

			return redirect()->route('show_coupon', $request->section_id)->with(['status' => 'Error al ingresar el coupon', 'type' => 'error']);

		endif;

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_coupon(Request $request, $coupon_id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = BeaconController::crud();

		//Location
		$coupon_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_id.'/update', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				// array de datos del formulario
				'form_params' => [
						'name' => $request->name,
						'description' => $request->description,
						'message' => 'newMessage',
						'type' => 'url',
						'url' => 'google.com',
				]
		]);

		//Json parse
		$json_c = $coupon_->getBody();

		$coupon = json_decode($json_c);

		if ($coupon->status_code === 200 ):


			$cou = Coupon::where([
								['coupon_id', '=', $coupon->coupon->id]
							])->first();


			$cou->type = $coupon->coupon->type;
			$cou->price = $request->price;
			$cou->url = $coupon->coupon->url;
			$cou->save();

			$coupon_translation = CouponTranslation::where([['coupon_id', '=', $cou->id]])->first();
			
			(isset($coupon->coupon->name)) ?
				$coupon_translation->name = $coupon->coupon->name :
				$coupon_translation->name = "";

			$coupon_translation->name = $coupon->coupon->name;
			(isset($coupon->coupon->description)) ?
				$coupon_translation->description = $coupon->coupon->description :
				$coupon_translation->description = "";

			$coupon_translation->message = $coupon->coupon->message;
			$coupon_translation->save();

			 // echo "<pre>"; var_dump($coupon_translation); echo "</pre>";
			 // return;

			return redirect()->route('show_coupon', $request->section_id)
							->with(['status' => 'El menu se ha actualizado con éxito', 'type' => 'success']);

		else:

			return redirect()->route('show_coupon', $request->section_id)
							->with(['status' => 'Error al actualizar el menu', 'type' => 'error']);

		endif;

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $coupon_id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy_coupon($coupon_id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = BeaconController::crud();

		//Timeframe delete
		$coupon_delete = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_id.'/delete', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
		]);

		//Json parse
		$json_ld = $coupon_delete->getBody();

		$coupon_delete = json_decode($json_ld);

		if ($coupon_delete->status_code === 200):

			$coupon =  Coupon::where([
								['user_id', '=', Auth::user()->id],
								['coupon_id', '=', $coupon_id]
							]);

			$coupon->delete();

        	return redirect()->route('show_coupon')
                        ->with(['status' => 'Menú eliminado con éxito', 'type' => 'success']);

		else:

        	return redirect()->route('show_coupon')
                        ->with(['status' => 'Error al eliminar Menú', 'type' => 'error']);

		endif;

	}

	//************************************* Timeframe **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_timeframe()
	{
		$timeframe = Timeframe::where('user_id', '=', Auth::user()->id)->get();

		return view('beacons.timeframe',['timeframe' => $timeframe]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create_timeframe()
	{
		return view('beacons.timeframe_add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_timeframe(Request $request)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = BeaconController::crud();

		//Location
		$timeframe_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/timeframes', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				// array de datos del formulario
				'form_params' => [
						'name' => $request->name,
						'description' => $request->description,
						'start_time' => date("H:i", strtotime($request->start_time)),
						'end_time' => date("H:i", strtotime($request->end_time)),
						'days' => 'all',
				]
		]);

		//Json parse
		$json_t = $timeframe_->getBody();

		$timeframe = json_decode($json_t);

		if ($timeframe->status_code === 200 ):

			$time = new Timeframe();
			$time->timeframe_id = $timeframe->timeframe->id;
			$time->user_id = Auth::user()->id;
			$time->name = $timeframe->timeframe->name;
			(isset($timeframe->timeframe->description)) ?
				$time->description = $timeframe->timeframe->description :
				$time->description = "";
			$time->start_time = $timeframe->timeframe->start_time;
			$time->end_time = $timeframe->timeframe->end_time;
			$time->days = $timeframe->timeframe->days;
			$time->save();

			return redirect()->route('show_timeframe');

		else:

			return redirect()->route('add_timeframe')->with(['status' => 'Error al ingresar el timeframe', 'type' => 'error']);

		endif;

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit_timeframe($id)
	{
		//consulta

		$timeframe = Timeframe::where('timeframe_id', '=', $id)->first();


		return view('beacons.timeframe_edit', ['timeframe' => $timeframe]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_timeframe(Request $request, $timeframe_id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = BeaconController::crud();

		//Location
		$timeframe_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/timeframes/'.$timeframe_id.'/update', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				// array de datos del formulario
				'form_params' => [
						'name' => $request->name,
						'description' => $request->description,
						'start_time' => date("H:i", strtotime($request->start_time)),
						'end_time' => date("H:i", strtotime($request->end_time)),
				]
		]);

		//Json parse
		$json_t = $timeframe_->getBody();

		$timeframe_j = json_decode($json_t);


		if ($timeframe_j->status_code === 200):

			$timeframe = Timeframe::where('timeframe_id', '=', $timeframe_id)->first();

			// echo "<pre>";var_dump($timeframe);echo "</pre>";
			// return;

			$timeframe->name = $timeframe_j->timeframe->name;
			(isset($timeframe_j->timeframe->description)) ?
			$timeframe->description = $timeframe_j->timeframe->description : 
			$timeframe->description = NULL ;
			$timeframe->start_time = $timeframe_j->timeframe->start_time;
			$timeframe->end_time = $timeframe_j->timeframe->end_time;
			$timeframe->save();

			return redirect()->route('show_timeframe')
							->with(['status' => 'Horario Actualizado exitosamente', 'type' => 'success']);

		else:

			return redirect()->route('edit_timeframe', $timeframe_id)
							->with(['status' => 'Error al editar el timeframe', 'type' => 'error']);

		endif;

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy_timeframe($timeframe_id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = BeaconController::crud();

		//Timeframe delete
		$timeframe_delete = $client->post('https://connect.onyxbeacon.com/api/v2.5/timeframes/'.$timeframe_id.'/delete', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
		]);

		//Json parse
		$json_ld = $timeframe_delete->getBody();

		$timeframe_delete = json_decode($json_ld);

		if ($timeframe_delete->status_code === 200):

			$timeframe =  Timeframe::where('timeframe_id', '=', $timeframe_id);

			$timeframe->delete();

	        return redirect()->route('show_timeframe')
	                        ->with(['status' => 'el horario ha sido eliminado con éxito', 'type' => 'success']);

		else:

	        return redirect()->route('show_timeframe')
	                        ->with(['status' => 'Error al eliminar horario', 'type' => 'error']);

		endif;

	}

	//************************************* Campaña **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_campana()
	{
		$campana = Campana::where('user_id', '=', Auth::user()->id)->get();

		return view('beacons.campana',['campana' => $campana]);
	}

	public function show_tipoPlato()
	{
		$tiposplatos = TypesPlates::get();

		return view('menus.tipoPlato',['tiposplatos' => $tiposplatos]);
	}

	/**
	 * Create a new resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function create_tipoPlato( Request $request )
	{

		$tipo_plato = new TypesPlates();
		$tipo_plato->name = $request->name;
		$tipo_plato->description = $request->description;
		$tipo_plato->language_id = 1;
		$tipo_plato->save();


		return redirect()->route( 'show_tipoPlato' )
						->with( [ 'status' => 'Se creo el tipo de plato', 'type' => 'success' ] );

	}

	/**
	 * edit a new resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function edit_tipoPlato( $id )
	{

		$tipo_plato = TypesPlates::where('id', '=', $id)->first();

		return view('menus.tipoPlatoEdit', ['tipo_plato' => $tipo_plato]);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_type_plate(Request $request, $type_plate_id)
	{

		$type_plate = TypesPlates::find($type_plate_id);

		$type_plate->name = $request->name;
		$type_plate->description = $request->description;
		//$type_plate->language_id = $request->language_id;
		$type_plate->language_id = 1;
		$type_plate->save();

		return redirect()->route('show_tipoPlato')
			->with(['status' => 'Se ha actualizado el tipo de plato satisfactoriamente', 'type' => 'success']);

	}

	/**
	 * Delete a resource in storage.
	 *
	 * @param  $id integer
	 * @return \Illuminate\Http\Response
	 */
	public function delete_tipoPlato( $id )
	{

		$tipo_plato = TypesPlates::where('id', '=', $id)
						->first()->delete();

		return redirect()->route('show_tipoPlato')
						->with(['status' => 'Tipo de plato eliminado con éxito', 'type' => 'success']);

	}

	public function show_tipoPlatoEdit()
	{
		// $campana = Campana::where('user_id', '=', Auth::user()->id)->get();

		return view('menus.tipoPlatoEdit');
	}

	public function show_language()
	{
		return view('menus.language');
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
	public function show_section($id)
	{
		$sections = Section::where(
							['user_id', '=', Auth::user()->id],
							['coupon_id', '=', $id]
						)->get();

		return view('menus.home', ['sections' => $sections, 'coupon_id' => $id]);
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
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showPlate($section_id)
	{
		$plates = Menu::where([
						['user_id', '=', Auth::user()->id],
						['section_id', '=', $section_id]
					])->get();
		$sections = Section::all();

		return view('clientes.plates', ['plates' => $plates, 'sections' => $sections]);
	}

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


	public function show_content()
    {
			$coupon = Coupon::where('user_id', '=', Auth::user()->id)->get();

			$tags = Tag::where('user_id', '=', Auth::user()->id)->get();

    	$timeframes = Timeframe::where('user_id', '=', Auth::user()->id)->get();

    	return view('coupons.detailContent',
					[
						'coupon' => $coupon,
						'tags' => $tags,
						'timeframes' => $timeframes,
						// 'campana_id' => $id
					]);

    }

	public function edit_coupon($coupon_id)
	{
		$coupon = Coupon::where([
							['user_id', '=', Auth::user()->id],
							['coupon_id', '=', $coupon_id]
						])->first();

		$coupon->coupon_translation;

		// echo "<pre>"; var_dump($coupon); echo "</pre>";
		// return;

		return view('beacons.coupon_edit', ['coupon' => $coupon] );
	}


}
