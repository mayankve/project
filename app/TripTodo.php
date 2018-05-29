<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripTodo extends Model
{
    public $table = "trip_todo";

    public $fillable = [
    	'trip_id',
        'todo_name',
        'status'
    ];
}
