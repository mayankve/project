<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    public $table = "user_card_details";

    public $fillable = [
    	'user_id',
		'card_holder_name',
    	'card_number',
    	'expiry_month',
    	'expiry_year',
    	'cvv',
    	'status'
    ];
    
    public function user()
    {
        return $this->hasOne('App\User','user_id');
    }
}
