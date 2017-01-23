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

		$timeframe = Timeframe::where(
				['user_id', '=', Auth::user()->id],
				['timeframe_id', '=', $id]
			)->first();


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

		$timeframe = json_decode($json_t);


		if ($timeframe->status_code === 200):

			$timeframe = Timeframe::where(
							['user_id', '=', Auth::user()->id],
							['timeframe_id', '=', $timeframe_id]
						)
						->update(array(
							'name' => $timeframe->timeframe->name,
							'description' => $timeframe->timeframe->description,
							'start_time' => $timeframe->timeframe->start_time,
							'end_time' => $timeframe->timeframe->end_time
						));

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
	public function destroy($timeframe_id)
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

			$timeframe =  Timeframe::where(
							['user_id', '=', Auth::user()->id],
							['timeframe_id', '=', $timeframe_id]
						));

			$timeframe->delete();

			return redirect()->route('show_timeframe')
							->with(['status' => 'Horario ha sido eliminado exitosamente', 'type' => 'success']);

		else:

			return redirect()->route('show_timeframe')
							->with(['status' => 'Error al eliminar horario', 'type' => 'error']);

		endif;

	}

}
