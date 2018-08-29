<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripAddonTraveler extends Model
{
    //
	
	  public function getPendingTravler($trip_id) {
       $sql = DB::select("select * from trip_addon_traveler where is_confirm='0' and trip_id = ".$trip_id."");

        return $sql;
    }
	
	
	  public function getConfirmTravler($trip_id) {
       $sql = DB::select("select * from trip_addon_traveler where is_confirm='1' and trip_id = ".$trip_id."");

        return $sql;
    }
	
}
