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
			'name', 'description', 'language_id',
	];
    
    public function language()
    {
        return $this->hasOne('Baecon\Language', 'language_id', 'id');
    }
    
    public function plates()
    {
        return $this->hasMany('Baecon\Plate', 'type_plate_id', 'id');
    }
}
