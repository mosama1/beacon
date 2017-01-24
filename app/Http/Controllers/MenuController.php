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
use Beacon\Section;
use Beacon\Menu;
use Beacon\MenuTranslation;
//use Beacon\Plate;
use Beacon\TypesPlates;
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

		$coupon = Menu::where('user_id', '=', Auth::user()->id)->get();

		return view('beacons.coupon', ['coupon' => $coupon]);

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_menu($section_id, $menu_id)
	{
		$type_plates = TypesPlates::where([
			['language_id', '=', 1]
		])->get();

		$menu = new Menu;

		$menus = $menu->where([
			['user_id', '=', Auth::user()->id],
			['section_id', '=', $section_id]
		])->get();

		foreach ($menus as $key => $menu) {
			$menu->menu_translation;
			foreach ($type_plates as $key => $tipo) {
				if ($menu->type == $tipo->id ) {
					$menu->type = $tipo->name;
				}
			}
		}

		$section = Section::where('id', '=', $section_id)->first();
		$section->coupon();

		return view('menus.plato',['menus' => $menus,'type_plates' => $type_plates, 'section_id' => $section_id, 'coupon_id' => $section->coupon->coupon_id]);

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_sectionMenus($section_id)
	{
	    $type_plates = TypesPlates::where([
		   ['language_id', '=', 1],
	    ])->get();

	    foreach ($type_plates as $key => $tipo) {
		   $tipo->name;
	    }
	   
	    $menu = new Menu;

        $menus = $menu->where([
            ['section_id', '=', $section_id],
        ])->get();

        foreach ($menus as $key => $menu) {
            $menu->menu_translation;
        }

        $section = Section::where('id', '=', $section_id)->first();
        $section->coupon();

        return view('menus.plato',['menus' => $menus,'type_plates' => $type_plates, 'section_id' => $section_id, 'coupon_id' => $section->coupon->coupon_id]);

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
    	$menu->type = $request->type;
    	$menu->price = $request->price;
    	$menu->save();

    	$menu_translation = new MenuTranslation();
    	$menu_translation->menu_id = $menu->id;
    	$menu_translation->language_id = 1;
    	$menu_translation->name = $request->name;
    	$menu_translation->save();


    	return redirect()->route('show_sectionMenus', $menu->section_id)->with(['status' => 'Se creo el plato', 'type' => 'success']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_menu(Request $request, $id)
    {

    	$menu = Menu::find($id);
    	$menu->type = $request->type;
    	$menu->price = $request->price;
    	$menu->save();

    	$menu_translation = MenuTranslation::where([
						    			['menu_id', '=', $menu->id],
						    			['language_id', '=', 1]
						    		])->first();
    	$menu_translation->name = $request->name;
    	$menu_translation->save();


    	return redirect()->route('show_sectionMenus', $menu->section_id)->with(['status' => 'Se creo el plato', 'type' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_menu($id)
    {

		$menu =  Menu::find($id);
		$section_id = $menu->section_id;
		$menu->delete();

		if($menu):

			return redirect()->route('show_sectionMenus', $section_id )
						->with(['status' => 'Plato eliminado con éxito', 'type' => 'success']);

		else:

			return redirect()->route('show_sectionMenus', $section_id )
						->with(['status' => 'Error al eliminar plato', 'type' => 'error']);


		endif;
	}

	public function edit_menu($menu_id)
    {
	    $menu = Menu::where([
		   ['id', '=', $menu_id],
	    ])->first();

		$type_plates = TypesPlates::where([
				['language_id', '=', 1],
		])->get();

        return view('menus.platoEdit', ['type_plates' => $type_plates, 'menu' => $menu]);

    }

}
