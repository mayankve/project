<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Airline;
use App\TripAirline;
use App\TripAddonAirline;
use App\TripHotel;
use App\TripAddonHotel;
use App\TripAddonTraveler;

class CartController extends Controller
{
     /**
     * Function to return cart view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Get all the items of cart 
        return view('cart');
    }
    
    /**
     * Function to add the Trip items to the cart
     * @param $request
     * @return \Illuminate\Http\Response
     */
    
    public function addToCart(Request $request) {
        
        $item_type = $request->input('item_type');  
        $trip_id = $request->input('trip_id');
        $flight_id = $request->input('flight_id');
        
        //Check the items to be added to the session  cart
        
        if($item_type == 'airlines'){
            $airline_info = DB::table('trip_airline')
                ->join('airlines', 'trip_airline.airline_name', '=', 'airlines.id')
                ->select('trip_airline.*', 'airlines.*')
                ->where('trip_airline.airline_name', '=', $flight_id)
                ->where('trip_airline.trip_id', '=', $trip_id)
                ->where('trip_airline.status', '=', '1')
                ->get();    
          
        
         // echo "<pre>";print_r($airline_info);die;
        }
       
    }
}
