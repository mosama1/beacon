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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

	public function type_plate()
	{
	    return $this->belongsTo(TypesPlates::class, 'type_plate_id', 'id');
	}

	public function plate_translation()
	{
	    return $this->hasOne(PlateTranslation::class, 'plate_id', 'id');
	}
}
