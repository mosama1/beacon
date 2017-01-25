<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\Tag;
use Beacon\Coupon;
use Beacon\CouponTranslation;
use Beacon\Timeframe;
use Beacon\Campana;
use Beacon\Content;
use Illuminate\Support\Facades\Input;
use Log;

class CampanaController extends Controller
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
	public function show_campana()
	{
		$campana = Campana::where('user_id', '=', Auth::user()->id)->get();

		$locations = DB::table('locations')
									->select('location_id', 'name')
									->where('user_id', '=', Auth::user()->id)
									->get();

		return view('beacons.campana',['campana' => $campana, 'locations' => $locations]);
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
		$crud = CampanaController::crud();

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
			(isset($campana->campaign->description)) ?
				$cam->description = $campana->campaign->description :
				$cam->description = "";
			$cam->start_time = $campana->campaign->start_time;
			$cam->end_time = $campana->campaign->end_time;
			$cam->location_id = $request->location_id;
			$cam->enabled = $campana->campaign->enabled;
			$cam->save();

			return redirect()->route('show_campana');

		else:

			var_dump($campana);
		return;

			return redirect()->route('show_campana')->with(['status' => 'Error al ingresar la Campana', 'type' => 'error']);

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

		$campana = Campana::where([
								['user_id', '=', Auth::user()->id],
								['campana_id', '=', $id]
							])->first();


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
		$crud = CampanaController::crud();

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

			$campana = Campana::where([
									['user_id', '=', Auth::user()->id],
									['campana_id', '=', $id]
								])
								->update(array(
									'name' => $campana->campaign->name,
									'description' => (isset($campana->campaign->description)) ? $campana->campaign->description : '',
									'start_time' => $campana->campaign->start_time,
									'end_time' => $campana->campaign->end_time,
								));

			return redirect()->route('show_campana');

		else:

			return redirect()->route('add_campana')->with(['status' => 'Error al ingresar la Campana', 'type' => 'error']);

		endif;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy_campana($campana_id)
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = CampanaController::crud();

		$campana_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$campana_id.'/delete', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ]
		]);

		//Json parse
		$json_c = $campana_->getBody();

		$campana = json_decode($json_c);

		if ($campana->status_code === 200 ):

			$campana =  Campana::where([
									['user_id', '=', Auth::user()->id],
									['campana_id', '=', $campana_id]
								])->first();

			$campana->delete();

			return redirect()->route('show_campana')
					->with(['status' => 'Se ha Eliminado la Campaña con éxito', 'type' => 'success']);

		else:

			//echo "<pre>"; var_dump($campaña); echo "</pre>";

			return redirect()->route('show_campana')->with(['status' => 'Error al eliminar la Campaña', 'type' => 'error']);

		endif;
	}

	//************************************* Campaña Contenido **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_content($id)
	{
		$coupon = new Coupon;

		$coupons = $coupon->where([
			['user_id', '=', Auth::user()->id],
		])->get();

		foreach ($coupons as $key => $coupon) {
			$coupon->coupon_translation;
		}
		//$coupon->coupon_translation;
		//echo "<pre>";var_dump($coupon);echo "</pre>";

		$tags = Tag::where('user_id', '=', Auth::user()->id)->get();

		$timeframes = Timeframe::where('user_id', '=', Auth::user()->id)->get();

		return view('beacons.campana_contenido',
					[
						'coupons' => $coupons,
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
		$crud = CampanaController::crud();

		//Location
		// $campana_content = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$id.'/contents', [
		// 		// un array con la data de los headers como tipo de peticion, etc.
		// 		'headers' => ['Authorization' => 'Bearer '.$crud ],
		// 		// array de datos del formulario
		// 		'form_params' => [
		// 				 'coupon' => 12937,
		// 				 'timeframes' => '4 , 31',
		// 				 'trigger_name' => "DWELL_TIME",
		// 				 'trigger_entiry'=>"TAG"
		// 				// 'coupon' => $request->coupon_id,
		// 				// 'tag' => 'ALL',
		// 				// 'timeframes' => $request->timeframe_id,
		// 				// 'trigger_name' => $request->tigger_name_id,
		// 				// 'trigger_entity' => 'tag'
		// 		]
		// ]);

		// //Json parse
		// $json_c = $campana_content->getBody();

		// $campana_c = json_decode($json_c);

		// $content_id = substr($campana_content->getBody(),168, 5);

		// if ($campana_c->status_code === 200 ):

			$coupons = Coupon::where([
				['coupon_id', '=', $request->coupon_id],
				['user_id', '=', Auth::user()->id]
			])->get();

			foreach ($coupons as $key => $coupon) {
				$coupon->coupon_translation;
			}
			$cam_c = new Content();
		//	$cam_c->content_id = $content_id;
			$cam_c->content_id = rand(9999, 99999);
			$cam_c->user_id = Auth::user()->id;
			//coupon_translation[0] posicion [0] es en español idioma por defecto
			$cam_c->coupon = $coupons[0]->coupon_translation[0]->name;
			$cam_c->coupon_id = $coupons[0]->coupon_id;
		//	$cam_c->tag = $request->tag_id;
			$cam_c->tag = 1;
			$cam_c->campana_id = $id;
			$cam_c->timeframe_id = $request->timeframe_id;
			$cam_c->trigger_name = $request->tigger_name_id;
			$cam_c->save();

			return redirect()->route('show_campana');

		// else:

		// 	echo "<pre>";var_dump($campana_c);echo "</pre>";
		// return;

		// 	return redirect()->route('show_content', $id)->with(['status' => 'Error al ingresar la Campana', 'type' => 'error']);

		// endif;

	}

}
