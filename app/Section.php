<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

	protected $table = 'beacon.sections';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'user_id', 'coupon_id', 'name', 
	];
	
	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'id');
	}

	public function section_translation()
	{
	    return $this->hasMany('Beacon\SectionTranslation', 'section_id', 'id');
	}

	public function coupon()
	{
		return $this->belongsTo('Beacon\Coupon', 'coupon_id', 'id');
	}	
}
