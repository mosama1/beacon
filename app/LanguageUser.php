<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class LanguageUser extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'user_id', 'language_id'
	];

	// public function user()
	// {
	// 	return $this->belongsToMany('Beacon\User');
	// 	return $this->belongsToMany('Beacon\User', 'role_user', 'user_id', 'role_id');
	// }

	// public function language()
	// {
	//     return $this->belongsTo('Beacon\Language', 'language_id', 'id' );
	// }
	//
	// public function user()
	// {
	//     return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
	// }



}
