<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripAddon extends Model
{
    public $table = "trip_addon";

    public $fillable = [
    	'trip_id',
    	'addons_name',
    	'addons_detail',
    	'addons_cost',
    	'addons_our_cost',
		'addons_maximum_spots',
		'addons_minimum_spots',
		'addons_maximum_wating_spots',
    	'addons_due_date',
    	'addons_reserve_type',
    	'addons_reserve_amount',
    	'addons_image',
    	'status'
    ];
}
