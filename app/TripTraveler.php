<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripTraveler extends Model
{
    protected $table = 'trip_traveler';
	
    public function user()
    {
        return $this->hasMany('App\User','user_id');
    }
	 public function trip()
    {
        return $this->hasMany('App\Trip','trip_id');
    }
}
