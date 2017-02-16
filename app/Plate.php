<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'menu_id', 'user_id', 'description', 'img','status', 'madiraje', 'img_madiraje', 'coupon_id'
	];

    public function user()
    {
        return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
    }

    public function menu()
    {
        return $this->belongsTo('Beacon\Menu', 'menu_id', 'id');
    }

	public function type_plate()
	{
	    return $this->belongsTo('Beacon\TypesPlates', 'type_plate_id', 'id');
	}

	public function plate_translation()
	{
	    return $this->hasMany('Beacon\PlateTranslation', 'plate_id', 'id');
	}

	public function madiraje_photo()
	{
		return $this->hasMany('Beacon\MadirajePhoto', 'plate_id', 'id');
	} 	

}
