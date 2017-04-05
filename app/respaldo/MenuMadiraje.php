<?php

namespace Beacon;

use Illuminate\Database\Eloquent\Model;

class MenuMadiraje extends Model
{

	public $timestamps = false;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'menu_id','madiraje_id', 'user_id'
	];
    
    public function menu()
    {
        return $this->belongsTo('Beacon\Menu', 'menu_id', 'id');
    }
}
