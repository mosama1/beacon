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
			'name', 'description', 'start_time', 'end_time', 'enabled', 'campana_id', 'location_id', 'user_id',
	];

	public function content()
	{
	    return $this->hasOne('Beacon\Content', 'campana_id', 'campana_id');
	}
	
	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
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

	// 	return view('movil.plates', ['plates' => $plates, 'sections' => $sections]);
	// }
	
}
