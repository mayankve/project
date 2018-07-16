<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

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

        $itemType = $request->input('item_type');
        $tripId = $request->input('trip_id');
        $flightId = $request->input('flight_id');
        $cart = array();
        
        //Check the items to be added to the session cart
        switch($itemType){
        //Airline details to be added into cart
            case 'airlines' : 
            $airlineInfo = DB::table('trip_airline')
               ->join('airlines', 'trip_airline.airline_name', '=', 'airlines.id')
               ->select('trip_airline.*', 'airlines.*')
               ->where('trip_airline.airline_name', '=', $flightId)
               ->where('trip_airline.trip_id', '=', $tripId)
               ->where('trip_airline.status', '=', '1')
               ->get();
            array_push($cart,$airlineInfo);
                break;
            
        //Hotel details to be added into cart
            case 'hotels':
                $hotelInfo = array();
                $hotelInfo = DB::table('trip_hotel')
                 ->where('trip_hotel.trip_id', '=', $tripId)
                 ->where('trip_hotel.status', '=', '1')
                 ->get();
                
            array_push($cart,$hotelInfo);
                break;
            
        //Addon details to be added into cart
            case 'addon':
                $addonInfo = array();  
                 $airlineInfo = DB::table('trip_addon')
                 ->where('trip_addon.trip_id', '=', $tripId)
                 ->where('trip_addon.status', '=', '1')
                 ->get();
                 
            array_push($cart,$addonInfo);
                break;
            
        //Addon Traveler cost to be added into cart
            case 'addon-traveler':
                $addonTravlerCost = array();  
            array_push($cart,$addonTravlerCost);
                break;
            
        //Addon Hotel cost to be added into cart
             case 'addon-hotel':
                $addonHotelCost = array();  
            array_push($cart,$addonHotelCost);
                break;
            
        //Addon flight cost to be added into cart
        case 'addon-flight':
           $addonFlightCost= array();  
        array_push($cart,$addonFlightCost);
           break;
       
        //Included Activity hotel cost to be added into cart
        case 'included-activity-hotel':
           $includedActivityHotel = array();  
        array_push($cart,$includedActivityHotel);
           break;
       
        //Included Activity flight cost to be added into cart
        case 'included-activity-flight':
           $includedActivityFlight = array();  
            array_push($cart,$includedActivityFlight);
           break;
        }
        
      echo"<pre>";var_dump($cart);die;
    }

}
