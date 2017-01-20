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
use Beacon\SectionTranslation;
use Beacon\Menu;
//use Beacon\Plate;
//use Beacon\TypesPlates;
use Illuminate\Support\Facades\Input;
//use Beacon\User;

class SectionController extends Controller
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

    //************************************* Section Menu **************************************************//

    public function show_section($coupon_id)
    {
        $section = new Section;

        $sections = $section->where([
            ['user_id', '=', Auth::user()->id],
            ['coupon_id', '=', $coupon_id],
        ])->get();

        foreach ($sections as $key => $section) {
            $section->section_translation;
        }

        return view('menus.home', ['sections' => $sections, 'coupon_id' => $coupon_id]);
    }


    /**
     * get set of resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show_sectionMenus($section_id)
    {
        $menu = new Menu;

        $menus = $menu->where([
            ['user_id', '=', Auth::user()->id],
            ['section_id', '=', $section_id],
        ])->get();

        foreach ($menus as $key => $menu) {
            $menu->menu_translation;
        }

        return view('menus.plato', ['menus' => $menus, 'section_id' => $section_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_section(Request $request)
    {

        $section = new Section();
        $section->user_id = Auth::user()->id;
        $section->coupon_id = $request->coupon_id;
        $section->save();

        $section_translation = new SectionTranslation();
        $section_translation->section_id = $section->id;
        $section_translation->language_id = 1;
        $section_translation->name = $request->name;
        $section_translation->save();


    	return redirect()->route('show_section', $request->coupon_id)->with(['status' => 'Se ingreso Section de Menu con exito', 'type' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_section(Request $request)
    {


    	$section =  Section::find($request->id);

    	$section->delete();

	    if($section):

	    	return 1;

    	else:

    		return 0;

    	endif;

    }

}
