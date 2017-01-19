<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{

	public $timestamps = false;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'description', 'language_id', 'menu_id',
	];
    
    public function language()
    {
        return $this->hasOne('Beacon\Language', 'language_id', 'id');
    }
    
    public function menu()
    {
        return $this->belongsTo('Beacon\Menu', 'menu_id', 'id');
    }
}
