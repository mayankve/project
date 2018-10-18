<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripVideo extends Model
{
   public $table = "trip_video";
   public $timestamps = false;
   public $fillable = [
    	'trip_id',
    	'video_name',
    	'about_video'
    ];
    
    public function trip()
    {
        return $this->hasOne('App\Trip','trip_id');
    }
}
