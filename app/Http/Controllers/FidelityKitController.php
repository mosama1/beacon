<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\Promotion;
use Beacon\Content;
use Beacon\Coupon;
use Beacon\CouponTranslation;
use Beacon\Tag;
use Beacon\Timeframe;
use Beacon\User;
use Illuminate\Support\Facades\Input;
use Log;

class FidelityKitController extends Controller
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

		$json_fidelity_kit = $response_crud->getBody();

		$token_crud = json_decode($json_fidelity_kit);

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

	//************************************* Campaña **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$fidelity_kits = Promotion::where([
						['user_id', '=', $user->user_id],
						['type', '=', 2]
					])->get();

		return view( 'fidelity_kits.fidelity_kit', ['fidelity_kits' => $fidelity_kits, 'location' => $user->location] );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_fidelity_kit(Request $request)
	{
		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$location = $user->location;

		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = FidelityKitController::crud();

		//se obtiene la imagen
		$file_img = $request->file('img');

		if ( !is_null( $file_img ) ) {

			//mime de la imagen kit
			$kit_mime = $file_img->getMimeType();

			//path donde se almacenara la imagen
			$path = 'assets/images/fidelity_kit/';

			switch ($kit_mime)
			{
				case "image/jpeg":
				case "image/png":
					if ($file_img->isValid())
					{

						$nombre = $file_img->getClientOriginalName();
											$nombre = date('dmyhis').'-'.$nombre;

						$file_img->move($path, $nombre);

						$img = 'assets/images/fidelity_kit/'.$nombre;

					}
				break;
			}
		}
		else {
		 $img = "";
		}
		//Location
		$fidelity_kit_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				// array de datos del formulario
				'form_params' => [
						'name' => $request->name,
						'description' => $request->description,
						'start_time' => date('Y-m-d H:i', strtotime($request->start_time)),
						'end_time' => date('Y-m-d H:i', strtotime($request->end_time)),
						'locations' => $location->location_id,
						'enabled' => 1,
				]
		]);

		//Json parse
		$json_fidelity_kit = $fidelity_kit_api->getBody();

		$fidelity_response = json_decode($json_fidelity_kit);


		if ($fidelity_response->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$fidelity_kit = new Promotion();
			$fidelity_kit->promotion_id = $fidelity_response->campaign->id;
			$fidelity_kit->user_id = $user->user_id;
			$fidelity_kit->name = $fidelity_response->campaign->name;
			(isset($fidelity_response->campaign->description)) ?
				$fidelity_kit->description = $fidelity_response->campaign->description :
				$fidelity_kit->description = "";
			(isset($fidelity_response->type)) ?
				$fidelity_kit->type = $request->type :
				$fidelity_kit->type = 2;
			$fidelity_kit->number_visits = $request->number_visits;
			$fidelity_kit->img = $img;
			$fidelity_kit->start_time = $fidelity_response->campaign->start_time;
			$fidelity_kit->end_time = $fidelity_response->campaign->end_time;
			$fidelity_kit->location_id = $location->location_id;
			$fidelity_kit->enabled = $fidelity_response->campaign->enabled;
			$fidelity_kit->save();

			return redirect()->route('all_fidelity_kit');

		else:

			// var_dump($promotion);
			// return;

			return redirect()->route('all_fidelity_kit')->with(['status' => 'Error al ingresar el kit de bienvenida', 'type' => 'error']);

		endif;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit_fidelity_kit($id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$location = $user->location;

		$promotion = Promotion::where([
								['user_id', '=', $user->user_id ],
								['promotion_id', '=', $id],
								['type', '=', 2]
							])->first();


		return view('fidelity_kits.fidelity_kit_edit', ['fidelity_kit' => $promotion, 'location' => $location]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_fidelity_kit(Request $request, $id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = FidelityKitController::crud();

		//Location
		$fidelity_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$id.'/update', [
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
		$json_c = $fidelity_api->getBody();

		$fidelity_response = json_decode($json_c);

		if ( $fidelity_response->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$fidelity_kit = Promotion::where([
									['user_id', '=', $user->user_id ],
									['promotion_id', '=', $id],
									['type', '=', 1]
								])->first();

			if ( !is_null( $file_img ) ) {

				//mime de la imagen kit
				$kit_mime = $file_img->getMimeType();

				//path donde se almacenara la imagen
				$path = 'assets/images/fidelity_kit/';

				switch ($kit_mime)
				{
					case "image/jpeg":
					case "image/png":
						if ($file_img->isValid())
						{

							$nombre = $file_img->getClientOriginalName();
												$nombre = date('dmyhis').'-'.$nombre;

							$file_img->move($path, $nombre);

							$img = 'assets/images/fidelity_kit/'.$nombre;

						}
					break;
				}
			}
			else {
			 $img = $fidelity_kit->img;
			}

								
			$fidelity->type = $request->type;
			//no se envia
			$fidelity->number_visits = $request->number_visits;
			$fidelity->img= $img;
			$fidelity->name = $fidelity_response->campaign->name;
			$fidelity->description = (isset($fidelity_response->campaign->description)) ?
					$fidelity_response->campaign->description :
					$fidelity->description;
			$fidelity->start_time = $fidelity_response->campaign->start_time;
			$fidelity->end_time = $fidelity_response->campaign->end_time;	

			return redirect()->route('all_fidelity_kit');

		else:

			return redirect()->route('add_promotion')->with(['status' => 'Error al ingresar la Promotion', 'type' => 'error']);

		endif;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy_fidelity_kit($promotion_id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = FidelityKitController::crud();

		$fidelity_kit_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$promotion_id.'/delete', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ]
		]);

		//Json parse
		$json_fidelity_kit = $fidelity_kit_api->getBody();

		$fidelity_response = json_decode($json_fidelity_kit);

		if ($fidelity_response->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$promotion =  Promotion::where([
									['user_id', '=', $user->user_id ],
									['promotion_id', '=', $promotion_id],
									['type', '=', 2]
								])->first();

			$promotion->delete();

			return redirect()->route('all_fidelity_kit')
					->with(['status' => 'Se ha Eliminado el kit de bienvenida con éxito', 'type' => 'success']);

		else:

			//echo "<pre>"; var_dump($fidelity_kit); echo "</pre>";

			return redirect()->route('all_fidelity_kit')->with(['status' => 'Error al eliminar el kit de bienvenida', 'type' => 'error']);

		endif;
	}

}
