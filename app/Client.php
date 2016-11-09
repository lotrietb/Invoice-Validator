<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $fillable = [
    	'name',
    	'description',
    	'ip_address_start',
    	'ip_address_end',
    	'uuid',
    	'password',
    	'api_token',
    ];

    public function requests()
    {
        return $this->hasMany('App\ClientRequest');
    }
}
