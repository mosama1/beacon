<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'menu_id', 'user_id', 'description', 'img',
	];
}
