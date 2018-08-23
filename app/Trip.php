<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
	protected $fillable = [
		'name',
		'date',
		'end_date',
		'about_trip',
		'banner_image',
		'banner_video',
		'base_cost',
		'maximum_spots',
		'minimum_spots',
		'maximum_wating_spots',
		'adjustment_date',
		'land_only_date',
		'requirement_is_passport',
		'requirement_passport_min_expiry',
		'requirement_is_visa',
		'requirement_visa_cost',
		'requirement_visa_process',
		'requirement_is_shots',
		'requirement_shots_cost',
		'requirement_is_passport',
		'requirement_passport_min_expiry',
		'requirement_is_visa',
		'requirement_visa_cost',
		'requirement_visa_process',
		'requirement_is_shots',
		'requirement_shots_cost',
		'requirement_shots_timeframe',
		'status'
	];
}