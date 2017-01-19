<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'location_id', 'user_id', 'name', 'country', 'city', 'zip', 'street', 'street_number', 'timezone', 'lat', 'lng',
	];
	
	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'id');
	}
}
