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
	
	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
	}

	public function contents()
	{
		return $this->belongsToMany( 'Beacon\Content', 'content_timeframes', 'timeframe_id', 'content_id')->withTimestamps();
	}

}
