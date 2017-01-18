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
use Beacon\Session;
use Beacon\Menu;
use Beacon\Plate;
use Beacon\TypesPlates;
use Illuminate\Support\Facades\Input;
use Beacon\User;

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

			$beacons = Beacon::where('beacon_id', '=', $beacon_->beacons[0]->id)->first();

			if (!$beacons):

				$locations_id = Location::where('user_id', '=', Auth::user()->id)->first();

				//Location
				$beacons_location = $client->post('https://connect.onyxbeacon.com/api/v2.5/beacons/'.$beacon_->beacons[0]->id.'/update', [
						// un array con la data de los headers como tipo de peticion, etc.
						'headers' => ['Authorization' => 'Bearer '.$crud ],
						// array de datos del formulario
						'form_params' => [
								'location' => '3987'
						]
				]);

				$beac = new Beacon();
				$beac->beacon_id = $beacon_->beacons[0]->id;
				$beac->user_id = Auth::user()->id;
				$beac->name = $beacon_->beacons[0]->name;
				$beac->major = $beacon_->beacons[0]->major;
				$beac->minor = $beacon_->beacons[0]->minor;
				$beac->save();

				return redirect()->route('list_beacons');

			else:

				return redirect()->route('edit_beacon')->with(['status' => 'El beacons ya esta registrado', 'type' => 'error']);

			endif;

		else:

			return redirect()->route('edit_beacon')->with(['status' => 'El beacons no existe', 'type' => 'error']);

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
    					'lng' =>  $request->lng
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
	    	$loca->lat =  $locations->location->lat;
	    	$loca->lng =  $locations->location->lng;
	    	$loca->save();

	    	$tag_ = new Tag;
	    	$tag_->tag_id = $tag->tag->id;
	    	$tag_->location_id = $locations->location->id;
	    	$tag_->user_id = Auth::user()->id;
	    	$tag_->name = $tag->tag->name;
	    	$tag_->save();

	    	return redirect()->route('user_edit_path', Auth::user()->id);

    	else:

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

    	$coupon = Coupon::whereRaw('user_id = ? ', array(Auth::user()->id))->get();

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
	    	$cou->name = $coupon->coupon->name;
	    	$cou->description = $coupon->coupon->description;
	    	$cou->message = $coupon->coupon->message;
	    	$cou->type = $coupon->coupon->type;
	    	$cou->url = $coupon->coupon->url;
	    	$cou->save();

	    	return redirect()->route('show_coupon', $request->session_id)->with(['status' => 'El menu se registro con exito', 'type' => 'success']);

    	else:

    		return redirect()->route('show_coupon', $request->session_id)->with(['status' => 'Error al ingresar el coupon', 'type' => 'error']);

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
    		$time->description = $timeframe->timeframe->description;
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
    public function update_timeframe(Request $request, $id)
    {
    	// Nuevo cliente con un url base
    	$client = new Client();

    	//Token Crud
    	$crud = BeaconController::crud();

    	//Location
    	$timeframe_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/timeframes/'.$id.'/update ', [
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

    	$timeframe = json_decode($json_t);


    	if ($timeframe->status_code === 200):

	    	$timeframe = Timeframe::where('timeframe_id', '=', $id)
											    	->update(array(
											    			'name' => $timeframe->timeframe->name,
											    			'description' => $timeframe->timeframe->description,
											    			'start_time' => $timeframe->timeframe->start_time,
											    			'end_time' => $timeframe->timeframe->end_time
											    	));

			return redirect()->route('show_timeframe');

    	else:

    		return redirect()->route('edit_timeframe', $id)->with(['status' => 'Error al editar el timeframe', 'type' => 'error']);

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_campana()
    {

    	$locations = DB::table('locations')
							    	->select('location_id', 'name')
							    	->where('user_id', '=', Auth::user()->id)
							    	->get();

    	return view('beacons.campana_add', ['locations' => $locations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_campana(Request $request)
    {
    	// Nuevo cliente con un url base
    	$client = new Client();

    	//Token Crud
    	$crud = BeaconController::crud();

    	//Location
    	$campana_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns', [
    			// un array con la data de los headers como tipo de peticion, etc.
    			'headers' => ['Authorization' => 'Bearer '.$crud ],
    			// array de datos del formulario
    			'form_params' => [
    					'name' => $request->name,
    					'description' => $request->description,
    					'start_time' => '2017-01-01 00:00',
    					'end_time' => '2022-01-01 00:00',
    					'locations' => $request->location_id,
    					'enabled' => '1',
    			]
    	]);

    	//Json parse
    	$json_c = $campana_->getBody();

    	$campana = json_decode($json_c);

		if ($campana->status_code === 200 ):

	    	$cam = new Campana();
	    	$cam->campana_id = $campana->campaign->id;
	    	$cam->user_id = Auth::user()->id;
	    	$cam->name = $campana->campaign->name;
	    	$cam->description = $campana->campaign->description;
	    	$cam->start_time = $campana->campaign->start_time;
	    	$cam->end_time = $campana->campaign->end_time;
	    	$cam->location = $request->location_id;
	    	$cam->enabled = $campana->campaign->enabled;
	    	$cam->save();

	    	return redirect()->route('show_campana');

    	else:

    		return redirect()->route('add_campana')->with(['status' => 'Error al ingresar la Campana', 'type' => 'error']);

    	endif;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_campana($id)
    {
    	//consulta

    	$campana = Campana::where('campana_id', '=', $id)->first();


    	return view('beacons.campana_edit', ['campana' => $campana]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_campana(Request $request, $id)
    {
    	// Nuevo cliente con un url base
    	$client = new Client();

    	//Token Crud
    	$crud = BeaconController::crud();

    	//Location
    	$campana_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$id.'/update', [
    			// un array con la data de los headers como tipo de peticion, etc.
    			'headers' => ['Authorization' => 'Bearer '.$crud ],
    			// array de datos del formulario
    			'form_params' => [
    					'name' => $request->name,
    					'description' => $request->description,
    					'start_time' => date("Y-m-d H:i", strtotime($request->start_time)),
    					'end_time' => date("Y-m-d H:i", strtotime($request->end_time)),
    			]
    	]);

    	//Json parse
    	$json_c = $campana_->getBody();

    	$campana = json_decode($json_c);

    	if ($campana->status_code === 200 ):

	    	$campana = Campana::where('campana_id', '=', $id)
												    	->update(array(
												    			'name' => $campana->campaign->name,
												    			'description' => $campana->campaign->description,
												    			'start_time' => $campana->campaign->start_time,
												    			'end_time' => $campana->campaign->end_time,
												    	));

    		return redirect()->route('show_campana');

    	else:

    		return redirect()->route('add_campana')->with(['status' => 'Error al ingresar la Campana', 'type' => 'error']);

    	endif;

    }

    //************************************* Campaña Contenido **************************************************//

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_campana_content($id)
    {

    	$coupon = Coupon::where('user_id', '=', Auth::user()->id)->get();

    	$tags = Tag::where('user_id', '=', Auth::user()->id)->get();

    	$timeframes = Timeframe::where('user_id', '=', Auth::user()->id)->get();

    	return view('beacons.campana_contenido',[
    												'coupon' => $coupon,
    												'tags' => $tags,
    												'timeframes' => $timeframes,
    												'campana_id' => $id
    											]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_campana_content(Request $request, $id)
    {
    	// Nuevo cliente con un url base
    	$client = new Client();

    	//Token Crud
    	$crud = BeaconController::crud();

    	//Location
    	$campana_content = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$id.'/contents', [
    			// un array con la data de los headers como tipo de peticion, etc.
    			'headers' => ['Authorization' => 'Bearer '.$crud ],
    			// array de datos del formulario
    			'form_params' => [
    					'coupon' => $request->coupon_id,
    					'tag' => 'ALL',
    					'timeframes' => $request->timeframe_id,
    					'trigger_name' => $request->tigger_name_id,
    					'trigger_entity' => 'tag'
    			]
    	]);

    	//Json parse
    	$json_c = $campana_content->getBody();

    	$campana_c = json_decode($json_c);

    	$content_id = substr($campana_content->getBody(),168, 5);

    	if ($campana_c->status_code === 200 ):

	    	$cam_c = new Content();
	    	$cam_c->content_id = $content_id;
	    	$cam_c->user_id = Auth::user()->id;
	    	$cam_c->coupon = $request->coupon_id;
	    	$cam_c->tag = $request->tag_id;
	    	$cam_c->timeframes = $request->timeframe_id;
	    	$cam_c->trigger_name = $request->tigger_name_id;
	    	$cam_c->save();

	    	return redirect()->route('show_campana');

    	else:

    		return redirect()->route('show_campana_content', $id)->with(['status' => 'Error al ingresar la Campana', 'type' => 'error']);

    	endif;

    }

    //************************************* Session Menu **************************************************//
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_session(Request $request)
    {

    	$session = new Session();
    	$session->user_id = Auth::user()->id;
    	$session->coupon_id = $request->coupon_id;
    	$session->name = $request->name;
    	$session->save();


    	return redirect()->route('show_session', $request->coupon_id)->with(['status' => 'Se ingreso Session de Menu con exito', 'type' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_session(Request $request)
    {


    	$session =  Session::find($request->id);

    	$session->delete();

	    if($session):

	    	return 1;

    	else:

    		return 0;

    	endif;

    }


    //************************************* Plato Menu **************************************************//
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_session($id)
    {
    	$sessions = Session::whereRaw('user_id = ? and coupon_id = ?', array(Auth::user()->id, $id))->get();

    	return view('menus.home', ['sessions' => $sessions, 'coupon_id' => $id]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_menu($id)
    {
    	$menus = Menu::whereRaw('user_id = ? and session_id = ?', array(Auth::user()->id, $id))->get();

    	return view('menus.plato',['menus' => $menus , 'session_id' => $id]);

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
    	$menu->session_id = $request->session_id;
    	$menu->user_id = Auth::user()->id;
    	$menu->name = $request->name;
    	$menu->type = $request->type;
    	$menu->price = $request->price;
    	$menu->save();


    	return redirect()->route('show_menu', $menu->session_id)->with(['status' => 'Se creo el plato', 'type' => 'success']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_plate($id)
    {
    	$plate = Plate::whereRaw('user_id = ? and menu_id = ?', array(Auth::user()->id, $id))->first();

    	if ($plate):
    		return view('menus.detailPlato',['plate' => $plate , 'menu_id' => $id]);
    	else:
    		return view('menus.addPlato',['menu_id' => $id]);
    	endif;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_plate(Request $request)
    {

    	//Obtengo el nombre del documento
    	$file_logo = Input::file('plato');
    	$name_logo = $file_logo->getClientOriginalName();

    	 //Ruta donde se va a guardar la img
    	 $storage_logo = 'img/platos';

    	 // Muevo el docuemnto a la ruta
    	 $file_logo = $file_logo->move($storage_logo, $name_logo);

    	$menu = new Plate();
    	$menu->menu_id = $request->menu_id;
    	$menu->user_id = Auth::user()->id;
    	$menu->description = $request->description;
    	$menu->img = $name_logo;
    	$menu->save();


    	return redirect()->route('show_menu', $request->menu_id)->with(['status' => 'Se creo la descripcion del plato', 'type' => 'success']);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_plate(Request $request, $id)
    {


    	$plate = Plate::whereRaw('user_id = ? and menu_id = ?', array(Auth::user()->id, $id))
												    	->update(array(
												    			'description' => $request->description,
												    	));


    	return redirect()->route('show_menu', $id)->with(['status' => 'Se edito descripcion de plato', 'type' => 'success']);


    }

    //************************************* Plato Cliente **************************************************//
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPlate($id)
    {
    	$plates = Menu::whereRaw('session_id = ? ', array($id))->get();

    	return view('clientes.plates', ['plates' => $plates]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDescPlate($id)
    {
    	$plate = Plate::whereRaw('menu_id = ? ', array($id))->first();

    	$plateName = Menu::whereRaw('id = ? ', array($id))->first();

    	return view('clientes.detailPlato', ['plate' => $plate, 'name' => $plateName]);
    }


}
