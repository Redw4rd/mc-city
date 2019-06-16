<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketsMessages extends Model
{
	protected $table = 'tickets_messages';

	protected $fillable = [
		'message', 'ticket_id', 'user_id'
	];

    public function userdata()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
