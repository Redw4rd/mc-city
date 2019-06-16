<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageSettings extends Model
{
    protected $fillable = [
    	'key', 'value'
    ];

    public $timestamps = false;
}
