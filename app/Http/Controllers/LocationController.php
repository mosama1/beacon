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

        //se obtiene el logo
        $imagen = $request->file('logo');

        //mime del logo
        $logo_mime = $imagen->getMimeType();

        //path donde se almacenara el logo
        $path = public_path().'\assets\images\\';

        switch ($logo_mime)
        {
            case "image/jpeg":
            case "image/png":
                if ($imagen->isValid())
                {

                    $nombre = $imagen->getClientOriginalName();

                    $imagen->move($path, $nombre);

                    $logo = 'assets\images\\'.$nombre;
                    
                }
            break;
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
	    	$loca->user_id = Auth::user()->id;
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

/*	    	$tag_ = new Tag;
	    	$tag_->tag_id = $tag->tag->id;
	    	$tag_->location_id = $locations->location->id;
	    	$tag_->user_id = Auth::user()->id;
	    	$tag_->name = $tag->tag->name;
	    	$tag_->save();
*/
	    	return redirect()->route('user_edit_path', Auth::user()->id);

    	else:
            var_dump($locations);
        return;

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

        //se obtiene el logo
        $imagen = $request->file('logo');

        //mime del logo
        $logo_mime = $imagen->getMimeType();

        //path donde se almacenara el logo
        $path = public_path().'\assets\images\\';

        switch ($logo_mime)
        {
            case "image/jpeg":
            case "image/png":
                if ($imagen->isValid())
                {

                    $nombre = $id.$imagen->getClientOriginalName();

                    $imagen->move($path, $nombre);

                    $logo = 'assets\images\\'.$nombre;
                    
                }
            break;
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


    	if ($locations->status_code === 200):

	    	$loca = Location::where('location_id', '=', $id)
					->update(array(
									'name' => $locations->location->name,
							    	'city' => $locations->location->city,
							    	'zip' => $locations->location->zip,
							    	'street' => $locations->location->street,
                                    'street_number' => $locations->location->street_number,
                                    'logo' => $logo,
							    	// 'lat' => $locations->location->lat,
							    	// 'lng' =>  $locations->location->lng
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
