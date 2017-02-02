<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class TypesPlates extends Model
{

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'description', 'language_id', 'user_id',
	];

    public function language()
    {
        return $this->hasOne('Beacon\Language', 'language_id', 'id');
    }

    public function plates()
    {
        return $this->hasMany('Beacon\Plate', 'type_plate_id', 'id');
    }

	public function menus()
	{
		return $this->belongsTo('Beacon\TypesPlates', 'type', 'id');
	}

	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
	}
}
