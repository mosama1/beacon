<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Campana extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'campana_id', 'user_id', 'name', 'description', 'start_time', 'end_time', 'location', 'enabled',
	];

	public function content()
	{
	    return $this->hasOne('Beacon\Content', 'campana_id', 'campana_id');
	}

	//************************************* Plato Cliente **************************************************//
	// /**
	//  * Display a listing of the resource.
	//  *
	//  * @return \Illuminate\Http\Response
	//  */
	// public function show_menu($section_id)
	// {
	// 	$plates = Menu::where([
	// 					['user_id', '=', Auth::user()->id],
	// 					['section_id', '=', $section_id]
	// 				])->get();
	// 	$sections = Section::all(Auth::user()->id);

	// 	return view('clientes.plates', ['plates' => $plates, 'sections' => $sections]);
	// }
	
}
