<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $fillable = [
    	'type', 'message', 'user_id', 'is_locked', 'answered'
    ];

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function messages()
    {
    	return $this->hasMany('App\TicketsMessages', 'ticket_id', 'id')->orderBy('id', 'desc');
    }
}
