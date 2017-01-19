<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Beacon extends Model
{
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'beacon_id', 'user_id', 'name', 'major', 'minor',
	];
	
	public function user()
	{
		return $this->belongsTo('Beacon\User', 'user_id', 'id');
	}
}
