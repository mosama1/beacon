<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'name', 'abbreviation', 'user_id'
	];

	public function users()
	{
		return $this->belongsToMany('Beacon\User', 'language_user')->withPivot('language_id');
	}

	public function users()
	{
		return $this->belongsToMany('Beacon\User', 'LanguageUser', 'id', 'id');
	}
}
