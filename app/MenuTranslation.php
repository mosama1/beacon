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
        return $this->hasOne(Language::class, 'language_id', "id");
    }
    
    public function Menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
