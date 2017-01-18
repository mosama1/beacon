<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class TranslationPlate extends Model
{

	public $timestamps = false;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'description', 'language_id', 'plate_id',
	];
    
    public function language()
    {
        return $this->hasOne(Language::class, 'language_id');
    }
    
    public function plate()
    {
        return $this->belongsTo(Plate::class, 'plate_id', 'id');
    }
}
