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
			'coupon_id', 'user_id', 'type', 'url',
	];

	public function coupon_translation()
	{
	    return $this->hasMany('Beacon\CouponTranslation', 'coupon_id', 'id');
	}

	public function content()
	{
	    return $this->hasOne('Beacon\Content', 'coupon_id', 'coupon_id');
	}

	public function sections()
	{
	    return $this->hasMany('Beacon\Section', 'coupon_id', 'coupon_id');
	}
}
