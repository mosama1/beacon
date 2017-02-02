<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Beacon\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\Location;
use Beacon\Tag;
use Beacon\User;
use Illuminate\Support\Facades\Input;

class TagController extends Controller
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

	//************************************* Etiqueta **************************************************//

	public function index()
	{

		$user = User::where([
							[ 'id', '=', Auth::user()->id ],
						])->first();

		$location = Location::where([
							[ 'user_id', '=', Auth::user()->id ],
						])->get();

		$tags = Tag::where([
							[ 'user_id', '=', $user->user_id ],
						])->get();


		 // echo "<pre>";  var_dump($tags); echo "</pre>";
		 // return;

		return view('tags.types_plates', ['tags' => $tags, 'location' => $location] );
	}

	/**
	 * Create a new resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	 public function store_tag( Request $request )
   {

		 // Nuevo cliente con un url base
		 $client = new Client();

		 //Token Crud
		 $crud = BeaconController::crud();


		 $beacon_api = $client->post('https://connect.onyxbeacon.com/api/v2.5/tags', [
				// un array con la data de los headers como tipo de peticion, etc.
				'headers' => ['Authorization' => 'Bearer '.$crud ],
				'form_params' => [
						'name' => $request->name
				]
		 ]);

		 //echo "<pre>";		var_dump($crud); "</pre>";

		 //Json parse
		 $json_b = $beacon_api->getBody();

		 $beacons_response = json_decode($json_b);

		 if ( $beacons_response->status_code === 200 ) {

				$user = User::where([
								[ 'id', '=', Auth::user()->id ],
							])->first();

				$tag = new Tag();
				$tag->user_id = $user->user_id;
				$tag->name = $request->name;
				$tag->location_id = $request->location_id;

				if (	$tag->save() ) {
					return redirect()->route( 'all_tag' )
				                ->with( [ 'status' => 'Se creo la etiqueta', 'type' => 'success' ] );
				} else {
					return redirect()->route( 'all_tag' )
				              	->with( [ 'status' => 'Error al crear la etiqueta', 'type' => 'error' ] );
				}
		 }
		 else {
		      return redirect()->route( 'all_tag' )
		                      ->with( [ 'status' => 'Error al crear la etiqueta', 'type' => 'error' ] );
		 }

   }

	/**
	 * Edit a new resource in storage.
	 *
	 * @param  Integer $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit_tag( tag_id )
	{

		$user = User::where([
							[ 'id', '=', Auth::user()->id ],
						])->first();

		$tag = Tag::where([
							[ 'user_id', '=', $user->user_id ],
							[ 'id', '=', tag_id ]
						])->first();

		$location = Location::where([
							[ 'user_id', '=', $user->user_id ],
							[ 'id', '=', location_id ]
						])->first();

		return view('tags.types_plates_edit', ['tag' => $tag]);
	}


	/**
	 * Store an updated resource in storage.
	 *
	 * @param  Integer tag_id
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update_tag(Request $request, tag_id)
	{

		$user = User::where([
							[ 'id', '=', Auth::user()->id ],
						])->first();

		$tag = Tag::where([
							[ 'user_id', '=', $user->user_id ],
							[ 'id', '=', tag_id ]
						])->first();

		$tag->name = $request->name;
		$tag->save();

		return redirect()->route('all_tag')
			->with(['status' => 'Se ha actualizado la etiqueta satisfactoriamente', 'type' => 'success']);
	}

	/**
	 * Delete a resource in storage.
	 *
	 * @param  $id integer
	 * @return \Illuminate\Http\Response
	 */
	public function delete_tag( tag_id )
	{

		$user = User::where([
							[ 'id', '=', Auth::user()->id ],
						])->first();

		$tag = Tag::where([
							[ 'user_id', '=', $user->user_id ],
							[ 'id', '=', tag_id ]
						])->first()->delete();

		return redirect()->route('all_tag')
						->with(['status' => 'Tipo de plato eliminado con éxito', 'type' => 'success']);
	}

}
