<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Beacon\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\TypesPlates;
use Illuminate\Support\Facades\Input;

class TypePlateController extends Controller
{

    //************************************* Plato Menu **************************************************//

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$plate = TypePlate::whereRaw('user_id = ? and menu_id = ?', array(Auth::user()->id, $id))->first();

        $menu = Menu::where('id', '=', $menu_id)->first();

    	if ($plate):
    		return view('menus.detailPlato',['plate' => $plate ,'section_id' => $menu->section_id,  'menu_id' => $id]);
    	else:
    		return view('menus.addPlato',['section_id' => $menu->section_id, 'menu_id' => $id]);
    	endif;

    }

    /**
     * Create a new resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {

        $menu = new TypePlate();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->save();


        return redirect()->route( 'show_menu', $request->menu_id )
                        ->with( [ 'status' => 'Se creo el tipo de plato', 'type' => 'success' ] );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {

        $menu = new TypesPlates();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->language_id = 1;
        $menu->save();


        return redirect()->route( 'show_tipoPlato' )
                        ->with( [ 'status' => 'Se creo el tipo de plato', 'type' => 'success' ] );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


    	$plate = TypePlate::whereRaw(' id= ?', array( $id ) )
				    	->update(array(
                            'name' => $request->name,
                            'description' => $request->description,
				    	));


    	return redirect()->route( 'show_menu', $id )
                        ->with( [ 'status' => 'Se edito el tipo de plato', 'type' => 'success' ] );

    }


}
