<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranks extends Model
{

	public $timestamps = false;

    protected $fillable = [
    	'name', 'description', 'group', 'color', 'price'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'rank_id', 'id');
    }
}
