<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
    	'title', 'slug', 'body', 'writer_id', 'published'
    ];


    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'writer_id');
    }
}
