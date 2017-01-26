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
			'content_id', 'user_id', 'coupon', 'tag', 'timeframes', 'trigger_name', 'dwell_time',
	];

	public function campana()
	{
	    return $this->belongsTo( 'Beacon\Campana', 'campana_id', 'campana_id');
	}

	public function coupons()
	{
	    return $this->belongsTo('Beacon\Coupon', 'coupon_id', 'coupon_id');
	}

	public function timeframe()
	{
	    return $this->hasOne('Beacon\Timeframe', 'timeframe_id', 'timeframe_id');
	}

}
