<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class MadirajePhoto extends Model
{

	public $timestamps = false;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'img_madiraje',
	];
	
	public function plate()
	{
		return $this->belongsTo('Beacon\Plate', 'id', 'plate_id');
	} 
}
