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

	public function menu_translation()
	{
	    return $this->hasMany('Beacon\MenuTranslation', 'menu_id', 'id');
	}

	public function section()
	{
	    return $this->hasOne('Beacon\Section', 'id', 'section_id');
	}

	public function plate()
	{
	    return $this->hasOne('Beacon\Plate', 'menu_id', 'id');
	}
}
