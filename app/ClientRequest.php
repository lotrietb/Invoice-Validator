<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientRequest extends Model
{
	protected $fillable = [
    	'request_string',
        'response_string',
        'response_status'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
