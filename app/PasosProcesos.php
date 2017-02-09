<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class PasosProcesos extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'user_id', 'paso_id', 
	];

}
