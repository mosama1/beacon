<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class SectionTranslation extends Model
{

	protected $table = 'beacon.section_Translations';


	public $timestamps = false;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'description', 'language_id', 'section_id',
	];
    
    public function language()
    {
        return $this->hasOne('Beacon\Language', 'language_id', 'id');
    }
    
    public function section()
    {
        return $this->belongsTo('Beacon\Section', 'section_id', 'id');
    }
}
