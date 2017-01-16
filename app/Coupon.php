<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'coupon_id', 'user_id', 'name', 'description', 'message', 'type', 'url',
	];
}
