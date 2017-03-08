<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Beacon\Madiraje;

class MadirajeController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$madiraje = Madiraje::where([
							['user_id', '=', Auth::user()->user_id]
						])->get();

		return view('madiraje.madiraje',['madirajes_list' => $madiraje]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// id, nombre, precio,  foto, status, user_id
		//   , name,    price, photo,      1, Auth::user()->id

		$error = false;

		$error = empty($request->name) ? true : '';
		$error = empty($request->price) ? true: '';
		$error = empty($request->file('photo')) ? true: '';

		if ( $error )
		{
			return redirect()->route('store_madiraje')->with(['status' => 'No se han indicado los campos requeridos', 'type' => 'error']);
		}

		if ( $this->check_madiraje( $request ) > 0 ) //si consiguio un madiraje con el mismo nombre
		{
			
			return redirect()->route('store_madiraje')->with(['status' => 'Madiraje ya existe', 'type' => 'error']);
		}
		else
		{

			// se obtiene la foto			
			$imagen = $request->file('photo');
			$foto_mime = $imagen->getMimeType();
			$foto =  empty($request->file('photo')) ? '' : $this->check_image( $imagen, $foto_mime );

			$new_madiraje = New Madiraje();
			$new_madiraje->nombre  = $request->name;
			$new_madiraje->precio  = isset( $request->price ) ? $request->price : 0;
			$new_madiraje->foto    = $foto ? $foto : ''  ;
			$new_madiraje->status  = 1; // 1 = activo | 0 = inactivo
			$new_madiraje->user_id = Auth::user()->user_id; // 1 = activado | 0 = inactivo
			$new_madiraje->save();

			return redirect()->route('all_madiraje')->with(['status' => 'El Madiraje se cargo exitosamente.', 'type' => 'success']);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id = '' )
	{
		if (empty( $id ))
		{
			return redirect()->route('all_madiraje');	
		}

		$madiraje = Madiraje::where([
								['id', '=', $id ]				
							])->first();

		if ( is_null($madiraje) )
		{
			return redirect()->route('all_madiraje');	
		}
		else
		{
			return view('madiraje.madiraje_edit', [ 'madiraje' => $madiraje ]);	
		}		
	}	



	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{

		// id, nombre, precio,  foto, status, user_id
		//   , name,    price, photo,      1, Auth::user()->id
		$error = false;

		$error = empty($request->name) ? true : '';
		$error = empty($request->price) ? true: '';

		if ( $error )
		{
			return redirect()->route('all_madiraje')->with(['status' => 'No se han indicado los campos requeridos', 'type' => 'error']);
		}

		// se obtiene la foto		
		if ( !empty( $request->photo ))
		{

			$imagen = $request->file('photo');
			$foto_mime = $imagen->getMimeType();
			$foto =  empty($request->file('photo')) ? '' : $this->check_image( $imagen, $foto_mime );
		}

		$up_madiraje = Madiraje::where([
				['id', '=', $id],
				['user_id', '=', Auth::user()->user_id]
			])->first();		

		$up_madiraje->nombre  = $request->name;
		$up_madiraje->precio  = isset( $request->price ) ? $request->price : 0;
		$up_madiraje->foto    = !empty($foto) ? $foto : ''  ;
		$up_madiraje->status  = 1; // 1 = activo | 0 = inactivo
		$up_madiraje->update();

		return redirect()->route('all_madiraje')->with(['status' => 'El Madiraje se cargo exitosamente.', 'type' => 'success']);

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $madiraje = '' )
	{
		if ( empty($madiraje) or !is_numeric($madiraje) ) //valido el dato del madiraje
		{
			return;
		}

		$del_madiraje = Madiraje::where([ // localizo el registro
					['id', '=', $madiraje]
				])->first();

		if ( $del_madiraje) //de existir lo elimino
		{
			$del_madiraje->delete(); 
			return redirect()->route('all_madiraje')->with(['status' => 'Madiraje eliminado exitosamente.', 'type' => 'success']);
		}
		return redirect()->route('all_madiraje')->with(['status' => 'Error al eliminar madiraje.', 'type' => 'error']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function check_madiraje(Request $request)
	{
		return $check_madiraje = Madiraje::where([
					['nombre', '=', $request->name],
					['user_id', '=', Auth::user()->user_id]
				])->count();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function search()
	{
		$term = Input::get('term');
		$results = array();
	
		$queries = Madiraje::where('nombre', 'LIKE', '%'.$term.'%')->get();
	
		foreach ($queries as $query)
		{
			$results[] = [
				'value' => $query->nombre
			];
		}
		
		return response()->json($results);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function check_image( $image, $foto_mime )
	{

		$foto = false;
		if ( !empty( $image ) ) {	

			//path donde se almacenara el foto
			$path = 'assets/images/fotos/madirajes/';

			switch ( $image->getMimeType() )
			{
				case "image/jpeg":
				case "image/png":
					if ($image->isValid())
					{

						$nombre = $image->getClientOriginalName();
						$nombre = date('dmyhis').'-'.$nombre;

						$image->move($path, $nombre);

						return 'assets/images/fotos/madirajes/'.$nombre;
					}
					break;
			}
		}
		return $foto;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function habilitar_madiraje( $id )
	{

		$madiraje = Madiraje::where([
					['id', '=', $id],
					['user_id', '=', Auth::user()->user_id]
				])->first();
		
		$status = ( $madiraje->status == 0 ) ? 1 : 0;
		$madiraje->status = $status;
		$madiraje->save();

		return $status;
	}


}
