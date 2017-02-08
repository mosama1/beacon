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
use Beacon\PlateTranslation;
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

		$campana = Campana::where([
			['campana_id', '=', array( $campana_id ) ],
		])->first();

		// echo "<pre>"; var_dump($campana);	echo "</pre>";
		// return;

		if ( $campana->status === 0 ): // la campaña no esta habilitada
			return view('campana_desabilitada',
					[
						'campana_id' => $campana_id,
						'sections' => $this->get_sections_movil($campana_id),
						'type_plates' => $this->get_type_plates_movil( $campana_id ),
						'logo' => $this->get_logo_movil($campana_id),
						'name' => $this->get_name_movil($campana_id)
					]);
		endif;

		return view('index',
					[
						'campana_id' => $campana_id,
						'sections' => $this->get_sections_movil($campana_id),
						'type_plates' => $this->get_type_plates_movil( $campana_id ),
						'logo' => $this->get_logo_movil($campana_id),
						'name' => $this->get_name_movil($campana_id)
					] );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function get_sections_movil( $campana_id )
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
						['status', '=', 1],
						])->get();


		foreach ($sections as $key => $section) {
			$section->section_translation;
		}

		//		echo "<pre>"; var_dump($sections);	echo "</pre>";

		return $sections;
	}

	/**
	 * Display a list of the type_plate available for a campaign.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function get_type_plates_movil( $campana_id )
	{
		$type_plates = DB::table('campaing_types_plates')
					->where([
						['campana_id', '=', $campana_id],
						['language_id', '=', 1],
						])
					->get();


		//	echo "<pre>"; var_dump($type_plates);	echo "</pre>";

		return $type_plates;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function get_logo_movil( $campana_id )
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

	public function get_name_movil( $campana_id )
	{
		$campana = Campana::where([
			['campana_id', '=', array( $campana_id ) ],
		])->first();

		$location = Location::where([
			['location_id', '=', array( $campana->location_id ) ],
		])->first();

		// echo "<pre>"; var_dump($location);	echo "</pre>";
		// return;
		return $location->name;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	 public function all_plate( $campana_id, $section_id )
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
	   $menu_ = Menu::where([
		   ['id', '=', array( $menu->id )]
	   ])->first();
	   $menu_->plate;

	   //echo "<pre>"; var_dump($menus);    echo "</pre>";

	   $sections = Section::all();


	   $sections_trans = SectionTranslation::where([
		   ['section_id', '=', array( $section_id )]
	   ])->first();

	   $coupon = Section::where([
		   ['id', '=', array( $section_id ) ],
	   ])->first()->coupon;


	   // echo "<pre>"; var_dump($coupon);    echo "</pre>";
	   // return;

	   return view('movil.plates',
				   [
					   'sections' => $this->get_sections_movil($campana_id),
					   'type_plates' => $this->get_type_plates_movil( $campana_id ),
					   'menus' => $menus,
					   'campana_id' => $campana_id,
					   'section_id' => $section_id,
					   'coupon' => $coupon,
					   'menu' => $menu_,
					   'section_name' => $sections_trans->name
				   ]);
   }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all_types_plates( $campana_id, $type_plate_id )
	{
		$menus = Menu::where([
			['type', '=', array( $type_plate_id ) ],
		])->get();
		foreach ($menus as $key => $menu) {
			$menu->plate;
			$menu->menu_translation;
			if ($menu->plate) {
				$menu->plate->plate_translation;
			}
		}

		//echo "<pre>"; var_dump($menus);	echo "</pre>";

		$type_plate = TypesPlates::where([
			['id', '=', array( $type_plate_id )],
			['language_id', '=', array( 1 )]
		])->first();

		return view('movil.filter_plates',
					[
						'sections' => $this->get_sections_movil( $campana_id ),
						'type_plates' => $this->get_type_plates_movil( $campana_id ),
						'menus' => $menus,
						'campana_id' => $campana_id,
						'type_plate' => $type_plate,
					]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show_desc_plate_by_type( $campana_id, $type_plate_id, $menu_id )
	{

		$menu = Menu::where([
			['id', '=', array( $menu_id )]
		])->first();

		$menu->menu_translation;

		$menu->plate;

		$menu->section;

		//echo "<pre>"; var_dump($menu);	echo "</pre>";

		$section_translation = SectionTranslation::where([
			['section_id', '=', $menu->section->id]
		])->first();


		return view('movil.filter_detail_plato',
					[
						'sections' => $this->get_sections_movil( $campana_id ),
						'type_plates' => $this->get_type_plates_movil( $campana_id ),
						'menu' => $menu,
						'type_plate_id' => $type_plate_id,
						'campana_id' => $campana_id,
						'section_name' => $section_translation->name,
						'nivel' => '../'
					]);
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

		// 	return view('movil.detail_plato', ['plate' => $plate, 'section_id' => $plate->section->id]);

		$menu = Menu::where([
			['id', '=', array( $menu_id )]
		])->first();

		$menu->menu_translation;

		$menu->plate;

		$menu->section;

		$section_translation = SectionTranslation::where([
			['section_id', '=', $menu->section->id]
		])->first();



		return view('movil.detail_plato',
					[
						'sections' => $this->get_sections_movil($campana_id),
						'type_plates' => $this->get_type_plates_movil( $campana_id ),
						'menu' => $menu,
						'campana_id' => $campana_id,
						'section_name' => $section_translation->name,
					]);
	}

}
