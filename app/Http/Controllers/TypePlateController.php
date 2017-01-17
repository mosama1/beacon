<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Beacon\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\TypePlate;
use Illuminate\Support\Facades\Input;

class BeaconController extends Controller
{

    //************************************* Plato Menu **************************************************//

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$plate = Plate::whereRaw('user_id = ? and menu_id = ?', array(Auth::user()->id, $id))->first();

    	if ($plate):
    		return view('menus.detailPlato',['plate' => $plate , 'menu_id' => $id]);
    	else:
    		return view('menus.addPlato',['menu_id' => $id]);
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

        $menu = new Plate();
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

        $menu = new Plate();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->save();


        return redirect()->route( 'show_menu' , $request->menu_id )
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


    	$plate = Plate::whereRaw(' id= ?', array( $id ) )
				    	->update(array(
                            'name' => $request->name,
                            'description' => $request->description,
				    	));


    	return redirect()->route( 'show_menu', $id )
                        ->with( [ 'status' => 'Se edito el tipo de plato', 'type' => 'success' ] );

    }


}
