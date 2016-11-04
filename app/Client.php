<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
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
}
