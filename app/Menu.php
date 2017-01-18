<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'section_id', 'user_id', 'name', 'type', 'price'
	];

	public function menus_translations()
	{
	    return $this->hasOne(MenuTranslation::class, 'menu_id', 'id');
	}
}
