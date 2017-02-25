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
use Image as Img;

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

		$json_fidelity = $response_crud->getBody();

		$token_crud = json_decode($json_fidelity);

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

		$fidelity_kits = Promotion::where([
						['user_id', '=', $user->user_id],
						['type', '=', 2]
					])->orderBy('name')->get();

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
		// echo "<pre>"; var_dump($request); echo "</pre>";
		// return;
		$user = User::where( 'id', '=', Auth::user()->id )->first();
		$location = $user->location;
		$client = new Client();
		$crud = FidelityKitController::crud();

		$message = (empty($request->message) ? '¡FELICIDADES!' : $request->message );
		$img = $this::create_image( $message, $location->logo );

		//Location
		$fidelity_kit_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns', [
			'headers' => ['Authorization' => 'Bearer '.$crud ],
			'form_params' => [
					'name' => $request->name,
					'description' => $request->description,
					'start_time' => date('Y-m-d H:i', strtotime('01-01-2017')),
					'end_time' => date('Y-m-d H:i', strtotime('01-01-2027')),
					'locations' => $location->location_id,
					'enabled' => 1,
			]
		]);
		//Json parse
		$json_fidelity_kit = $fidelity_kit_api->getBody();
		$fidelity_response = json_decode($json_fidelity_kit);
			//echo "<pre>"; var_dump($fidelity_kit); echo "</pre>";
		if ($fidelity_response->status_code === 200 ){
			//kit de la api
			$fidelity_resource = $fidelity_response->campaign;
			$coupon_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons', [
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				'form_params' => [
					'name' => $request->name,
					'description' => $request->description,
					'message' => $request->name,
					'type' => 'url',
					'url' => 'http://dementecreativo.com/prueba/final/',
				]
			]);
			//Json parse
			$json_coupon = $coupon_api->getBody();
			$coupon_response = json_decode($json_coupon);
			if ($coupon_response->status_code === 200) {
				// leo el id del tag para asignarlo al content
				$tag_api = $client->get('https://connect.onyxbeacon.com/api/v2.5/tags/'.$location->name, [
					'headers' => ['Authorization' => 'Bearer '.$crud ],
				]);
				//Json parse
				$json_tag = $tag_api->getBody();
				$tag_response = json_decode($json_tag);
				// echo "<pre>";	var_dump($tag_response);	echo "</pre>";
				// return;
				$tag_id = strval($tag_response->tags[0]->id);
				$coupon_resource = $coupon_response->coupon;
				$parameters_content = array(
					'headers' => ['Authorization' => 'Bearer '.$crud ],
					'form_params' => [
						'coupon' => intval($coupon_resource->id),
						'trigger_name' => 'ENTRY',
						'trigger_entity' => 'tag',
						'visit_number' => $request->number_visits,
						'tag' => intval($tag_id)
					]
				);
				//Location
				$content_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/contents', $parameters_content);
				//Json parse
				$json_content = $content_api->getBody();
				$content_response = json_decode($json_content);
				if ( $content_response->status_code === 200 ) {
					$parameters_content = array(
						// un array con la data de los headers como tipo de peticion, etc.
						'headers' => ['Authorization' => 'Bearer '.$crud ],
						// array de datos del formulario
						'form_params' => [
								'name' => $request->name,
								'description' => (isset($coupon_resource->description)) ? $coupon_resource->description : '' ,
								'message' => $request->name,
								'type' => 'url',
								'url' => 'http://dementecreativo.com/prueba/final/kit_fidelidad/' . $fidelity_resource->id, 
						]
					);
					//Carga el coupon en el beacon
					$coupon_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/update', $parameters_content);
					//Json parse
					$json_c = $coupon_api->getBody();
					$coupon_response = json_decode($json_c);
					if ($coupon_response->status_code == 200 )
					{
						foreach ($content_response as $key => $value) {
							if ($key == "campaign-content") {
								$content_api = $value;
							}
						}
						
						DB::beginTransaction();
						try {
							$coupon = new Coupon();
							$coupon->coupon_id = $coupon_resource->id;
							$coupon->user_id = $user->user_id;
							$coupon->type = $coupon_resource->type;
							(empty($request->price)) ?
								$coupon->price = 0.0 :
								$coupon->price = $request->price;
							$coupon->url = $coupon_resource->url;
							  // echo "<pre>"; var_dump($cou); echo "</pre>";
							  // return;
							$coupon->save();
							$coupon_translation = new CouponTranslation();
							$coupon_translation->name = $request->name;
							(isset($coupon_resourcerequest->description)) ?
								$coupon_translation->description = $request->description :
								$coupon_translation->description = "";
							$coupon_translation->message = $request->name;
							$coupon_translation->language_id = 1;
							$coupon_translation->coupon_id = $coupon->coupon_id;
							$coupon_translation->save();
							$content_fidelity = new Content();
							$content_fidelity->content_id = $content_api->id;
							$content_fidelity->user_id = $user->user_id;
							//	coupon_translation[0] posicion [0] es en español idioma por defecto
								$content_fidelity->coupon = $coupon->coupon_translation[0]->name;
								$content_fidelity->coupon_id = $coupon->coupon_id;
							//	$content_fidelity->tag = $request->tag_id;
							$content_fidelity->tag = $tag_id;
							$content_fidelity->campana_id = $fidelity_resource->id;
							$content_fidelity->trigger_name = $content_api->trigger_name;
							$content_fidelity->save();
							$fidelity_kit = new Promotion();
							$fidelity_kit->promotion_id = $fidelity_resource->id;
							$fidelity_kit->user_id = $user->user_id;
							$fidelity_kit->name = $fidelity_resource->name;
							(isset($fidelity_resource->description)) ?
								$fidelity_kit->description = $fidelity_resource->description :
								$fidelity_kit->description = "";
							(isset($fidelity_response->type)) ?
								$fidelity_kit->type = $request->type :
								$fidelity_kit->type = 2;
							(!empty($request->message)) ?
								$fidelity_kit->message = $request->message :
								$fidelity_kit->message = "¡FELICIDADES!";								
							$fidelity_kit->number_visits = $request->number_visits;
							$fidelity_kit->img = $img;
							$fidelity_kit->start_time = $fidelity_resource->start_time;
							$fidelity_kit->end_time = $fidelity_resource->end_time;
							$fidelity_kit->location_id = $location->location_id;
							$fidelity_kit->status = $fidelity_resource->enabled;
							$fidelity_kit->save();
						} catch(ValidationException $e)
						{
							// Rollback and then redirect
							// back to form with errors
							DB::rollback();
							//codigo para revertir transaccion
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/contents/'.$content_api->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);
							$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);
						
							 echo "<pre>";	var_dump('ValidationException $e: =>');	echo "</pre>";
							 echo "<pre>";	var_dump($e->getErrors());	echo "</pre>";
							 return;
							return redirect()->route('all_fidelity_kit')->with(['status' => 'Error al ingresar el kit de fidelidad', 'type' => 'error'])
								->withErrors( $e->getErrors() )
								->withInput();
						} catch(\Exception $e)
						{
							DB::rollback();
							//codigo para revertir transaccion
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/contents/'.$content_api->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);
							
							$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);
						
							 echo "<pre>";	var_dump('$e: =>');	echo "</pre>";
							 echo "<pre>";	var_dump($e);	echo "</pre>";
							 return;
							return redirect()->route('all_fidelity_kit')->with(['status' => 'Error al ingresar el kit de fidelidad', 'type' => 'error']);
						}
						DB::commit();
						return redirect()->route('all_fidelity_kit')
								->with(['status' => 'Se ha actualizado el kit de fidelidad con éxito', 'type' => 'success']);
					}
					else
					{
						DB::rollback();
						//codigo para revertir transaccion
						$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/contents/'.$content_response->id.'/delete', [
							'headers' => ['Authorization' => 'Bearer '.$crud ],
						]);
						
						$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/delete', [
							'headers' => ['Authorization' => 'Bearer '.$crud ],
						]);
						$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/delete', [
							'headers' => ['Authorization' => 'Bearer '.$crud ],
						]);
					
						 echo "<pre>";	var_dump('actualizar coupon del contenido');	echo "</pre>";
						 echo "<pre>";	var_dump($coupon_response);	echo "</pre>";
						 return;
						return redirect()->route('all_fidelity_kit')->with(['status' => 'Error al ingresar el kit de fidelidad', 'type' => 'error']);
					}
				} else {
					//codigo para revertir transaccion
					$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_response->id.'/delete', [
						'headers' => ['Authorization' => 'Bearer '.$crud ],
					]);
					$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/delete', [
						'headers' => ['Authorization' => 'Bearer '.$crud ],
					]);
					//codigo para revertir transaccion
					 echo "<pre>";	var_dump('respuesta contenido');	echo "</pre>";
					 echo "<pre>";	var_dump($content_response);	echo "</pre>";
					 return;
					return redirect()->route('all_fidelity_kit')
									->with(['status' => 'Error al ingresar el kit de fidelidad', 'type' => 'error']);
				}
				
			} else {
				//codigo para revertir transaccion
				$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/delete', [
					'headers' => ['Authorization' => 'Bearer '.$crud ],
				]);
				 echo "<pre>";	var_dump('respuesta coupon');	echo "</pre>";
				 echo "<pre>";	var_dump($coupon_response);	echo "</pre>";
				// return;
				return redirect()->route('all_fidelity_kit')
								->with(['status' => 'Error al ingresar el kit de fidelidad', 'type' => 'error']);
			}
		} else {
			 echo "<pre>";	var_dump('respuesta fidelidad');	echo "</pre>";
			 echo "<pre>";	var_dump($fidelity_response);	echo "</pre>";
			// return;
		
			return redirect()->route('all_fidelity_kit')
							->with(['status' => 'Error al ingresar el kit de fidelidad', 'type' => 'error']);
		}
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
	public function update_fidelity_kit(Request $request, $promotion_id)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$location = $user->location;

		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = FidelityKitController::crud();

		$fidelity_old = Promotion::where([
									['user_id', '=', $user->user_id ],
									['promotion_id', '=', $promotion_id],
									['type', '=', 2]
								])->first();

		$fidelity_kit = $fidelity_old;

		$content_old = $fidelity_old->content;

		$coupon_old = $content_old->coupons;

		$coupon_translation_old = $coupon_old;

		// echo "<pre>"; var_dump($fidelity_old); echo "</pre>";
		// echo "<pre>"; var_dump($content_old); echo "</pre>";
		// echo "<pre>"; var_dump($coupon_old); echo "</pre>";
		// return;

		//se obtiene la imagen
		$file_img = $request->file('img');

		if ( !is_null( $file_img ) ) {

			$kit_mime = $file_img->getMimeType();

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

						$img_api = 'http://dementecreativo.com/prueba/final/'.$img;

					}
				break;
			}
		}
		else {

			$img = "";
			$img_api = $coupon_old->url;

		}

		//Location
		$fidelity_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$promotion_id.'/update', [
			'headers' => ['Authorization' => 'Bearer '.$crud ],
			'form_params' => [
				'name' => $request->name,
				'description' => $request->description,
				'start_time' => date('Y-m-d H:i', strtotime('01-01-2017')),
				'end_time' => date('Y-m-d H:i', strtotime('01-01-2099'))
			]
		]);

		//Json parse
		$json_fidelity = $fidelity_api->getBody();

		$fidelity_response = json_decode($json_fidelity);

			//echo "<pre>"; var_dump($fidelity_kit); echo "</pre>";


		if ($fidelity_response->status_code === 200 ){

			//kit de la api
			$fidelity_resource = $fidelity_response->campaign;

			$coupon_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_old->coupon_id.'/update', [
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				'form_params' => [
					'name' => $request->name,
					'description' => (isset($request->description)) ? $request->description : $coupon_old->description ,
					'message' => $request->name,
					'url' =>  $img_api,
				]
			]);

			//Json parse
			$json_coupon = $coupon_api->getBody();

			$coupon_response = json_decode($json_coupon);


			if ($coupon_response->status_code === 200) {

				// leo el id del tag para asignarlo al content
				$tag_api = $client->get('https://connect.onyxbeacon.com/api/v2.5/tags/'.$location->name, [
					'headers' => ['Authorization' => 'Bearer '.$crud ],
				]);

				//Json parse
				$json_tag = $tag_api->getBody();

				$tag_response = json_decode($json_tag);

				// echo "<pre>";	var_dump($tag_response);	echo "</pre>";
				// return;
				$tag_id = strval($tag_response->tags[0]->id);

				$coupon_resource = $coupon_response->coupon;

				$parameters_content = array(
					'headers' => ['Authorization' => 'Bearer '.$crud ],

					'form_params' => [
						'coupon' => intval($coupon_resource->id),
						'trigger_name' => 'ENTRY',
						'trigger_entity' => 'tag',
						'visit_number' => $request->number_visits,
						'tag' => intval($tag_id)
					]

				);

				//Location
				$content_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/contents/'.$content_old->content_id.'/update', $parameters_content);

				//Json parse
				$json_content = $content_api->getBody();

				$content_response = json_decode($json_content);

				if ( $content_response->status_code === 200 ) {

						foreach ($content_response as $key => $value) {
							if ($key == "campaign-content") {
								$content_api = $value;
							}
						}
						
						DB::beginTransaction();

						try {

							$coupon = Coupon::where([['coupon_id', '=', $coupon_old->coupon_id]])->first();	


							(isset($request->price)) ?
								$coupon_response->price = $request->price :
								$coupon_response->price = 0.0;
							$coupon->url = $img_api;
							$coupon->save();

							$coupon_translation = CouponTranslation::where([['coupon_id', '=', $coupon_old->coupon_id]])->first();

							(isset($request->name)) ?
								$coupon_translation->name = $request->name :
								$coupon_translation->name = "";

							(isset($request->description)) ?
								$coupon_translation->description = $request->description :
								$coupon_translation->description = "";

							(isset($request->name)) ?
								$coupon_translation->message = $request->name :
								$coupon_translation->message = "";

							$coupon_translation->save();

							$content_fidelity = Content::where([
												['content_id', '=', $content_old->content_id ]
											])->first();


							$content_fidelity->content_id = $content_old->content_id;
							//coupon_translation[0] posicion [0] es en español idioma por defecto
							$content_fidelity->coupon = $coupon_translation->name;
							$content_fidelity->coupon_id = $coupon_old->coupon_id;
							//    $content_fidelity->tag = $request->tag_id;
							$content_fidelity->tag = $tag_id;
							$content_fidelity->campana_id = $promotion_id;
							$content_fidelity->trigger_name = 'ENTRY';
							$content_fidelity->save();

							$fidelity_kit->name = (isset($request->name)) ?
									$fidelity_resource->name :
									$fidelity_old->name;

							$fidelity_kit->description = (isset($request->description)) ?
									$request->description :
									$fidelity_old->description;

							$fidelity_kit->save();

						} catch(ValidationException $e)
						{
							// Rollback and then redirect
							// back to form with errors
							DB::rollback();

							//codigo para revertir transaccion

							$parameters_content = array(
								'headers' => ['Authorization' => 'Bearer '.$crud ],

								'form_params' => [
									'coupon' => $coupon_old->coupon_id,
									'trigger_name' => $coupon_old->coupon_id,
									'trigger_entity' => $content_old->trigger_entity,
									'visit_number' => $content_old->number_visits,
									'tag' => $content_old->tag,
								]

							);
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/contents/'.$content_api->id.'/update', $parameters_content);


							$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/update', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
								'form_params' => [
									'name' => $coupon_old->name,
									'description' => $coupon_old->description,																																																																																																																																																																																																																																																																																																						$coupon_old->description,
									'message' => $coupon_old->message,
									'url' =>  $coupon_old->url,
								]
							]);

							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/update', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
								'form_params' => [
									'name' => $fidelity_old->name,
									'description' => $fidelity_old->description,
									'start_time' => $fidelity_old->start_time,
									'end_time' => $fidelity_old->end_time,
								]
							]);
						
							// echo "<pre>";	var_dump('ValidationException $e: =>');	echo "</pre>";
							// echo "<pre>";	var_dump($e);	echo "</pre>";
							// return;

							return redirect()->route('all_fidelity_kit')->with(['status' => 'Error al ingresar el kit de fidelidad', 'type' => 'error']);

						} catch(\Exception $e)
						{
							DB::rollback();

							//codigo para revertir transaccion

							$parameters_content = array(
								'headers' => ['Authorization' => 'Bearer '.$crud ],

								'form_params' => [
									'coupon' => $coupon_old->coupon_id,
									'trigger_name' => $coupon_old->coupon_id,
									'trigger_entity' => $content_old->trigger_entity,
									'visit_number' => $content_old->number_visits,
									'tag' => $content_old->tag,
								]

							);
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/contents/'.$content_api->id.'/update', $parameters_content);


							$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/update', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
								'form_params' => [
									'name' => $coupon_translation_old->name,
									'description' => $coupon_translation_old->description,
									'message' => $coupon_translation_old->message,
									'url' =>  $coupon_old->url,
								]
							]);

							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/update', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
								'form_params' => [
									'name' => $fidelity_old->name,
									'description' => $fidelity_old->description,
									'start_time' => $fidelity_old->start_time,
									'end_time' => $fidelity_old->end_time,
								]
							]);
						
							// echo "<pre>";	var_dump('$e: =>');	echo "</pre>";
							// echo "<pre>";	var_dump($e);	echo "</pre>";
							// return;

							return redirect()->route('all_fidelity_kit')->with(['status' => 'Error al ingresar el kit de fidelidad', 'type' => 'error']);
						}


						DB::commit();

						return redirect()->route('all_fidelity_kit')
								->with(['status' => 'Se ha actualizado el kit de fidelidad con éxito', 'type' => 'success']);

				} else {

					$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/update', [
						'headers' => ['Authorization' => 'Bearer '.$crud ],
						'form_params' => [
							'name' => $coupon_old->name,
							'description' => $coupon_old->description,
							'message' => $coupon_old->message,
							'url' =>  $coupon_old->url,
						]
					]);

					$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/update', [
						'headers' => ['Authorization' => 'Bearer '.$crud ],
						'form_params' => [
							'name' => $fidelity_old->name,
							'description' => $fidelity_old->description,
							'start_time' => $fidelity_old->start_time,
							'end_time' => $fidelity_old->end_time,
						]
					]);

					//codigo para revertir transaccion
					// echo "<pre>";	var_dump('respuesta contenido');	echo "</pre>";
					// echo "<pre>";	var_dump($content_response);	echo "</pre>";
					// return;

					return redirect()->route('all_fidelity_kit')
									->with(['status' => 'Error al actualizar el kit de fidelidad', 'type' => 'error']);
				}
				
			} else {

				//codigo para revertir transaccion
				$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$fidelity_resource->id.'/update', [
					'headers' => ['Authorization' => 'Bearer '.$crud ],
					'form_params' => [
						'name' => $fidelity_old->name,
						'description' => $fidelity_old->description,
						'start_time' => $fidelity_old->start_time,
						'end_time' => $fidelity_old->end_time,
					]
				]);

				// echo "<pre>";	var_dump('respuesta coupon');	echo "</pre>";
				// echo "<pre>";	var_dump($coupon_response);	echo "</pre>";
				// return;

				return redirect()->route('all_fidelity_kit')
								->with(['status' => 'Error al actualizar el kit de fidelidad', 'type' => 'error']);
			}

		} else {

			// echo "<pre>";	var_dump('respuesta fidelidad');	echo "</pre>";
			// echo "<pre>";	var_dump($fidelity_response);	echo "</pre>";
			// return;
		
			return redirect()->route('all_fidelity_kit')
							->with(['status' => 'Error al actualizar el kit de fidelidad', 'type' => 'error']);
		}
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

		//
		$user = User::where( 'id', '=', Auth::user()->id )->first();

		$content =  Content::where([
								['user_id', '=', $user->user_id],
								['campana_id', '=', $promotion_id]
							])->first();

		$coupon = $content->coupons;

		$fidelity_kit =  Promotion::where([
								['user_id', '=', $user->user_id ],
								['promotion_id', '=', $promotion_id],
								['type', '=', 2]
							])->first();

		// $content_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$promotion_id.'/content/'.$content->content_id.'/delete', [
		// 		// un array con la data de los headers como tipo de peticion, etc.
		// 		'headers' => ['Authorization' => 'Bearer '.$crud ]
		// ]);

		// //Json parse
		// $json_content = $content_api->getBody();

		// $content_response = json_decode($json_content);

		// if ($content_response->status_code === 200 ) {
		

			//Timeframe delete
			$coupon_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon->coupon_id.'/delete', [
					// un array con la data de los headers como tipo de peticion, etc.
					'headers' => ['Authorization' => 'Bearer '.$crud ],
			]);

			//Json parse
			$json_coupon = $coupon_api->getBody();

			$coupon_response = json_decode($json_coupon);

			if ($coupon_response->status_code === 200) {
			

				$fidelity_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$promotion_id.'/delete', [
						// un array con la data de los headers como tipo de peticion, etc.
						'headers' => ['Authorization' => 'Bearer '.$crud ]
				]);

				//Json parse
				$json_fidelity = $fidelity_api->getBody();

				$fidelity_response = json_decode($json_fidelity);
				if ($fidelity_response->status_code === 200 ) {
						
					DB::beginTransaction();

					try {

						$content->delete();

						foreach ($coupon->coupon_translation as $key => $value) {
						 	$value->delete();
						}

						$coupon->delete();

						$fidelity_kit->delete();

					} catch(ValidationException $e)
					{
						// Rollback and then redirect
						DB::rollback();

						return redirect()->route('all_fidelity_kit')->with(['status' => 'Error al eliminar el kit de fidelidad', 'type' => 'error']);

					} catch(\Exception $e)
					{
						DB::rollback();

						return redirect()->route('all_fidelity_kit')
										->with(['status' => 'Error al eliminar el kit de fidelidad', 'type' => 'error']);
					}


					DB::commit();

					return redirect()->route('all_fidelity_kit')
										->with(['status' => 'Se ha Eliminado el kit de fidelidad con éxito', 'type' => 'success']);
				} else {

					//echo "<pre>"; var_dump($fidelity_kit); echo "</pre>";

					return redirect()->route('all_fidelity_kit')
									->with(['status' => 'Error al eliminar el kit de fidelidad', 'type' => 'error']);
					
				}
				
			} else {

				//echo "<pre>"; var_dump($fidelity_kit); echo "</pre>";

				return redirect()->route('all_fidelity_kit')
								->with(['status' => 'Error al eliminar el kit de fidelidad', 'type' => 'error']);
			}
		// } else {

		// 	echo "<pre>"; var_dump($content_response); echo "</pre>";
		// 	return;

		// 	return redirect()->route('all_fidelity_kit')
		// 					->with(['status' => 'Error al eliminar el kit de fidelidad', 'type' => 'error']);
		// }
	}


	public static function create_image( $message, $logo )
	{
		$now = date('d-m-Y');
		$font = public_path('img/font/Intro.otf');

		$file_original  = 'img/origin_promotions.png';
		$file_promotion = 'assets/images/welcome_kit/kb' . date('Ymdhis') . '.png';

		// create Image from file
		try {

			$img = Img::make( $file_original );

			// Insert a logo
			$logo_preview = Img::make( $logo );			
			$logo_preview->resize(null, 70, function ($constraint) {
			    $constraint->aspectRatio();
			});
			$img->insert($logo_preview, 'top', 10,5);

			$img->text($message,125,100, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(20); 
				$font->align('center');
				$font->color('#ff8c00');  
			});

			// LINE TEXT FIXED
			$img->text('KIT DE FIDELIDAD',125,120, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(15); 
				$font->align('center');
				$font->color('#000');  
			});

			// RECTANGULO PARA EL CODIGO
			$img->rectangle(45, 130, 204, 150, function ($draw) {
			    $draw->background('#c5c5c5');
			    $draw->border(1, '#616161');
			});

			// serial text
			$img->text('SERIAL',125,167, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(12); 
				$font->align('center');
				$font->color('#616161');  
			});

			// serial text
			$img->text('PRESENTE ESTE CÓDIGO',130,220, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(15); 
				$font->align('center');
				$font->color('#000');
			});

			// CREATE FIRST MESSAGE
			$img->text('AL CAMARERO',132,245, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(20); 
				$font->align('center');
				$font->color('#000');  
			});

			// LINE TEXT 
			$img->text('VÁLIDO SOLO POR HOY',130,350, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(15); 
				$font->align('center');
				$font->color('#000');
			});

			$img->save($file_promotion); 

		} catch (Exception $e) {
		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
		return $file_promotion;
	}


	public static function generate_code_image( $id )
	{
		
		$promotion = Promotion::where([
								['promotion_id', '=', $id],								
							])->first();

		if ( !file_exists( $promotion->img ) )
		{

			return 'Lo datos suministrados no son validos...';
		}

		$now = date('d-m-Y');
		$font = public_path('img/font/Intro.otf');

		$chars = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
		$code_secret = trim(substr( str_shuffle( $chars ), 0, 10 ));

		// create Image from file
		try {

			$img = Img::make( $promotion->img );

			// show secret code
			$img->text($code_secret, 78, 145, function($font){
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(15);
				$font->color('#b00a16');
			});

			// DATE VALIDED
			$img->text(date('d.m.Y'),128,370, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(15);
				$font->align('center');
				$font->color('#ff8c00');
			});

			$img->save( $promotion->img ); 

		} catch (Exception $e) {
		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
		return view( 'promotion', ['promotion' => $promotion->img] );
	}


	public static function edit_image( $message, $logo, $id )
	{

		$promotion = Promotion::where([
								['promotion_id', '=', $id],								
							])->first();

		if ( !file_exists( $promotion->img ) )
		{

			return 'Lo datos suministrados no son validos...';
		}

		$now = date('d-m-Y');
		$font = public_path('img/font/Intro.otf');

		$file_original  = 'img/origin_promotions.png';
		$file_promotion = $promotion->img;

		// create Image from file
		try {

			$img = Img::make( $file_original );

			// Insert a logo
			$logo_preview = Img::make( $logo );			
			$logo_preview->resize(null, 70, function ($constraint) {
			    $constraint->aspectRatio();
			});
			$img->insert($logo_preview, 'top', 10,5);

			$img->text($message,125,100, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(20); 
				$font->align('center');
				$font->color('#ff8c00');  
			});

			// LINE TEXT FIXED
			$img->text('KIT DE FIDELIDAD',125,120, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(15); 
				$font->align('center');
				$font->color('#000');  
			});

			// RECTANGULO PARA EL CODIGO
			$img->rectangle(45, 130, 204, 150, function ($draw) {
			    $draw->background('#c5c5c5');
			    $draw->border(1, '#616161');
			});

			// serial text
			$img->text('SERIAL',125,167, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(12); 
				$font->align('center');
				$font->color('#616161');  
			});

			// serial text
			$img->text('PRESENTE ESTE CÓDIGO',130,220, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(15); 
				$font->align('center');
				$font->color('#000');
			});

			// CREATE FIRST MESSAGE
			$img->text('AL CAMARERO',132,245, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(20); 
				$font->align('center');
				$font->color('#000');  
			});

			// LINE TEXT 
			$img->text('VÁLIDO SOLO POR HOY',130,350, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(15); 
				$font->align('center');
				$font->color('#000');
			});

			// DATE VALIDED
			$img->text(date('d.m.Y'),128,370, function($font){ 
				$font->file(public_path('img/font/Intro.otf'));
				$font->size(15);
				$font->align('center');
				$font->color('#ff8c00');
			});
			$img->save($file_promotion); 

		} catch (Exception $e) {
		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	}	

}
