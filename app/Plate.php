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
			'menu_id', 'user_id', 'description', 'img',
	];

    public function user()
    {
        return $this->belongsTo('Beacon\User', 'user_id', 'id');
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
	    return $this->hasOne('Beacon\PlateTranslation', 'plate_id', 'id');
	}
}
