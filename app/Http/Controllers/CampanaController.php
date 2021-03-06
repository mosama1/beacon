<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\Campana;
use Beacon\Content;
use Beacon\Coupon;
use Beacon\CouponTranslation;
use Beacon\Tag;
use Beacon\Timeframe;
use Beacon\User;
use Beacon\PasosProcesos;
use Illuminate\Support\Facades\Input;
use Beacon\Pasos;


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

		return $token_crud->access_token;
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

		$campana = Campana::where([
						['user_id', '=', $user->user_id]
					])->get();

		$user->location;

		return view( 'campanas.campana', ['campana' => $campana, 'location' => $user->location] );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_campana(Request $request)
	{	
		
		$fecha_inicio = date('Y', strtotime($request->start_time));
		$fecha_fin    = date('Y', strtotime($request->end_time));

		if ( $fecha_inicio == '1970' | $fecha_fin == '1970' ) {
			
			return redirect()->route('all_campana')
					->with(['status' => 'Error al indicar fechas (dd-mm-yy)', 'type' => 'error']);
		}
		
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
					'start_time' => date('Y-m-d h:m:s', strtotime($request->start_time)),
					'end_time' => date('Y-m-d h:m:s', strtotime($request->end_time)),
					'locations' => $request->location_id,
					'enabled' => 1,
				]
		]);


		//Json parse
		$json_c = $campana_->getBody();

		$campana = json_decode($json_c);

		if ( $campana->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$cam = new Campana();
			$cam->campana_id = $campana->campaign->id;
			$cam->user_id = $user->user_id;
			$cam->name = $campana->campaign->name;
			(isset($campana->campaign->description)) ?
				$cam->description = $campana->campaign->description :
				$cam->description = "";
			$cam->start_time = $campana->campaign->start_time;
			$cam->end_time = $campana->campaign->end_time;
			$cam->location_id = $request->location_id;
			$cam->status = $campana->campaign->enabled;
			$cam->save();

			return redirect()->route('all_campana');

		else:

			// var_dump($campana);
			// return;

			return redirect()->route('all_campana')->with(['status' => 'Error al ingresar la Campana', 'type' => 'error']);

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

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$location = $user->location;

		$campana = Campana::where([
								['user_id', '=', $user->user_id ],
								['campana_id', '=', $id]
							])->first();


		return view('campanas.campana_edit', ['campana' => $campana, 'locations' => $location]);
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
						'start_time' => date("Y-m-d H:m:s", strtotime($request->start_time)),
						'end_time' => date("Y-m-d H:m:s", strtotime($request->end_time)),
				]
		]);

		//Json parse
		$json_c = $campana_->getBody();

		$campana = json_decode($json_c);

		if ( $campana->status_code === 200 ):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$campana = Campana::where([
									['user_id', '=', $user->user_id ],
									['campana_id', '=', $id]
								])
								->update(array(
									'name' => $campana->campaign->name,
									'description' => (isset($campana->campaign->description)) ? $campana->campaign->description : '',
									'start_time' => $campana->campaign->start_time,
									'end_time' => $campana->campaign->end_time,
								));

			return redirect()->route('all_campana');

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

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$campana =  Campana::where([
									['user_id', '=', $user->user_id ],
									['campana_id', '=', $campana_id]
								])->first();

			$campana->delete();

			return redirect()->route('all_campana')
					->with(['status' => 'Se ha Eliminado la Campaña con éxito', 'type' => 'success']);

		else:

			//echo "<pre>"; var_dump($campaña); echo "</pre>";

			return redirect()->route('all_campana')->with(['status' => 'Error al eliminar la Campaña', 'type' => 'error']);

		endif;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function habilitar_campana($id)
	{
		
		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$location = $user->location;

		$campana = Campana::where([
								['user_id', '=', $user->user_id ],
								['campana_id', '=', $id]
							])->first();

		$status = ( $campana->status == 0 ) ? 1 : 0;
		$campana->status = $status;
		$campana->save();

		return $status;
	}

}
