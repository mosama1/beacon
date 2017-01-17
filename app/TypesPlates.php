<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class TypesPlates extends Model
{

	public $timestamps = false;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'description',
	];
}
