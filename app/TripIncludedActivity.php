<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripIncludedActivity extends Model
{
    public $table = "trip_included_activity";

    public $fillable = [
    	'trip_id',
    	'activity_name',
    	'activity_detail',
    	'activity_cost',
    	'activity_our_cost',
    	'activity_due_date',
    	'activity_reserve_type',
    	'activity_reserve_amount',
    	'activity_image',
    	'status'
    ];
}
