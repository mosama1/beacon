<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'description', 'number_visits', 'type', 'img', 'start_time', 'end_time', 'enabled', 'promotion_id', 'location_id', 'user_id',
	];

	public function content()
	{
		return $this->hasOne('Beacon\Content', 'promotion_id', 'promotion_id');
	}
	
	public function location()
	{
		return $this->belongsTo('Beacon\Location', 'location_id', 'location_id');
	}
	
	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
	}
}
