<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Languagep extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'abbreviation', 'Enabled', 'predertermined'
	];

	public function users()
	{
		return $this->belongsToMany('Beacon\User', 'LanguageUser', 'id', 'id');
	}
}
