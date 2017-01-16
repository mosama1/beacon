<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'session_id', 'user_id', 'name', 'type', 'price'
	];
}
