<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientSessions extends Model
{
	public $timestamps = false;

    protected $fillable = [
    	'username', 'sessionID', 'serverHash'
    ];
}
