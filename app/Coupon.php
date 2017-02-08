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
<<<<<<< HEAD
			'coupon_id', 'user_id', 'type', 'url', 'status'
=======
			'coupon_id', 'user_id', 'type', 'status', 'url',
>>>>>>> 08786ef7a318c5ac9b08a94e92475cbbee872836
	];

	public function coupon_translation()
	{
	    return $this->hasMany('Beacon\CouponTranslation', 'coupon_id', 'coupon_id');
	}

	public function content()
	{
	    return $this->hasOne('Beacon\Content', 'coupon_id', 'coupon_id');
	}

	public function sections()
	{
	    return $this->hasMany('Beacon\Section', 'coupon_id', 'coupon_id');
	}
	
	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
	}
}
