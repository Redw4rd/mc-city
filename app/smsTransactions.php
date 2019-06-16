<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class smsTransactions extends Model
{
    public $table = 'sms_transactions';

    public $fillable = [
    	'id', 'user_id', 'given_pixel'
    ];

    public function setUpdatedAtAttribute($value)
	{
	    // to Disable updated_at
	}

    public function created_at()
    {
    	return \Carbon\Carbon::now();
    }
}
