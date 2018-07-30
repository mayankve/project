<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use DB;
use App\Airline;
use App\TripAirline;
use Illuminate\Support\Facades\Auth;
use App\TripAddonAirline;
use App\TripHotel;
use App\TripAddonHotel;
use App\TripAddonTraveler;
use App\Trip;
use App\User;
use App\Country;
use App\UserProfile;


class CartController extends Controller
{
     /**
     * Function to return cart view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
		session_start();
		//echo'<pre>';print_r($_POST);die;
		$_SESSION['card_item']=$_POST;
		return redirect('cart');
		
    }
	
	public function addtocart()
	{
		session_start();				
		//echo '<pre>';$_SESSION['card_item'];die;
		$userId = Auth::id();
		$trip=!empty($_SESSION['card_item']['trip_id'])?$_SESSION['card_item']['trip_id']:'';
		$trip_flight_id=!empty($_SESSION['card_item']['flight_id'])?$_SESSION['card_item']['flight_id']:'';
		$trip_hotel_id=!empty($_SESSION['card_item']['selected_hotel'])?$_SESSION['card_item']['selected_hotel']:'';
		$selected_add_on_id=!empty($_SESSION['card_item']['selected_addons'])?$_SESSION['card_item']['selected_addons']:'';
		$selected_addon_travelers=!empty($_SESSION['card_item']['selected_addon_traveler'])?$_SESSION['card_item']['selected_addon_traveler']:'';
		$selected_addon_flight=!empty($_SESSION['card_item']['addon_flight_name'])?$_SESSION['card_item']['addon_flight_name']:'';
		$selected_addon_hotel=!empty($_SESSION['card_item']['selected_addon_hotel'])?$_SESSION['card_item']['selected_addon_hotel']:'';
		$trip_hotel_amount=!empty($_SESSION['card_item']['trip_hotel_amount'])?$_SESSION['card_item']['trip_hotel_amount']:'';
		$finaladd_on_amount=!empty($_SESSION['card_item']['final_add_amount'])?$_SESSION['card_item']['final_add_amount']:'';
		
		//trip travelere info //
		
		$data['tripTravelers'] = DB::table('trip_traveler')
                ->where('trip_id', '=', $trip)
                ->where('user_id', '=', $userId)
                ->where('status', '=', '1')
                ->get();
				
		//		
		
		// trip flight info//
		
                $data['tripAirlines'] = DB::table('trip_airline')
                ->leftjoin('airlines', 'trip_airline.airline_name', '=', 'airlines.id')
                ->select('trip_airline.*', 'airlines.*')
                ->where('trip_airline.trip_id', '=', $trip)
                ->where('airlines.id', '=',$trip_flight_id)                
                ->get();
		// end here//		
		
		
		
		//Trip Hotels details
                $data['tripHotels'] = DB::table('trip_hotel')
                ->select('trip_hotel.*')
                ->where('trip_hotel.trip_id', '=', $trip)
				 ->where('trip_hotel.id', '=', $trip_hotel_id)
                ->where('trip_hotel.status', '=', '1')
                ->get();

		// end here //
		
		
		$final=array();
		if(!empty($selected_add_on_id) && !empty($selected_addon_flight) && !empty($selected_addon_hotel) && !empty($selected_addon_travelers)){
			foreach(array($selected_add_on_id,$selected_addon_flight,$selected_addon_hotel,$selected_addon_travelers) as $arr){
					foreach($arr as $key=>$value){					
						 $final[$key][] = $value;
					}				
			}
		}else{			
			$final='';
		}
		
		
		//echo '<pre>';print_r($final);die;
		/*$addondetail=array();
		$addonflight=array();
		$addonhotel=array();
		$addtravelere=array();
		// add on info now/
		
			/*foreach($selected_add_on_id as $key =>$value)
			{
				
				$addons=DB::select('select * from trip_addon where trip_id='.$trip.' and status="1" and id='.$value.'');
				 array_push($addondetail,$addons);
			}
			
			//echo '<pre>';print_r($addondetail);die;
		

			foreach($selected_addon_flight as $keyflight=>$valueflight)
				{
					$flight_data= DB::table('trip_addon_airline')
								->join('airlines', 'trip_addon_airline.airline_name', '=', 'airlines.id')
								->where('trip_addon_airline.trip_id', '=', $trip)
								->where('trip_addon_airline.addon_id', '=', $value)
								->where('trip_addon_airline.status', '=', '1')
								->where('airlines.id', '=', $valueflight)
								->get();
						array_push($addonflight,$flight_data);					
				}
			//	echo '<pre>';print_r($addonflight);die;			
			
			
			foreach($selected_addon_hotel as $keyhotel=>$valuehotel)
				{
						$hote_data=DB::table('trip_addon_hotel')
									->where('trip_id', '=', $trip)
									->where('id', '=', $valuehotel)
									->where('status', '=', '1')
									->get();
						array_push($addonhotel,$hote_data);					
				}
			//	echo '<pre>';print_r($addonhotel);die;
		
			
			foreach($selected_addon_travelers as $keytravelere =>$valuetravelere)
			{
				foreach($valuetravelere as $keytravelere1=>$valuetravelere1)
				{
					$travelere=  DB::table('trip_traveler')
								->where('trip_id', '=', $trip)
								->where('id', '=', $valuetravelere1)
								->where('status', '=', '1')
								->get();
					array_push($addtravelere,$travelere);				
					
				}
			}
			
		// end here //*/
		//echo '<pre>';print_r($addtravelere);die;
		
		$dashboardData = $this->dashboardElements();		
		
        return view('cart',['data'=>$dashboardData,'tripdata'=>$data,'final'=>$final,'trip_id'=>$trip,'finaladd_on_amount'=>$finaladd_on_amount]);
	}
    
    /**
     * Function to add the flighs of Trip to the cart
     * @param $request
     * @return \Illuminate\Http\Response
     */
    
		
	
    public function addFlightToCart(Request $request) {
        $itemType = $request->input('item_type');
        $tripId = $request->input('trip_id');
        $flightId = $request->input('flight_id');
        $cart = array();
        
        //Check the items to be added to the session cart
        //  switch($itemType){
        //Airline details to be added into cart
        // case 'airlines' : 
        
        $airlineInfo = DB::table('trip_airline')
           ->join('airlines', 'trip_airline.airline_name', '=', 'airlines.id')
           ->select('trip_airline.*', 'airlines.name')
           ->where('trip_airline.airline_name', '=', $flightId)
           ->where('trip_airline.trip_id', '=', $tripId)
           ->where('trip_airline.airline_departure_date', '>', date('Y-m-d'))
           ->where('trip_airline.status', '=', '1')
           ->get();
            $cart = json_encode($airlineInfo);
            session(['cart_airline' => $cart]);
             
          //  array_push($cart,$airlineInfo);
//                break;
//          //Hotel details to be added into cart
//            case 'hotels':
//                $hotelInfo = array();
//                $hotelInfo = DB::table('trip_hotel')
//                 ->where('trip_hotel.trip_id', '=', $tripId)
//                 ->where('trip_hotel.status', '=', '1')
//                 ->get();
//            array_push($cart,$hotelInfo);
//                break;
//        //Addon details to be added into cart
//            case 'addon':
//                $addonInfo = array();  
//                 $airlineInfo = DB::table('trip_addon')
//                 ->where('trip_addon.trip_id', '=', $tripId)
//                 ->where('trip_addon.status', '=', '1')
//                 ->get();   
//            array_push($cart,$addonInfo);
//                break; 
//            
//        //Addon Traveler cost to be added into cart
//            case 'addon-traveler':
//                $addonTravlerCost = array();  
//            array_push($cart,$addonTravlerCost);
//                break;
//            
//        //Addon Hotel cost to be added into cart
//        case 'addon-hotel':
//        $addonHotel = array();  
//        $addonHotelCost = DB::table('trip_addon_hotel')
//        ->where('trip_id', '=', $tripId)
//        ->where('status', '=', '1')
//        ->get(); 
//        array_push($cart,$addonHotel);
//            break;
//        //Addon flight cost to be added into cart
//        case 'addon-flight':
//           $addonFlightCost= array();  
//        array_push($cart,$addonFlightCost);
//           break;
//       
//        //Included Activity hotel cost to be added into cart
//        case 'included-activity-hotel':
//           $includedActivityHotel = array();  
//        array_push($cart,$includedActivityHotel);
//           break;
//       
//        //Included Activity flight cost to be added into cart
//        case 'included-activity-flight':
//           $includedActivityFlight = array();  
//            array_push($cart,$includedActivityFlight);
//           break;
//        }
            
        echo session('cart_airline'); die;   
    }
	
	public function dashboardElements() {
        $userId = Auth::id();
        // Get all the trips for User which are active and whose end date is not null and trip is not deleted
        $trips = Trip::where('end_date', '!=', NULL)->where('status', '!=', '1')->paginate(6);
        $userTrips = DB::table('user_trip')
                ->join('trips', 'user_trip.trip_id', '=', 'trips.id')
                ->select('trips.*', 'user_trip.*')
                ->where('user_trip.user_id', '=', $userId)
                ->where('user_trip.status', '=', '1')
                ->get();
		
        //For Basic Info
        $userData = User::where('id', '=', $userId)
                ->where('status', '=', '1')
                ->first();

        //For Profile Info
        $countries = Country::all();

        $userCountry = User ::where('id', '=', $userId)
                ->where('status', '=', '1')
                ->first();

        $profileData = UserProfile::where('user_id', '=', $userId)->where('status', '=', '1')->first();
        
        $data = array(
            'user_trips' =>$userTrips,
            'user_data' => $userData,
            'countries' => $countries,
            'user_country' => $userCountry,
            'profile_data' => $profileData,
            'trips'        => $trips
        );
        return $data;
    }

}
