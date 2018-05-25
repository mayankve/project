<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripAirline extends Model
{
    protected $table = 'trip_airline';
    
    public function trip()
    {
        return $this->hasMany('App\Trip','trip_id');
    }
}
