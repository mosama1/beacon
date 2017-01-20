<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Campana extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'campana_id', 'user_id', 'name', 'description', 'start_time', 'end_time', 'location', 'enabled',
	];

	public function content()
	{
	    return $this->hasOne('Beacon\Content', 'campana_id', 'campana_id');
	}
}
