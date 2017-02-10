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
		return $this->belongsToMany('Beacon\User', 'language_users', 'user_id', 'user_id');
	}

	//
	// public function language_user()
	// {
	// 	// return $this->belongsToMany('Beacon\LanguageUser', 'id', 'language_id');
	// 	return $this->belongsToMany('Beacon\LanguageUser', 'language_users', 'user_id', 'language_id');
	// }

}
