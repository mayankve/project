<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripAddonHotel extends Model
{
    public $table = "trip_addon_hotel";

    public $fillable = [
    	'trip_id',
        'addon_id',
        'hotel_name',
        'hotel_type',
        'hotel_cost',
        'hotel_solo_cost',
        'hotel_our_cost',
        'hotel_our_solo_cost',
        'hotel_due_date',
        'hotel_reserve_type',
        'hotel_reserve_amount',
        'status'
    ];
}
