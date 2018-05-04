<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
	
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_profile';
	
    public function user()
    {
        return $this->hasOne('App\User','user_id');
    }
}
