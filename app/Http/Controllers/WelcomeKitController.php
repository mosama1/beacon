<?php

namespace Beacon\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Beacon\Promotion;
use Beacon\Content;
use Beacon\Tag;
use Beacon\Timeframe;
use Beacon\User;
use Beacon\CouponPromotion;
use Image as Img;

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

		$welcome_kits = Promotion::where([
						['user_id', '=', $user->user_id]
					])->orderBy('name')->get();

		return view( 'welcome_kits.welcome_kit', ['welcome_kits' => $welcome_kits, 'location' => $user->location] );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store_welcome_kit(Request $request)
	{

		$user = User::where( 'id', '=', Auth::user()->id )->first();
		$location = $user->location;
		$client = new Client();
		$crud = WelcomeKitController::crud();

		//Location
		$welcome_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns', [
			'headers' => ['Authorization' => 'Bearer '.$crud ],
			'form_params' => [
					'name' => $request->name,
					'description' => $request->description,
					'start_time' => date('Y-m-d H:i', strtotime('01-01-2017 00:01')),
					'end_time' => date('Y-m-d H:i', strtotime('01-01-2027 23:59 ')),
					'locations' => $location->location_id,
					'enabled' => 1,
			]
		]);
		//Json parse
		$json_welcome = $welcome_api->getBody();
		$welcome_response = json_decode($json_welcome);
			//echo "<pre>"; var_dump($welcome_response); echo "</pre>";
		if ($welcome_response->status_code === 200 ){
			//kit de la api
			$welcome_resource = $welcome_response->campaign;
			$coupon_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons', [
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				'form_params' => [
					'name' => $request->name,
					'description' => $request->description,
					'message' => $request->name,
					'type' => 'url',
					'url' => 'http://dementecreativo.com/prueba/final/movil/promocion/',
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
				$content_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/contents', $parameters_content);
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
								'url' =>  'http://dementecreativo.com/prueba/final/movil/promocion/' . $welcome_resource->id,
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

							/* dejar hasta que este seguro que no lo van a solicitar
							$coupon = new Coupon();
							$coupon->coupon_id = $coupon_resource->id;
							$coupon->user_id = $user->user_id;
							$coupon->type = $coupon_resource->type;
							(empty($request->price)) ?
								$coupon->price = 0.0 :
								$coupon->price = $request->price;
							$coupon->url = $coupon_resource->url;
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

							$content_welcome = new Content();
							$content_welcome->content_id = $content_api->id;
							$content_welcome->user_id = $user->user_id;
							//	coupon_translation[0] posicion [0] es en español idioma por defecto
								$content_welcome->coupon = $coupon->coupon_translation[0]->name;
								$content_welcome->coupon_id = $coupon->coupon_id;
							//	$content_welcome->tag = $request->tag_id;
							$content_welcome->tag = $tag_id;
							$content_welcome->campana_id = $welcome_resource->id;
							$content_welcome->trigger_name = $content_api->trigger_name;
							$content_welcome->save();
							*/

							// codigo de la promocion
							$promotion_id = $welcome_resource->id;

							//se obtiene la image							
							$image = $request->file('imagenPromo');

							// la muevo al directorio correspondiente
							$image = $this::mueveArchivo( $image, $promotion_id );

							// genero la imagenbase de la promocion
							$message = (empty($request->message) ? '¡FELICIDADES!' : $request->message );
							$img = $this::create_image( $message, $location->logo, $image, $promotion_id );
							
							// almaceno el registro
							$welcome_kit = new Promotion();
							$welcome_kit->promotion_id = $promotion_id;
							$welcome_kit->user_id = $user->user_id;
							$welcome_kit->name = $welcome_resource->name;

							$welcome_kit->description = (isset($welcome_resource->description)) ?
								$welcome_resource->description : "";

							$welcome_kit->type = $request->type_promo;

							$welcome_kit->message = (!empty($request->message)) ?
								 $request->message : "¡FELICIDADES!";

							$welcome_kit->number_visits = $request->number_visits;

							$welcome_kit->img = $img;
							$welcome_kit->image_promotion = $image == 0 ? '' : $image;
							$welcome_kit->start_time = $welcome_resource->start_time;
							$welcome_kit->end_time = $welcome_resource->end_time;
							$welcome_kit->location_id = $location->location_id;
							$welcome_kit->status = $welcome_resource->enabled;

							$welcome_kit->save();

						} catch(ValidationException $e)
						{
							// Rollback and then redirect
							// back to form with errors
							DB::rollback();
							//codigo para revertir transaccion
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/contents/'.$content_api->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);
							$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);

							return redirect()->route('all_welcome_kit')->with(['status' => 'Error al ingresar la promoción', 'type' => 'error'])
								->withErrors( $e->getErrors() )
								->withInput();
						} catch(\Exception $e)
						{

							DB::rollback();
							//codigo para revertir transaccion
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/contents/'.$content_api->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);

							$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/delete', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
							]);
							echo 'Excepción capturada: ',  $e->getMessage(), "\n";
							echo 'en la linea: ',  $e->getLine(), "\n";
							echo 'en la linea: ',  $e->getCode(), "\n";
							return;
							return redirect()->route('all_welcome_kit')->with(['status' => 'Error al ingresar la promoción', 'type' => 'error']);
						}
						DB::commit();
						return redirect()->route('all_welcome_kit')
								->with(['status' => 'Promoción creada con éxito', 'type' => 'success']);
					}
					else
					{
						DB::rollback();
						//codigo para revertir transaccion
						$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/contents/'.$content_response->id.'/delete', [
							'headers' => ['Authorization' => 'Bearer '.$crud ],
						]);

						$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/delete', [
							'headers' => ['Authorization' => 'Bearer '.$crud ],
						]);
						$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/delete', [
							'headers' => ['Authorization' => 'Bearer '.$crud ],
						]);

						return redirect()->route('all_welcome_kit')->with(['status' => 'Error al ingresar required', 'type' => 'error']);
					}
				} else {
					//codigo para revertir transaccion
					$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_response->id.'/delete', [
						'headers' => ['Authorization' => 'Bearer '.$crud ],
					]);
					$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/delete', [
						'headers' => ['Authorization' => 'Bearer '.$crud ],
					]);

					return redirect()->route('all_welcome_kit')
									->with(['status' => 'Error al ingresar la promoción', 'type' => 'error']);
				}

			} else {
				//codigo para revertir transaccion
				$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/delete', [
					'headers' => ['Authorization' => 'Bearer '.$crud ],
				]);

				return redirect()->route('all_welcome_kit')
								->with(['status' => 'Error al ingresar la promoción', 'type' => 'error']);
			}
		} else {

			return redirect()->route('all_welcome_kit')
							->with(['status' => 'Error al ingresar la promoción', 'type' => 'error']);
		}
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


		return view('welcome_kits.welcome_kit_edit', ['welcome_kit' => $promotion, 'location' => $user->location]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_welcome_kit(Request $request, $promotion_id)
	{

		if ( !is_numeric($promotion_id) or empty($promotion_id))
		{
			return;
		}

		$user = Auth::user();

		$location = $user->location;


		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = WelcomeKitController::crud();

		$welcome_old = Promotion::where([
							['user_id', '=', $user->user_id ],
							['promotion_id', '=', $promotion_id],
							['type', '=', 1]
						])->first();

		$welcome_kit = $welcome_old;

		// leo el codigo del coupon de la campaña en la api 
		//
		$welcome_coupon_api = $client->get('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$promotion_id.'/contents', [
			'headers' => ['Authorization' => 'Bearer '.$crud ]
		]);

		//Json parse
		$json_welcome_coupon = $welcome_coupon_api->getBody();

		$welcome_coupon_response = json_decode($json_welcome_coupon);

		// todo este andamiaje es por el sigo '-' de campaign-contents
		//
		$campaign_contents = "campaign-contents"; 
		$id = $welcome_coupon_response->$campaign_contents;
		$coupon_id = $id[0]->content->id;
		$id = $welcome_coupon_response->$campaign_contents;
		$content_id = $id[0]->id;

		$welcome_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$promotion_id.'/update', [
			'headers' => ['Authorization' => 'Bearer '.$crud ],
			'form_params' => [
				'name' => $request->name,
				'start_time' => date('Y-m-d H:i', strtotime('01-01-2017 00:01')),
				'end_time' => date('Y-m-d H:i', strtotime('01-01-2027 23:59 '))
			]
		]);

		//Json parse
		$json_welcome = $welcome_api->getBody();

		$welcome_response = json_decode($json_welcome);

		if ($welcome_response->status_code === 200 ){

			//kit de la api
			$welcome_resource = $welcome_response->campaign;

			$coupon_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_id.'/update', [
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				'form_params' => [
					'name' => $request->name,
					'message' => $request->name,
					'url' => 'http://dementecreativo.com/prueba/final/movil/promocion/' . $welcome_resource->id,
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
						'coupon' => intval($coupon_id),
						'trigger_name' => 'ENTRY',
						'trigger_entity' => 'tag',
						'visit_number' => $request->number_visits,
						'tag' => intval($tag_id)
					]

				);

				//Location
				$content_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/contents/'.$content_id.'/update', $parameters_content);

				//Json parse
				$json_content = $content_api->getBody();

				$content_response = json_decode($json_content);

				if ( $content_response->status_code === 200 ) {

						foreach ($content_response as $key => $value) {
							if ($key == "campaign-content") {
								$content_api = $value;
							}
						}

						// elimino la imagen generada previamente
						// para generarla nuevamente con los datos modificados
						//
						Storage::delete($welcome_old->image_promotion);

						$image = $request->file('imagenPromo');

						$image = $this::mueveArchivo( $image, $promotion_id );

						$message = (empty($request->message) ? '¡FELICIDADES!' : $request->message );
						$img = $this::create_image( $message, $location->logo, $image, $promotion_id );

						DB::beginTransaction();
						try {


							$welcome_kit->image_promotion = $image == 0 ? '' : $image;
							$welcome_kit->name = (isset($request->name)) ?
									$welcome_resource->name :
									$welcome_old->name;

							$welcome_kit->description = (isset($request->description)) ?
									$request->description :
									$welcome_old->description;

							$welcome_kit->message = (isset($request->message)) ?
									$request->message :
									'¡FELICIDADES!';

							$welcome_kit->number_visits = (isset($request->number_visits)) ?
									$request->number_visits :
									$welcome_old->description;

							$welcome_kit->save();

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
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/contents/'.$content_api->id.'/update', $parameters_content);


							$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/update', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
								'form_params' => [
									'name' => $coupon_old->name,
									'description' => $coupon_old->description,
									'message' => $coupon_old->message,
									'url' =>  $coupon_old->url,
								]
							]);

							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/update', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
								'form_params' => [
									'name' => $welcome_old->name,
									'description' => $welcome_old->description,
									'start_time' => $welcome_old->start_time,
									'end_time' => $welcome_old->end_time,
								]
							]);

							return redirect()->route('all_welcome_kit')->with(['status' => 'Error al ingresar la promoción', 'type' => 'error']);

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
							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/contents/'.$content_api->id.'/update', $parameters_content);


							$client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_resource->id.'/update', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
								'form_params' => [
									'name' => $coupon_translation_old->name,
									'description' => $coupon_translation_old->description,
									'message' => $coupon_translation_old->message,
									'url' =>  $coupon_old->url,
								]
							]);

							$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/update', [
								'headers' => ['Authorization' => 'Bearer '.$crud ],
								'form_params' => [
									'name' => $welcome_old->name,
									'description' => $welcome_old->description,
									'start_time' => $welcome_old->start_time,
									'end_time' => $welcome_old->end_time,
								]
							]);

							return redirect()->route('all_welcome_kit')->with(['status' => 'Error al ingresar la promoción', 'type' => 'error']);
						}


						DB::commit();

						return redirect()->route('all_welcome_kit')
								->with(['status' => 'Se ha actualizado la promoción con éxito', 'type' => 'success']);

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

					$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/update', [
						'headers' => ['Authorization' => 'Bearer '.$crud ],
						'form_params' => [
							'name' => $welcome_old->name,
							'description' => $welcome_old->description,
							'start_time' => $welcome_old->start_time,
							'end_time' => $welcome_old->end_time,
						]
					]);

					//codigo para revertir transaccion

					return redirect()->route('all_welcome_kit')
									->with(['status' => 'Error al actualizar la promoción', 'type' => 'error']);
				}

			} else {

				//codigo para revertir transaccion
				$client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_resource->id.'/update', [
					'headers' => ['Authorization' => 'Bearer '.$crud ],
					'form_params' => [
						'name' => $welcome_old->name,
						'description' => $welcome_old->description,
						'start_time' => $welcome_old->start_time,
						'end_time' => $welcome_old->end_time,
					]
				]);

				return redirect()->route('all_welcome_kit')
								->with(['status' => 'Error al actualizar la promoción', 'type' => 'error']);
			}

		} else {
			return redirect()->route('all_welcome_kit')
							->with(['status' => 'Error al actualizar la promoción', 'type' => 'error']);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy_welcome_kit( $promotion_id )
	{
		// Nuevo cliente con un url base
		$client = new Client();

		//Token Crud
		$crud = WelcomeKitController::crud();

		$welcome_kit = Promotion::where([
								['promotion_id', '=', $promotion_id],
							])->first();

		// leo el codigo del coupon de la campaña en la api 
		//
		$welcome_coupon_api = $client->get('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$promotion_id.'/contents', [
			'headers' => ['Authorization' => 'Bearer '.$crud ]
		]);

		//Json parse
		$json_welcome_coupon = $welcome_coupon_api->getBody();

		$welcome_coupon_response = json_decode( $json_welcome_coupon );

		// todo este andamiaje es por el sigo '-' de campaign-contents
		//
		$campaign_contents = "campaign-contents"; 
		$id = $welcome_coupon_response->$campaign_contents;
		$coupon_id = $id[0]->content->id;

		//Coupon delete in API
		$coupon_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/coupons/'.$coupon_id.'/delete', [
			// un array con la data de los headers como tipo de peticion, etc.
			'headers' => ['Authorization' => 'Bearer '.$crud ],
		]);

		//Json parse
		$json_coupon = $coupon_api->getBody();

		$coupon_response = json_decode($json_coupon);

		if ($coupon_response->status_code === 200) {

			// Del campaign in API
			$welcome_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/campaigns/'.$welcome_kit->promotion_id.'/delete', [
						// un array con la data de los headers como tipo de peticion, etc.
						'headers' => ['Authorization' => 'Bearer '.$crud ]
				]);

			//Json parse
			$json_welcome = $welcome_api->getBody();

			$welcome_response = json_decode($json_welcome);
			if ($welcome_response->status_code === 200 ) {

				Promotion::where([['promotion_id', '=', $welcome_kit->promotion_id], ])->delete();

				return redirect()->route('all_welcome_kit')
								->with(['status' => 'Se ha Eliminado la promoción con éxito', 'type' => 'success']);
			} else {

				return redirect()->route('all_welcome_kit')
							->with(['status' => 'Error al eliminar la promoción1', 'type' => 'error']);
			}

		} else {

			return redirect()->route('all_welcome_kit')
								->with(['status' => 'Error al eliminar la promoción2', 'type' => 'error']);
		}
	}

	public function habilitar_welcomekit( $id )
	{


		$user = Auth::user();

		$welcome = Promotion::where([
								['user_id', '=', $user->user_id ],
								['promotion_id', '=', $id]
							])->first();
		
		$status = ( $welcome->status == 0 ) ? 1 : 0;
		$welcome->status = $status;
		$welcome->save();

		return $status;
	}


	public static function create_image( $message, $logo, $image, $cod_promotion )
	{

		//
		// En los controles de Img las coordendas son x,y en pixeles
		//
		
		$file_original  = 'img/origin_promotions.png';


		// Estructura del directorio para las promociones
		//
		//      promos/content -> guarda las imagenes que se incluyen en el coupon (mueveArchivo)
		//      promos/promotion -> guarda la imagen base de la promoción (create_image)
		//      promos/coupons -> guarda el coupon que se genera al vuelo y se envia al cell (generate_code_image)
		//
		$file_promotion = 'assets/images/promos/promotion/' . $cod_promotion . '.png';

		// create Image from file
		//
		try {

			$img = Img::make( $file_original );
			$ancho_lienzo = $img->width();
			$font_img = '/home/ptorres/www/beacon/public/assets/img/font/Intro.otf';
			//$font_img = '/home/demente/public_html/prueba/final/img/font/Intro.otf';


			// Insert a logo
			//
			$logo_preview = Img::make( $logo );
			$logo_preview->resize(null, 70, function ($constraint) {
			    $constraint->aspectRatio();
			});
			$img->insert($logo_preview, 'top', 10,5);

			$rows = explode("\n", str_replace("\r", "", $message));
			$nro_linea = 100;

			foreach ($rows as $row) {
				
				$img->text($row, 125, $nro_linea, function($font){ 
					$font->file( '/home/ptorres/www/beacon/public/assets/img/font/Intro.otf' );
					$font->size(15);
					$font->align('center');
					$font->color('#ff8c00');
				});
				$nro_linea += 18;
			}

			// Insert a image promo
			//
			$image_promo = Img::make( $image );
			// prevent possible upsizing
			$image_promo->resize(null, 100, function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			});
/*			$image_promo->resize(null, 100, function ($constraint) {
				$constraint->aspectRatio();
			});
*/
			$width_layer = $img->width()/2;
			$width_promo = $image_promo->width()/2;
			$center =  $width_layer - $width_promo;		
			
			$img->insert($image_promo, 'top-left', 70, 180); //180

			// RECTANGULO PARA EL CODIGO
			//
			$img->rectangle(45, 285, 214, 312, function ($draw) {
			    $draw->background('#c5c5c5');
			    $draw->border(1, '#616161');
			});
			// serial text
			//
			$img->text('SERIAL',125,325, function($font){
				$font->file( '/home/ptorres/www/beacon/public/assets/img/font/Intro.otf' );
				$font->size(12);
				$font->align('center');
				$font->color('#616161');
			});
			// LINE TEXT
			//
			$img->text('VÁLIDO HASTA',130,350, function($font){
				$font->file( '/home/ptorres/www/beacon/public/assets/img/font/Intro.otf' );
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

		// create Image from file
		try {

			$user = Auth::user();

			$promotion = Promotion::where([
									['promotion_id', '=', $id],
									['user_id', '=', $user->user_id ]
								])->first();

			if ( !file_exists( $promotion->img ) )
			{

				throw new Exception('La promo no posee imagen base para ser generada...');
			}

			$code_secret = trim(substr( str_shuffle( 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789' ), 0, 10 ));
			$file_promotion = 'assets/images/promos/coupons/' . $promotion->promotion_id.'_'.$code_secret . '.png';
			$img = Img::make( $promotion->img );
			$font_img = '/home/demente/public_html/prueba/final/img/font/Intro.otf';

			// show secret code
			$img->text($code_secret, 78, 305, function($font){
				$font->file( '/home/ptorres/www/beacon/public/assets/img/font/Intro.otf' );
				$font->size(15);
				$font->color('#b00a16');
			});

			// DATE VALIDED
			$date_valided_format = date('d.m.Y h:i:s a', (strtotime ("+1 Hour")));			
			$img->text( $date_valided_format, 128, 370, function($font){
				$font->file( '/home/ptorres/www/beacon/public/assets/img/font/Intro.otf' );
				$font->size(15);
				$font->align('center');
				$font->color('#ff8c00');
			});
			$img->save( $file_promotion );


			// Almaceno los datos en la tabla que corresponde
			//
			$coupon_promotion = New CouponPromotion();
			$coupon_promotion->code_coupon     = $code_secret;
			$coupon_promotion->img_coupon      = $file_promotion;
			$coupon_promotion->used_coupon     = 0; //no está usado
			$coupon_promotion->promotion_id    = $promotion->promotion_id;
			$coupon_promotion->user_id         = $promotion->user_id;
			$coupon_promotion->save();


		} catch (Exception $e) {

		    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
		return view( 'promotion', ['promotion' => $file_promotion ] );
	}


	private static function mueveArchivo( $objImagen, $cod_promotion )	
	{
		try {
			
			if ( !is_null( $objImagen ) and $objImagen->isValid() ) {

				//path donde se almacenara la imgen de la promocion
				$path = 'assets/images/promos/content/';

				switch ($objImagen->getMimeType())
				{
					case "image/jpeg":
					case "image/png":

						$nombre = $objImagen->getClientOriginalName();
						$nombre = $cod_promotion.'_'.$nombre;

						$objImagen->move($path, $nombre);
						break;
				}
			}
			else {
				return 0;
			}
			return $path.$nombre;

		} catch (Exception $e) {
			dd( $e->getMessage() );
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}

	}

}
