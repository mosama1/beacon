<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class CouponPromotion extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'code_coupon', 'img_coupon', 'expiration_date', 'used_coupon'
	];

}

	