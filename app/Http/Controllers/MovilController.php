<?php

namespace Beacon\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Beacon\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Beacon\Tag;
use Beacon\Coupon;
use Beacon\Timeframe;
use Beacon\Campana;
use Beacon\Content;
use Beacon\Beacon;
use Beacon\Section;
use Beacon\SectionTranslation;
use Beacon\Menu;
use Beacon\MenuTranslation;
use Beacon\Plate;
use Beacon\TypesPlates;
use Illuminate\Support\Facades\Input;
use Beacon\User;


class MovilController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( $campana_id )
	{

		//		echo "<pre>"; var_dump($sections);	echo "</pre>";

		return view('index', [ 'campana_id' => $campana_id, 'sections' => $this->obtener_sections_movil($campana_id), 'logo' => $this->obtener_logo_movil($campana_id) ] );

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function obtener_sections_movil( $campana_id )
	{
		$campana = Campana::where([
			['campana_id', '=', array( $campana_id ) ],
		])->first();

		//$campana->content->coupon->sections;
		$content = $campana->content;

		$coupon = Coupon::where([
			['coupon_id', '=', array( $content->coupon_id ) ],
		])->first();

		$sections = Section::where([
			['coupon_id', '=', array( $coupon->coupon_id ) ],
		])->get();

		foreach ($sections as $key => $section) {
			$section->section_translation;
		}

		//		echo "<pre>"; var_dump($sections);	echo "</pre>";

		return $sections;

	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function obtener_logo_movil( $campana_id )
	{
		$campana = Campana::where([
			['campana_id', '=', array( $campana_id ) ],
		])->first();

		$location = Location::where([
			['location_id', '=', array( $campana->location_id ) ],
		])->first();

		// echo "<pre>"; var_dump($location);	echo "</pre>";
		// return;
		return $location->logo;

	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_plate( $campana_id, $section_id )
	{
		$menus = Menu::where([
			['section_id', '=', array( $section_id ) ],
		])->get();
		foreach ($menus as $key => $menu) {
			$menu->plate;
			$menu->menu_translation;
			if ($menu->plate) {
				$menu->plate->plate_translation;
			}
		}

		//echo "<pre>"; var_dump($menus);	echo "</pre>";

		$sections = Section::all();

		return view('clientes.plates', ['sections' => $this->obtener_sections_movil($campana_id), 'menus' => $menus, 'campana_id' => $campana_id, 'section_id' => $section_id]);

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_desc_plate( $campana_id, $menu_id )
	{
	// 	$plate = Plate::where([
	// 		['menu_id', '=', array( $menu_id )]
	// 	])->first();

	// 	if ($plate) {

	// 	$plate->section;

	// 	$plate->plate_translation;
	// 	}

	// 	return view('clientes.detailPlato', ['plate' => $plate, 'section_id' => $plate->section->id]);

		$menu = Menu::where([
	 		['id', '=', array( $menu_id )]
	 	])->first();

		$menu->menu_translation;

		$menu->plate;

		$menu->section;

		//echo "<pre>"; var_dump($menu);	echo "</pre>";

		return view('clientes.detailPlato', ['sections' => $this->obtener_sections_movil($campana_id), 'menu' => $menu, 'campana_id' => $campana_id]);
	}

}
