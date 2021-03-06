<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

	//protected $table = 'beacon.sections';
	protected $table = 'sections';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'user_id', 'coupon_id', 'name', 'price', 'status'
	];

	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
	}

	public function section_translation()
	{
	    return $this->hasMany('Beacon\SectionTranslation', 'section_id', 'id');
	}

	public function coupon()
	{
		return $this->belongsTo('Beacon\Coupon', 'coupon_id', 'coupon_id');
	}

	public function menu()
	{
	    return $this->belongsTo('Beacon\Menu', 'id', 'section_id');
	}
	
}
