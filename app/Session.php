<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
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
		return $this->belongsTo(User::class, 'id');
	}
}
