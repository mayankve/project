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
     * Function to return cart index
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
        session_start();

        $_SESSION['card_item']=$_POST;
        //echo'<pre>';print_r($_SESSION['card_item']);die;
        return redirect('cart');
		
    }
	
	 /**
     * Function to return cart view
     * @param void
     * @return \Illuminate\Http\Response
     */
	 
	public function addtocart()
	{
		session_start();				
		
		$userId = Auth::id();
		$trip=!empty($_SESSION['card_item']['trip_id'])?$_SESSION['card_item']['trip_id']:'';
		$flight= !empty($_SESSION['card_item']['included_activity_flight'])?$_SESSION['card_item']['included_activity_flight']:'0';
		$trip_flight_id=!empty($_SESSION['card_item']['flight_id'])?$_SESSION['card_item']['flight_id']:'';
		$trip_hotel_id=!empty($_SESSION['card_item']['selected_hotel'])?$_SESSION['card_item']['selected_hotel']:'';
		$selected_add_on_id=!empty($_SESSION['card_item']['selected_addons'])?$_SESSION['card_item']['selected_addons']:'';
		$selected_addon_travelers=!empty($_SESSION['card_item']['selected_addon_traveler'])?$_SESSION['card_item']['selected_addon_traveler']:'';
		$selected_addon_flight=!empty($_SESSION['card_item']['addon_flight_name'])?$_SESSION['card_item']['addon_flight_name']:'0';
		$selected_addon_hotel=!empty($_SESSION['card_item']['selected_addon_hotel'])?$_SESSION['card_item']['selected_addon_hotel']:'';
		$trip_hotel_amount=!empty($_SESSION['card_item']['trip_hotel_amount'])?$_SESSION['card_item']['trip_hotel_amount']:'';
		$finaladd_on_amount=!empty($_SESSION['card_item']['final_add_amount'])?$_SESSION['card_item']['final_add_amount']:'';
		$add_on_flight_name= !empty($_SESSION['card_item']['add_on_flight_name'])?$_SESSION['card_item']['add_on_flight_name']:'';
		$add_on_flight_number= !empty($_SESSION['card_item']['add_on_flight_number'])?$_SESSION['card_item']['add_on_flight_number']:'';
		$add_on_departure_date= !empty($_SESSION['card_item']['add_on_departure_date'])?$_SESSION['card_item']['add_on_departure_date']:'';
		$add_on_departure_time= !empty($_SESSION['card_item']['add_on_departure_time'])?$_SESSION['card_item']['add_on_departure_time']:'';
		$add_on_land = !empty($_SESSION['card_item']['add_on_land-only'])?$_SESSION['card_item']['add_on_land-only']:'';
		$is_land_only_activity = !empty($_SESSION['card_item']['is_land_only_activity_flight'])?$_SESSION['card_item']['is_land_only_activity_flight']:'';
		$activity_flight_name = !empty($_SESSION['card_item']['activity_flight_name'])?$_SESSION['card_item']['activity_flight_name']:'';
		$activity_flight_number = !empty($_SESSION['card_item']['activity_flight_flight_number'])?$_SESSION['card_item']['activity_flight_flight_number']:'';
		$activity_flight_date = !empty($_SESSION['card_item']['activity_flight_departure_date'])?$_SESSION['card_item']['activity_flight_departure_date']:'';
		$activity_flight_time = !empty($_SESSION['card_item']['activity_flight_departure_time'])?$_SESSION['card_item']['activity_flight_departure_time']:'';
		//trip travelere info //
		
		$data['tripTravelers'] = DB::table('trip_traveler')
                ->where('trip_id', '=', $trip)
                ->where('user_id', '=', $userId)
                ->where('status', '=', '1')
                ->get();
				
		//		
		
		$flightdataaddon=array();
		if(!empty($selected_add_on_id))
		{
			foreach($add_on_land as $onlykey=>$onlyvalue)
			{
				if($onlyvalue==1)
				{
					foreach(array($add_on_flight_name,$add_on_flight_number,$add_on_departure_date,$add_on_departure_time) as $arry1)
					{
							//echo '<pre>';print_r($arry1);die;
						foreach($arry1 as $arry1key=>$arry1value){
							if(!empty($arry1value) && $arry1value != '')
								{
									$flightdataaddon[$arry1key]['manualflight'][] = $arry1value;
								}						 
						}
					}
				}else{
					if(!empty($selected_addon_flight)){
						foreach($selected_addon_flight as $addonflightkey=>$addonflightvalue)
						{
							$flightdataaddon[$addonflightkey] = $addonflightvalue;
						}
					}
				}
			}
			
		}
	//echo '<pre>';print_r($addonflightkey);die;
		// trip flight info//
		
		$data['trip_data'] = DB::table('trips')
                ->select('trips.*')
                ->where('trips.id', '=', $trip)
				 ->where('trips.status', '=', '1')
                ->first();
				
		$data['payment_data'] = DB::table('trip_reserve_payment')
                ->select('trip_reserve_payment.*')
                ->where('trip_reserve_payment.trip_id', '=', $trip)
				 ->where('trip_reserve_payment.user_id', '=', $userId)
				 ->get();
				
				
				
		  $data['tripAirlines'] = DB::table('trip_airline')
                ->leftjoin('airlines', 'trip_airline.airline_name', '=', 'airlines.id')
                ->select('trip_airline.*', 'airlines.*')
                ->where('trip_airline.trip_id', '=', $trip)
                ->where('airlines.id', '=',$trip_flight_id)                
                ->get();
		// end here//		
		
		//echo count($data['tripAirlines']);die;
		
		//Trip Hotels details
        $data['tripHotels'] = DB::table('trip_hotel')
                ->select('trip_hotel.*')
                ->where('trip_hotel.trip_id', '=', $trip)
				 ->where('trip_hotel.id', '=', $trip_hotel_id)
                ->where('trip_hotel.status', '=', '1')
                ->get();

		// end here //
		
		
		// here packing to do //
		$selecttodo=!empty($_SESSION['card_item']['selected_todo'])?$_SESSION['card_item']['selected_todo']:'';
		foreach($selecttodo as $key=>$tripTodo){			
			$data['to_do_packing'][$key]=DB::table('trip_todo')										
										->where('trip_todo.trip_id', '=', $_SESSION['card_item']['trip_id'])
									   ->where('trip_todo.id', '=', $tripTodo)
										->where('trip_todo.status', '=', '1')
										->get();
		}		
		// end here//
		
		
		
		// add_on functionality start here ...//
		
		$addondetail=array();
		$addonsetkey=array();
		$addonsetrecord = array();
		if(!empty($selected_add_on_id) && !empty($flightdataaddon) && !empty($selected_addon_hotel) && !empty($selected_addon_travelers)){
			foreach(array($selected_add_on_id,$flightdataaddon,$selected_addon_hotel,$selected_addon_travelers) as $arr){
					foreach($arr as $key=>$value){					
						 $addonsetkey[$key][] = $value;
					}				
			}	
		}else{			
			$addonsetkey='';
		}
		
		if(!empty($addonsetkey)){
				foreach($addonsetkey as $key=>$value)
				{
					$addondetail['add_on_detail'][$key]=DB::select('select * from trip_addon where trip_id='.$trip.' and status="1" and id='.$value[0].'');
					if(is_array($value[1]) && array_key_exists("manualflight",$value[1]))
					{
						$addondetail['flight_data'][$key][]=$value[1]['manualflight'];
					}else{
						$addondetail['flight_data'][$key]= DB::table('trip_addon_airline')
																		->join('airlines', 'trip_addon_airline.airline_name', '=', 'airlines.id')
																		->where('trip_addon_airline.trip_id', '=', $trip)
																		->where('trip_addon_airline.addon_id', '=', $value[0])
																		->where('trip_addon_airline.status', '=', '1')
																		->where('airlines.id', '=', $value[1])
																		->get();
					}																		
					$addondetail['hote_data'][$key]=DB::table('trip_addon_hotel')
																	->where('trip_id', '=', $trip)
																	->where('id', '=', $value[2])
																	->where('status', '=', '1')
																	->get();
																	
						if(!empty($value[3])){
							foreach($value[3] as $travelerkey=>$traveler){
									$addondetail['travler_info'][$key][]=	DB::select('select * from trip_traveler where trip_id='.$trip.' and status="1" and id='.$traveler.'');
							}
						}						
				}	
								
				foreach($addondetail['add_on_detail'] as $keyofaddondetail=>$valuofaddon)
				{
					$addonsetrecord[$keyofaddondetail]['add_on_detail']= (!empty($addondetail['add_on_detail'][$keyofaddondetail][0]))?$addondetail['add_on_detail'][$keyofaddondetail][0]:'';
					$addonsetrecord[$keyofaddondetail]['flight_data'] = (!empty($addondetail['flight_data'][$keyofaddondetail][0]))?$addondetail['flight_data'][$keyofaddondetail][0]:'';
					 $addonsetrecord[$keyofaddondetail]['hote_data'] = (!empty($addondetail['hote_data'][$keyofaddondetail][0]))?$addondetail['hote_data'][$keyofaddondetail][0]:'';
					 if(!empty($addondetail['travler_info'][$keyofaddondetail]))
					 {
						 foreach($addondetail['travler_info'][$keyofaddondetail] as $key1=>$value1)
						 {			
							 $addonsetrecord[$keyofaddondetail]['travler_info'][$key1] = $value1;
						 }
						 
					 }
				}
			}else{
				$addonsetrecord='';
			}	
	// end here add on functionality//
		//echo '<pre>';print_r($final);die;		
	
	
		// trip activity start here ..//
		$activityflight= !empty($_SESSION['card_item']['included_activity_flight'])?$_SESSION['card_item']['included_activity_flight']:'0';
		$activityhotel=!empty($_SESSION['card_item']['included_activity_hotel'])?$_SESSION['card_item']['included_activity_hotel']:'0';
		$activityflightarray=array();
		if(!empty($is_land_only_activity))
		{			
			foreach($is_land_only_activity as $is_land_only_activitykey=>$activityflightvalue)
			{				
				if($activityflightvalue==1)
				{
					foreach(array($activity_flight_name,$activity_flight_number,$activity_flight_date,$activity_flight_time) as $activityarry1)
					{						
						foreach($activityarry1 as $activityarry1key=>$activityarry1value){
							if(!empty($activityarry1value) && $activityarry1value != '')
								{
									$activityflightarray[$activityarry1key]['manualflightactivity'][] = $activityarry1value;
								}					 
						}
					}
				}else{
					if(!empty($activityflight)){
												
						foreach($activityflight as $activityflightkey=>$activityflightvalue1)
						{
							$activityflightarray[$activityflightkey] = $activityflightvalue1;
						}
					}
				}
			}
			
		}
	
		
		
		$activity=array();
			$testactivity=array();
			$activity['tripIncludedActivities'] = DB::table('trip_included_activity')
                ->where('trip_id', '=', $trip)
                ->where('activity_due_date', '>', date('y-m-d'))
                ->where('status', '=', '1')
                ->get();
		//echo '<pre>';print_r($activityflightarray);die;
				if(!empty($activity['tripIncludedActivities']) && !empty($activityhotel) && !empty($activityflightarray))
				{
					
					foreach($activity['tripIncludedActivities'] as $key=>$value)
					{
						if(array_key_exists($value->id,$activityflightarray))
						{
							if(is_array($activityflightarray[$value->id]) && array_key_exists("manualflightactivity",$activityflightarray[$value->id]))
							{
								
								$activity['activity_flight'][$key][]=$activityflightarray[$value->id]['manualflightactivity'];
							}else{
								$activity['activity_flight'][$key]=DB::table('trip_included_activity_airline')
																		->where('airline_departure_date', '>', date('Y-m-d'))
																		->where('trip_id', '=', $value->trip_id)
																		->where('activity_id', '=', $value->id)
																		->whereIn('id', $flight)
																		->where('status', '=', '1')
																		->get();
							}
						}
							$activity['activity_hotel'][$key]=	DB::table('trip_included_activity_hotel')
																				->where('trip_id', '=', $value->trip_id)
																				->where('hotel_due_date', '>', date('Y-m-d'))
																				->where('activity_id', '=', $value->id)
																				->whereIn('id', $activityhotel)
																				->where('status', '=', '1')
																				->get();
					}				
					
					for($i = 0; $i < count($activity['tripIncludedActivities']); $i++){
								$testactivity[$i]['tripIncludedActivities'] = $activity['tripIncludedActivities'][$i];
								$testactivity[$i]['activity_flight'] = (!empty($activity['activity_flight'][$i][0]))?$activity['activity_flight'][$i][0]:'';
								$testactivity[$i]['activity_hotel'] = (!empty($activity['activity_hotel'][$i][0]))?$activity['activity_hotel'][$i][0]:'';
						
						}
					
				}else{
					
					$testactivity='';
				}
	//echo '<pre>';print_r($test);die;
		$dashboardData = $this->dashboardElements();	
        return view('cart',['data'=>$dashboardData,'tripdata'=>$data,'final'=>$addonsetrecord,'trip_id'=>$trip,'finaladd_on_amount'=>$finaladd_on_amount,'tripIncludedActivities'=>$testactivity]);
	}
    
	
	
    /**
     * Function to remove item from cart
     * @return \Illuminate\Http\Response
     */
	
	
	public function removecart()
	{
		session_start();
		unset($_SESSION['card_item']);
		return redirect('cart');
		
	}	
	
	
	    /**
     * Function to checkout
     * @param $request
     * @return \Illuminate\Http\Response  */
    	
    
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
	
	
	
	// process to checkout
	
	
	public function processtocheckout(Request $request)
	{		
		session_start();
		
		$userId = Auth::id();
		$trip=!empty($_POST['trip_id'])?$_POST['trip_id']:'';
		$trip_flight_id=!empty($_POST['trip_flight_id'])?$_POST['trip_flight_id']:'';
		$trip_travelere=!empty($_POST['trip_traveler_id'])?$_POST['trip_traveler_id']:'';
		$trip_hotel_id=!empty($_POST['trip_hotel_id'])?$_POST['trip_hotel_id']:'';
		$selected_add_on_id=!empty($_POST['add_on_id'])?$_POST['add_on_id']:'';
		$selected_addon_travelers=!empty($_POST['add_on_traveler_id'])?$_POST['add_on_traveler_id']:'';
		$selected_addon_flight=!empty($_POST['add_on_flight_id'])?$_POST['add_on_flight_id']:'';
		$selected_addon_hotel=!empty($_POST['add_on_hotel_id'])?$_POST['add_on_hotel_id']:'';
		$trip_hotel_amount=!empty($_POST['add_on_hotel_id'])?$_POST['add_on_hotel_id']:'';
		$includedactivity_id=!empty($_POST['includedactivity_id'])?$_POST['includedactivity_id']:'';
		$includedactivity_flight_id=!empty($_POST['includedactivity_flight_id'])?$_POST['includedactivity_flight_id']:'';
		$includedactivity_hotel_id=!empty($_POST['includedactivity_hotel_id'])?$_POST['includedactivity_hotel_id']:'';
		$packing_list=!empty($_POST['packing_list'])?$_POST['packing_list']:'';
		$add_on_flight_name= !empty($_SESSION['card_item']['add_on_flight_name'])?$_SESSION['card_item']['add_on_flight_name']:'';
		$resever_pay_amount= !empty($_POST['resever_pay_amount'])?$_POST['resever_pay_amount']:'';
		// manual flight//

		
		$addonfinal=array();
		$includeacitvitfinal=array();
		if(!empty($selected_add_on_id)  && !empty($selected_addon_hotel) && !empty($selected_addon_travelers)){
			foreach(array($selected_add_on_id,$selected_addon_flight,$selected_addon_hotel,$selected_addon_travelers) as $arr){				
					foreach($arr as $key=>$value){					
						 $addonfinal[$key][] = $value;
					}				
			}			
			
		}			
		//print_r($addonfinal);die;
		if(!empty($includedactivity_id) && !empty($includedactivity_hotel_id)){
			//echo 'sdfd';die;
			foreach(array($includedactivity_id,$includedactivity_flight_id,$includedactivity_hotel_id) as $arr1){
				foreach($arr1 as $key1=>$value1){					
						 $includeacitvitfinal[$key1][] = $value1;
					}				
			}	
		}	
		
		// insert data here //
				$paymentdata['user_id']=$userId;
				$paymentdata['trip_id']=$trip;
				$paymentdata['reserve_paid_amount']=$resever_pay_amount;
				$paymentdata['status']=1;
				$paymentdata['txn_id']='HMX54887455212se';
				$paymentdata['create_date']=date('y-m-d');
				$paymentdataid = DB::table('trip_reserve_payment')->insertGetId($paymentdata);				
			
			 if(!empty($paymentdataid))
			 {				 
				$checkoutdata['user_id']=$userId;
				$checkoutdata['trip_id']=$trip;
				$checkoutdata['trip_flight_id']=$trip_flight_id;
				$checkoutdata['trip_hotel_id']=$trip_hotel_id;
				$checkoutdata['status']=1;
				$checkoutdata['traveler_ids']=$trip_travelere;
				$checkoutdata['flight_name']=$_SESSION['card_item']['flight_name'];
				$checkoutdata['flight_number']=$_SESSION['card_item']['flight_number'];
				$checkoutdata['flight_departure_date']=$_SESSION['card_item']['departure_date'];
				$checkoutdata['flight_departure_time']=$_SESSION['card_item']['departure_time'];
				$checkoutdata['create_date']=date('y-m-d');
				$checkoutdata['payment_id']=$paymentdataid;
				$insertcheckoutid = DB::table('checkout')->insertGetId($checkoutdata);			 
				 
				 if(!empty($addonfinal))
				 {
					 foreach($addonfinal as $addonkey=>$addonvalue)
					 {						 
						 $addondata['user_id']=$userId;
						 $addondata['trip_id']=$trip;
						 $addondata['add_on_id']=$addonvalue[0];
						 $addondata['flight_id']=(!empty($addonvalue[1]))?$addonvalue[1]:'';
						 $addondata['hotel_id']=(!empty($addonvalue[2]))?$addonvalue[2]:'';
						 $addondata['checkout_id']=$insertcheckoutid;
						 $addondata['payment_id']=$paymentdataid;
						 $addondata['created_date']=date('y-m-d');
						 $insertaddondataid = DB::table('trip_addon_booking')->insertGetId($addondata);
						 
						 // travlere detail //
						 
							foreach($addonvalue[3] as $addonvaluekey=>$addonvalue1)
							{
								$traveleredata['user_id']=$userId;
								$traveleredata['trip_id']=$trip;
								$traveleredata['addon_id']=$addonvalue[0];
								$traveleredata['traveler_id']=$addonvalue1;
								$traveleredata['checkout_id']=$insertcheckoutid;
								$traveleredata['payment_id']=$paymentdataid;
								$traveleredata['created_date']=date('y-m-d');
								$traveleredata['status']='1';
								$inserttravelerdataid = DB::table('trip_addon_traveler')->insertGetId($traveleredata);
							}						 
						 //end here // 
					 }
					 
				 }
				 
				 if(!empty($includeacitvitfinal))
				 {
					 
					 foreach($includeacitvitfinal as $includeacitvitfinalkey=>$includeacitvitfinalvalue)
					 {
						 $activitydata['user_id']=$userId;
						 $activitydata['trip_id']=$trip;
						 $activitydata['activity_id']=(!empty($includeacitvitfinalvalue[0]))?$includeacitvitfinalvalue[0]:'';
						 $activitydata['activity_flight_id']=(!empty($includeacitvitfinalvalue[1]))?$includeacitvitfinalvalue[1]:'';
						 $activitydata['activity_hotel_id']=(!empty($includeacitvitfinalvalue[2]))?$includeacitvitfinalvalue[2]:'';
						 $activitydata['checkout_id']=$insertcheckoutid;
						 $activitydata['payment_id']=$paymentdataid;
						 $activitydata['create_date']=date('y-m-d');
						 $activitydata['status']='1';
						 $insertactivitydataid = DB::table('trip_included_activity_booking')->insertGetId($activitydata);
						 
					 }
					 
				 }			 
				 echo 'paymentdone';die;	
			 }
	}
    /* 
     * Function to return view for EMI Calculation while checkout
     */
    public function emiCalculator(){
        
        $data = $this->dashboardElements();
	      return view('emi_calculation', ['data' => $data]);
        
    }
    
}
