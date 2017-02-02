<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'tag_id', 'location_id', 'user_id', 'name',
	];
	
	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
	}
	
}
