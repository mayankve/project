<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripMiscExpense extends Model
{
	// table name
    public $table = "trip_misc_expense";

    // 
    protected $hidden = ['created_at', 'updated_at'];

    //
    public $fillable = [
    	'trip_id',
    	'label',
    	'value'
    ];
}
