<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripTraveler extends Model
{
    protected $table = 'trip_traveler';
      public $fillable = [
        'user_id',
    	'trip_id',
    	'name',
    	'age',
    	'first_name',
    	'last_name',
		'is_confirm',
    	'email',
    	'gender',
    	'dob',
    	'city',
        'profile_pic',
    	'password',
    	'is_passport',
    	'passport_pic',
        'passport_exp_date',
        'issuing_country',
        'country_of_birth',
    	'status'
    ];
    public function user()
    {
        return $this->hasMany('App\User','user_id');
    }
	 public function trip()
    {
        return $this->hasMany('App\Trip','trip_id');
    }
	
	
	public function getPendingTravler($trip_id) {
       $sql = DB::select("select * from trip_traveler where is_confirm='0' and trip_id = ".$trip_id."");

        return $sql;
    }
	
	
	public function getConfirmTravler($trip_id) {
       $sql = DB::select("select * from trip_traveler where is_confirm='1' and trip_id = ".$trip_id."");

        return $sql;
    }
	
}
