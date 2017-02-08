<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class CouponTranslation extends Model
{

	public $timestamps = false;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'description', 'message', 'status', 'language_id', 'coupon_id',
	];
    
    public function language()
    {
        return $this->hasOne('Beacon\Language', 'language_id', 'id');
    }
    
    public function Coupon()
    {
        return $this->belongsTo('Beacon\Coupon', 'coupon_id', 'coupon_id');
    }
}
