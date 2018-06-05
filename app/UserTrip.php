<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTrip extends Model
{
    
    /**
     * The table associated with the model.
     *
     */
    protected $table = 'user_trip';
    
    public function user()
        {
            return $this->hasOne('App\User','user_id');
        }
    public function trip()
        {
            return $this->hasOne('App\Trip','trip_id');
        }
}
