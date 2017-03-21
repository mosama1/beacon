<?php

namespace Beacon;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
	use HasApiTokens, Notifiable;
	use Notifiable;
		//use AuthenticableTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'phone', 'language',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function location()
	{
		return $this->hasOne('Beacon\Location', 'user_id', 'user_id');
	}

	public function languages()
	{
		return $this->belongsTo('Beacon\Language','LanguageUser','id','id');
	}

	public function beacons()
	{
		return $this->hasMany('Beacon\Beacon', 'user_id', 'user_id');
	}

	public function sections()
	{
		return $this->hasMany('Beacon\Section', 'user_id', 'user_id');
	}

	public function plates()
	{
		return $this->hasMany('Beacon\Plate', 'user_id', 'user_id');
	}

	public function promotion()
	{
		return $this->belongsTo( 'Beacon\Promotion', 'promotion_id', 'promotion_id');
	}

	public function types_plates()
	{
		return $this->hasMany('Beacon\TypePlate', 'user_id', 'user_id');
	}


}
