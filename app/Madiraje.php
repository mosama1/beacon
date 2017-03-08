<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Madiraje extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'nombre', 'precio', 'foto', 'status', 'user_id'
	];	

}
