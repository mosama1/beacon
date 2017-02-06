<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'coupon', 'tag', 'trigger_name', 'dwell_time', 'content_id', 'timeframe_id', 'campana_id', 'coupon_id', 'user_id', 
	];

	public function campana()
	{
	    return $this->belongsTo( 'Beacon\Campana', 'campana_id', 'campana_id');
	}

	public function coupons()
	{
	    return $this->belongsTo('Beacon\Coupon', 'coupon_id', 'coupon_id');
	}

	public function timeframes()
	{
		return $this->belongsToMany('Beacon\Timeframe', 'content_timeframes', 'content_id', 'timeframe_id')->withTimestamps();
	}
	
	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
	}

}
