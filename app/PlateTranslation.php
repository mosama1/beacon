<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class PlateTranslation extends Model
{

	public $timestamps = false;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'description', 'language_id', 'plate_id','coupon_id'
	];
    
    public function language()
    {
        return $this->hasOne('Beacon\Language', 'language_id', 'id');
    }
    
    public function plate()
    {
        return $this->belongsTo('Beacon\Plate', 'plate_id', 'id');
    }
}
