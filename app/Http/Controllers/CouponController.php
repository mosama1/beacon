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

// use Beacon\Timeframe;
// use Beacon\Campana;
// use Beacon\Content;
// use Beacon\Beacon;
// use Beacon\Section;
// use Beacon\Menu;
// use Beacon\Plate;
// use Beacon\PlateTranslation;
// use Beacon\TypesPlates;
use Illuminate\Support\Facades\Input;
use Beacon\User;
use Log;
use Beacon\Http\Controllers\UserController;
use Beacon\Pasos;
use Beacon\PasosProcesos;

class CouponController extends Controller
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

	//************************************* COUPON **************************************************//

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()	
	{
		$paso = Pasos::where('controller', '=', get_class() )->first();

		$check_proccess = UserController::check_proccess($paso->id);

		if ( $check_proccess == 0 ){ //no tiene el proceso previo realizado

			$ultimo_paso = UserController::ultimo_paso();

			return view('home', ['ultimo_paso' => $ultimo_paso,] );
		}

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$coupon = Coupon::where('user_id', '=', $user->user_id)->get();

		return view('coupons.coupon', ['coupon' => $coupon]);
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
		$crud = CouponController::crud();

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		//Location
		$coupon_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				// array de datos del formulario
				'form_params' => [
						'name' => $request->name,
						'description' => $request->description,
						'message' => $request->name,
						'type' => 'url',
						'url' => 'http://dementecreativo.com/prueba/final/',
						
				]
		]);

		//Json parse
		$json_c = $coupon_->getBody();

		$coupon_response = json_decode($json_c);



		if ($coupon_response->status_code === 200 ):

			$coupon = new Coupon();
			$coupon->coupon_id = $coupon_response->coupon->id;
			$coupon->user_id = $user->user_id;
			$coupon->type = $coupon_response->coupon->type;
			$coupon->status = 1;
			(empty($request->price)) ?
				$coupon->price = 0.0 :
				$coupon->price = $request->price;
			$coupon->url = $coupon_response->coupon->url;
			$coupon->status= 1;
			

			/*$coupon->enabled = $coupon_response->coupon->enabled;*/

			  // echo "<pre>"; var_dump($cou); echo "</pre>";
			  // return;

			$coupon->save();


			$coupon_translation = new CouponTranslation();
			$coupon_translation->name = $coupon_response->coupon->name;
			(isset($coupon_response->coupon->description)) ?
				$coupon_translation->description = $coupon_response->coupon->description :
				$coupon_translation->description = "";

			$coupon_translation->message = $coupon_response->coupon->message;
			$coupon_translation->language_id = 1;
			$coupon_translation->coupon_id = $coupon->coupon_id;
			$coupon_translation->save();


			$pasos_procesos = new PasosProcesos(); 
			$pasos_procesos->user_id = $user->id;
			$pasos_procesos->paso_id = 3; 
			$pasos_procesos->save();




			return redirect()->route('all_coupon', $request->section_id)->with(['status' => 'El menu se registro con exito', 'type' => 'success']);

		else:

			return redirect()->route('all_coupon', $request->section_id)->with(['status' => 'Error al ingresar el coupon', 'type' => 'error']);

		endif;
	}

	/**
	 * Show a view to edit a resource in storage
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function edit_coupon($coupon_id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$coupon = Coupon::where([
							['user_id', '=', $user->user_id],
							['coupon_id', '=', $coupon_id]
						])->first();

		$coupon->coupon_translation;

		// echo "<pre>"; var_dump($coupon); echo "</pre>";
		// return;

		return view('coupons.coupon_edit', ['coupon' => $coupon] );
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
		$crud = CouponController::crud();

		$coupon = Coupon::where([
							['coupon_id', '=', $coupon_id]
						])->first();

		(empty($request->url)) ?
		$url =  $coupon->url:
		$url =  $coupon->url.$request->url;

		//Location
		$coupon_ = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_id.'/update', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				// array de datos del formulario
				'form_params' => [
						'name' => $request->name,
						'description' => $request->description,
						'message' => $request->name,

						'url' => $url,
				]
		]);

		//Json parse
		$json_c = $coupon_->getBody();

		$coupon_response = json_decode($json_c);


		// echo "<pre>"; var_dump($coupon_response); echo "</pre>";
		// return;


		if ($coupon_response->status_code === 200 ):

			$coupon->type = $coupon_response->coupon->type;
			(isset($request->price)) ?
				$coupon_response->price = $request->price :
				$coupon_response->price = 0.0;
			$coupon->url = $url;
			$coupon->save();

			$coupon_translation = CouponTranslation::where([['coupon_id', '=', $coupon->coupon_id]])->first();

			(isset($coupon_response->coupon->name)) ?
				$coupon_translation->name = $coupon_response->coupon->name :
				$coupon_translation->name = "";

			$coupon_translation->name = $coupon_response->coupon->name;
			(isset($coupon_response->coupon->description)) ?
				$coupon_translation->description = $coupon_response->coupon->description :
				$coupon_translation->description = "";

			$coupon_translation->message = $coupon_response->coupon->message;
			$coupon_translation->save();

			return redirect()->route('all_coupon')
							->with(['status' => 'El menu se ha actualizado con éxito', 'type' => 'success']);

		else:

			return redirect()->route('all_coupon')
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
		$crud = CouponController::crud();

		//Timeframe delete
		$coupon_delete = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_id.'/delete', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
		]);

		//Json parse
		$json_ld = $coupon_delete->getBody();

		$coupon_delete = json_decode($json_ld);

		if ($coupon_delete->status_code === 200):

			$user = User::where( 'id', '=', Auth::user()->id )->first();

			$coupon =  Coupon::where([
								['user_id', '=', $user->user_id],
								['coupon_id', '=', $coupon_id]
							])->first();

			foreach ($coupon->coupon_translation as $key => $value) {
				$value->delete();
			}

			$coupon->delete();

        	return redirect()->route('all_coupon')
                        ->with(['status' => 'Menú eliminado con éxito', 'type' => 'success']);

		else:

        	return redirect()->route('all_coupon')
                        ->with(['status' => 'Error al eliminar Menú', 'type' => 'error']);

		endif;
	}

	public function habilitar_coupon($id)
	{		

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$location = $user->location;

		$coupon = Coupon::where([
								['user_id', '=', $user->user_id ],
								['coupon_id', '=', $id]
							])->first();

		$status = ($coupon->status == 0) ? 1 : 0;
		$coupon->status = $status;
		$coupon->save();

		return $status;
	}
}