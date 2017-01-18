<?php

namespace Beacon;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use HasApiTokens, Notifiable;
    use Notifiable;

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
    	return $this->hasOne(Location::class, 'user_id');
    }
    
    
    public function beacon()
    {
    	return $this->hasOne(Beacon::class, 'user_id');
    }
    
    public function section()
    {
        return $this->hasOne(Section::class, 'user_id');
    }
    
    public function plate()
    {
        return $this->hasOne(Plate::class, 'user_id');
    }
    

}
