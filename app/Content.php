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
			'content_id', 'user_id', 'coupon', 'tag', 'timeframes', 'trigger_name',
	];
}
