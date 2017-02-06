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

class WelcomeKitController extends Controller
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

	//************************************* Campaña **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$welcome_kit = Promotion::where([
						['user_id', '=', $user->user_id],
						['type', '=', 1]
					])->get();

		return view( 'welcome_kits.welcome_kit', ['welcome_kit' => $welcome_kit, 'location' => $user->location] );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_welcome_kit(Request $request)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = PromotionController::crud();

		//se obtiene la imagen
		$file_img = $request->file('img');

		if ( !is_null( $file_img ) ) {

			//mime de la imagen kit
			$kit_mime = $file_img->getMimeType();

			//path donde se almacenara la imagen
			$path = 'assets/images/kit_welcome/';

			switch ($kit_mime)
			{
				case "image/jpeg":
				case "image/png":
					if ($file_img->isValid())
					{

						$nombre = $file_img->getClientOriginalName();
											$nombre = date('dmyhis').'-'.$nombre;

						$file_img->move($path, $nombre);

						$img = 'assets/images/kit_welcome/'.$nombre;

					}
				break;
			}
		}
		else {
		 $img = "";
		}
		//Location
		$welcome_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				// array de datos del formulario
				'form_params' => [
						'name' => $request->name,
						'description' => $request->description,
						'start_time' => date('Y-m-d H:i', strtotime($request->start_time)),
						'end_time' => date('Y-m-d H:i', strtotime($request->end_time)),
						'locations' => $request->location_id,
						'enabled' => 1,
				]
		]);

		//Json parse
		$json_welcome_kit = $welcome_api->getBody();

		$welcome_response = json_decode($json_welcome_kit);


		if ($welcome_response->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$welcome = new Promotion();
			$welcome->promotion_id = $welcome_response->campaign->id;
			$welcome->user_id = $user->user_id;
			$welcome->name = $welcome_response->campaign->name;
			(isset($welcome_response->campaign->description)) ?
				$welcome->description = $welcome_response->campaign->description :
				$welcome->description = "";
			$welcome->type = $request->type;
			$welcome->number_visits = $request->number_visits;
			$welcome->img = $img;
			$welcome->start_time = $welcome_response->campaign->start_time;
			$welcome->end_time = $welcome_response->campaign->end_time;
			$welcome->location_id = $request->location_id;
			$welcome->enabled = $welcome_response->campaign->enabled;
			$welcome->save();

			return redirect()->route('all_welcome_kit');

		else:

			// var_dump($promotion);
			// return;

			return redirect()->route('all_welcome_kit')->with(['status' => 'Error al ingresar la Promotion', 'type' => 'error']);

		endif;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit_welcome_kit($id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$promotion = Promotion::where([
								['user_id', '=', $user->user_id ],
								['promotion_id', '=', $id],
								['type', '=', 1]
							])->first();


		return view('welcome_kits.welcome_kit_edit', ['welcome_kit' => $promotion, 'location' => $location]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_welcome_kit(Request $request, $id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = PromotionController::crud();

		//Location
		$welcome_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$id.'/update', [
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
		$json_c = $welcome_api->getBody();

		$welcome_response = json_decode($json_c);

		if ( $welcome_response->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$welcome = Promotion::where([
									['user_id', '=', $user->user_id ],
									['promotion_id', '=', $id],
									['type', '=', 1]
								])->first();

			if ( !is_null( $file_img ) ) {

				//mime de la imagen kit
				$kit_mime = $file_img->getMimeType();

				//path donde se almacenara la imagen
				$path = 'assets/images/kit_welcome/';

				switch ($kit_mime)
				{
					case "image/jpeg":
					case "image/png":
						if ($file_img->isValid())
						{

							$nombre = $file_img->getClientOriginalName();
												$nombre = date('dmyhis').'-'.$nombre;

							$file_img->move($path, $nombre);

							$img = 'assets/images/kit_welcome/'.$nombre;

						}
					break;
				}
			}
			else {
			 $img = $welcome->img;
			}

								
			$welcome->type = $request->type;
			$welcome->number_visits = $request->number_visits;
			$welcome->img= $img;
			$welcome->name = $welcome_response->campaign->name;
			$welcome->description = (isset($welcome_response->campaign->description)) ?
					$welcome_response->campaign->description :
					$welcome->description;
			$welcome->start_time = $welcome_response->campaign->start_time;
			$welcome->end_time = $welcome_response->campaign->end_time;	

			return redirect()->route('all_welcome_kit');

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
	public function destroy_welcome_kit($promotion_id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = PromotionController::crud();

		$welcome_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$promotion_id.'/delete', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ]
		]);

		//Json parse
		$json_welcome = $welcome_api->getBody();

		$welcome_response = json_decode($json_welcome);

		if ($welcome_response->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$welcome =  Promotion::where([
									['user_id', '=', $user->user_id ],
									['promotion_id', '=', $promotion_id],
									['type', '=', 1]
								])->first();

			$welcome->delete();

			return redirect()->route('all_welcome_kit')
					->with(['status' => 'Se ha Eliminado el kit de bienvenida con éxito', 'type' => 'success']);

		else:

			//echo "<pre>"; var_dump($campaña); echo "</pre>";

			return redirect()->route('all_welcome_kit')->with(['status' => 'Error al eliminar el kit de bienvenida', 'type' => 'error']);

		endif;
	}

}
