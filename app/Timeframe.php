<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Timeframe extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'timeframe_id', 'user_id', 'name', 'description', 'start_time', 'end_time', 'days',
	];

	public function content()
	{
	    return $this->belongsTo('Beacon\Content', 'timeframe_id', 'timeframe_id');
	}

}
