<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripAddonAirline extends Model
{
    public $table = "trip_addon_airline";

    public $fillable = [
    	'trip_id',
        'addon_id',
        'airline_name',
        'airline_departure_date',
        'airline_departure_time',
        'airline_departure_location',
        'airline_layovers',
        'airline_baggage_allowance',
        'airline_our_cost',
        'airline_cost',
        'airline_due_date',
        'airline_reserve_type',
        'airline_reserve_amount',
        'status'
    ];
}
