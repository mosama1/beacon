<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
//use Beacon\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Beacon\Tag;
//use Beacon\Coupon;
//use Beacon\Timeframe;
//use Beacon\Campana;
//use Beacon\Content;
//use Beacon\Beacon;
//use Beacon\Section;
use Beacon\Menu;
//use Beacon\Plate;
//use Beacon\TypesPlates;
use Illuminate\Support\Facades\Input;
//use Beacon\User;

class MenuController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $coupon = Coupon::whereRaw('user_id = ? ', array(Auth::user()->id))->get();

        return view('beacons.coupon', ['coupon' => $coupon]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_menu($id)
    {
        $menu = new Menu;

        $menus = $menu->where([
            ['user_id', '=', Auth::user()->id],
            ['section_id', '=', $id],
        ])->get();

        foreach ($menus as $key => $menu) {
            $menu->menu_translation;
        }

    	return view('menus.plato',['menus' => $menus , 'section_id' => $id]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_menu(Request $request)
    {

    	$menu = new Menu();
    	$menu->section_id = $request->section_id;
    	$menu->user_id = Auth::user()->id;
    	$menu->name = $request->name;
    	$menu->type = $request->type;
    	$menu->price = $request->price;
    	$menu->save();


    	return redirect()->route('show_menu', $menu->section_id)->with(['status' => 'Se creo el plato', 'type' => 'success']);

    }


}
