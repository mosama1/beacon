<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class LanguagepUser extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'user_id', 'language_id'
	];


}