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
	public function edit_beacon()
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

		$user = User::where([
									['id', '=', Auth::user()->id],
								])->first();

				$locations_id = Location::where('user_id', '=', Auth::user()->id)->first();

				//Location
				$beacons_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/beacons', [
						// un array con la data de los headers como tipo de peticion, etc.
						'headers' => ['Authorization' => 'Bearer '.$crud ],
						// array de datos del formulario
						'form_params' => [
								'name' => $request->name,
								'uuid' => $user->user_id,
								'major' => $request->major,
								'minor' => $request->minor,
						]
				]);
				//Json parse
				$json_c = $beacons_api->getBody();

				$beacon_response = json_decode($json_c);

				echo "<pre>"; var_dump($beacon_response); echo "</pre>";
				return;


				$beac = new Beacon;
				$beac->user_id = $user->user_id;
				$beac->beacon_id = $beacon_response->beacons[0]->id;
				$beac->name = $request->name;
				$beac->major = $request->major;
				$beac->minor = $request->minor;
				$beac->save();

				return redirect()->route('all_beacons')->with(['status' => 'El beacons ha sido registrado exitosamente', 'type' => 'success']);

	}

	/**
	 * check the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function check_beacon(Request $request)
	{
		$beacon = Beacon::where([
									['major', '=', $request->major],
									['minor', '=', $request->minor],
								])->first();

		// echo "<pre>"; var_dump($beacon); echo "</pre>";
		// return;
		if (!is_null($beacon)) {
			return 1;
		}

		return 0;

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


}
