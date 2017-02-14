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
			'language_id', 'user_id'
	];

	// public function user()
	// {
	// 	return $this->belongsToMany('Beacon\User');
	// 	return $this->belongsToMany('Beacon\User', 'role_user', 'user_id', 'role_id');
	// }

	public function languages()
	{
	    return $this->belongsTo('Beacon\Language', 'language_id', 'id' );
	}

	public function users()
	{
	    return $this->belongsTo('Beacon\User', 'user_id', 'user_id');
	}



}
