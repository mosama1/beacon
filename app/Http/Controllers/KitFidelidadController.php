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

class KitBienvenidoController extends Controller
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

		$json_promotion = $response_crud->getBody();

		$token_crud = json_decode($json_promotion);

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

		$promotion = Promotion::where([
						['user_id', '=', $user->user_id],
						['type', '=', 2]
					])->get();

		return view( 'promotions.promotion', ['promotion' => $promotion, 'location' => $user->location] );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_promotion(Request $request)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = PromotionController::crud();
		//Location
		$promotion_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns', [
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
		$json_promotion = $promotion_api->getBody();

		$promotion_response = json_decode($json_promotion);


		if ($promotion_response->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$cam = new Promotion();
			$cam->promotion_id = $promotion_response->campaign->id;
			$cam->user_id = $user->user_id;
			$cam->name = $promotion_response->campaign->name;
			(isset($promotion->campaign->description)) ?
				$cam->description = $promotion_response->campaign->description :
				$cam->description = "";
			$cam->start_time = $promotion_response->campaign->start_time;
			$cam->end_time = $promotion_response->campaign->end_time;
			$cam->location_id = $request->location_id;
			$cam->enabled = $promotion_response->campaign->enabled;
			$cam->save();

			return redirect()->route('all_promotion');

		else:

			// var_dump($promotion);
			// return;

			return redirect()->route('all_promotion')->with(['status' => 'Error al ingresar el kit de bienvenida', 'type' => 'error']);

		endif;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit_promotion($id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$location = $user->location;

		$promotion = Promotion::where([
								['user_id', '=', $user->user_id ],
								['promotion_id', '=', $id],
								['type', '=', 2]
							])->first();


		return view('promotions.promotion_edit', ['promotion' => $promotion, 'locations' => $location]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_promotion(Request $request, $id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = PromotionController::crud();

		//Location
		$promotion_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$id.'/update', [
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
		$json_promotion = $promotion_api->getBody();

		$promotion_response = json_decode($json_promotion);

		if ( $promotion_response->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$promotion = Promotion::where([
									['user_id', '=', $user->user_id ],
									['promotion_id', '=', $id],
									['type', '=', 2]
								])
								->update(array(
									'name' => $promotion_response->campaign->name,
									'description' => (isset($promotion_response->campaign->description)) ? $promotion_response->campaign->description : '',
									'start_time' => $promotion_response->campaign->start_time,
									'end_time' => $promotion_response->campaign->end_time,
								));

			return redirect()->route('all_promotion');

		else:

			return redirect()->route('add_promotion')->with(['status' => 'Error al ingresar el kit de bienvenida', 'type' => 'error']);

		endif;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy_promotion($promotion_id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = PromotionController::crud();

		$promotion_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$promotion_id.'/delete', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ]
		]);

		//Json parse
		$json_promotion = $promotion_->getBody();

		$promotion_response = json_decode($json_promotion);

		if ($promotion_response->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$promotion =  Promotion::where([
									['user_id', '=', $user->user_id ],
									['promotion_id', '=', $promotion_id],
									['type', '=', 2]
								])->first();

			$promotion->delete();

			return redirect()->route('all_promotion')
					->with(['status' => 'Se ha Eliminado el kit de bienvenida con éxito', 'type' => 'success']);

		else:

			//echo "<pre>"; var_dump($campaña); echo "</pre>";

			return redirect()->route('all_promotion')->with(['status' => 'Error al eliminar el kit de bienvenida', 'type' => 'error']);

		endif;
	}

}
