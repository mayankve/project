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
use Helper;


class CartController extends Controller
{
     /**
     * Function to return cart index
     * @param void
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) {
       // session_start();
       $request->session()->put('card_item', $_POST);
       return redirect('cart');
    }
	
	 /**
     * Function to return cart view
     * @param void
     * @return \Illuminate\Http\Response
     */
	 
	public function addtocart(Request $request)
	{ 
		//echo '<pre>';print_r($request->session()->get('card_item'));
		//exit;
		//session_start();				
		
		$userId = Auth::id();
		$trip				=	!empty($request->session()->get('card_item')['trip_id'])?	                 $request->session()->get('card_item')['trip_id']:'';
		$tripis_land_only	=	$request->session()->get('card_item')['is_land_only'];
		$flight				= 	!empty($request->session()->get('card_item')['included_activity_flight'])?       $request->session()->get('card_item')['included_activity_flight']:'0';
		$trip_flight_id		=	!empty($request->session()->get('card_item')['flight_id'])?                    $request->session()->get('card_item')['flight_id']:'';
		$trip_hotel_id		=	!empty($request->session()->get('card_item')['selected_hotel'])?               $request->session()->get('card_item')['selected_hotel']:'';
		$selected_add_on_id	=	!empty($request->session()->get('card_item')['selected_addons'])?             $request->session()->get('card_item')['selected_addons']:'';
		$selected_addon_travelers=	!empty($request->session()->get('card_item')['selected_addon_traveler'])? $request->session()->get('card_item')['selected_addon_traveler']:'';
		$selected_addon_flight	=	!empty($request->session()->get('card_item')['addon_flight_name'])?        $request->session()->get('card_item')['addon_flight_name']:'0';
		$selected_addon_hotel	=	!empty($request->session()->get('card_item')['selected_addon_hotel'])?     $request->session()->get('card_item')['selected_addon_hotel']:'';
		$trip_hotel_amount		=	!empty($request->session()->get('card_item')['trip_hotel_amount'])?        $request->session()->get('card_item')['trip_hotel_amount']:'';
		$finaladd_on_amount		=	!empty($request->session()->get('card_item')['final_add_amount'])?         $request->session()->get('card_item')['final_add_amount']:'';
		$add_on_flight_name      =  !empty($request->session()->get('card_item')['add_on_flight_name'])?       $request->session()->get('card_item')['add_on_flight_name']:'';
		$add_on_flight_number    =  !empty($request->session()->get('card_item')['add_on_flight_number'])?       $request->session()->get('card_item')['add_on_flight_number']:'';
		$add_on_departure_date   =  !empty($request->session()->get('card_item')['add_on_departure_date'])?      $request->session()->get('card_item')['add_on_departure_date']:'';
		$add_on_departure_time   =  !empty($request->session()->get('card_item')['add_on_departure_time'])?      $request->session()->get('card_item')['add_on_departure_time']:'';
		$add_on_land             =  !empty($request->session()->get('card_item')['add_on_land-only'])?            $request->session()->get('card_item')['add_on_land-only']:'';
		$is_land_only_activity   =   !empty($request->session()->get('card_item')['is_land_only_activity_flight'])? $request->session()->get('card_item')['is_land_only_activity_flight']:'';
		$activity_flight_name    =   !empty($request->session()->get('card_item')['activity_flight_name'])?         $request->session()->get('card_item')['activity_flight_name']:'';
		$activity_flight_number  =   !empty($request->session()->get('card_item')['activity_flight_flight_number'])? $request->session()->get('card_item')['activity_flight_flight_number']:'';
		$activity_flight_date    =   !empty($request->session()->get('card_item')['activity_flight_departure_date'])? $request->session()->get('card_item')['activity_flight_departure_date']:'';
		$activity_flight_time   =   !empty($request->session()->get('card_item')['activity_flight_departure_time'])?  $request->session()->get('card_item')['activity_flight_departure_time']:'';
		//trip travelere info //
		//print_r($selected_addon_travelers);die;
		$data['tripTravelers'] = DB::table('trip_traveler')
                ->where('trip_id', '=', $trip)
                ->where('user_id', '=', $userId)
                ->where('status', '=', '1')
				->where('is_confirm','=','1')
                ->get();
				
		//				
		
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
		
		
		//start addon section here..//
		
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
	
		$selecttodo= !empty($request->session()->get('card_item')['selected_todo'])?$request->session()->get('card_item')['selected_todo']:array();
		foreach($selecttodo as $key=>$tripTodo){			
			$data['to_do_packing'][$key]=DB::table('trip_todo')										
										->where('trip_todo.trip_id', '=', $request->session()->get('card_item')['trip_id'])
									   ->where('trip_todo.id', '=', $tripTodo)
										->where('trip_todo.status', '=', '1')
										->get();
		}		
		// end here//
		
		
		
		
		
		
		$addondetail=array();
		$addonsetkey=array();
		$addonsetrecord = array();
		if(!empty($selected_add_on_id) && !empty($flightdataaddon) && !empty($selected_addon_hotel) && !empty($selected_addon_travelers)){
			
			foreach(array($selected_add_on_id,$flightdataaddon,$selected_addon_hotel,$selected_addon_travelers) as $keyall=>  $arr){
						foreach($arr as $key=>$value){
							$addonsetkey[$key][] = $value;
					}
									
			}	
		}else{			
			$addonsetkey=array();
		}
		
	
	//echo '<pre>';print_r($selected_addon_travelers);die;
		
		if(!empty($addonsetkey)){
				foreach($addonsetkey as $key=>$value)
				{
					$addondetail['add_on_detail'][$key]=DB::select('select * from trip_addon where trip_id='.$trip.' and status="1" and id='.$value[0].'');
					//echo '<pre>';print_r($addondetail['add_on_detail']);die;
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
							$arrtytostring= '(' . implode(',', $value[3]) .')';
							//echo $arrtytostring;
							$addondetail['travler_info'][$key]= DB::select('select * from trip_traveler where id IN '.$arrtytostring.' and  trip_id='.$trip.' and status="1" and is_confirm="1"');
							
						}						
				}	
				
	//echo '<pre>';print_r($addondetail);die;		
			
				foreach($addondetail['add_on_detail'] as $keyofaddondetail=>$valuofaddon)
				{		
					$addonsetrecord[$keyofaddondetail]['add_on_detail']= (!empty($addondetail['add_on_detail'][$keyofaddondetail][0]))?$addondetail['add_on_detail'][$keyofaddondetail][0]:'';
					$addonsetrecord[$keyofaddondetail]['flight_data'] = (!empty($addondetail['flight_data'][$keyofaddondetail][0]))?$addondetail['flight_data'][$keyofaddondetail][0]:'';
					 $addonsetrecord[$keyofaddondetail]['hote_data'] = (!empty($addondetail['hote_data'][$keyofaddondetail][0]))?$addondetail['hote_data'][$keyofaddondetail][0]:'';
					 
					 
					 //echo '<pre>';print_r($addondetail['travler_info'][$keyofaddondetail]);die;
					 
					if(!empty($addondetail['travler_info'][$keyofaddondetail]) && count($addondetail['travler_info'][$keyofaddondetail])<= $valuofaddon[0]->addons_maximum_spots)
					 {
						 //echo 'match';die;
						 $flag=1;
							
							$allreadyTravelerExists = Helper::bookTravelerAsPerUserId($trip,$confirm='1',$userId,$valuofaddon[0]->id);
							
							$bookTravelerAsPerTripIdConfirm = Helper::bookAddonAsPerTripId($trip,$confirm='1',$valuofaddon[0]->id);
							$bookTravelerAsPerTripIdPending = Helper::bookAddonAsPerTripId($trip,$confirm='0',$valuofaddon[0]->id);
							
							//echo count($bookTravelerAsPerTripIdConfirm);die;
							 $bookTravelerRemaningConfrim = $valuofaddon[0]->addons_maximum_spots - count($bookTravelerAsPerTripIdConfirm);
							 $bookTravelerRemaningPending = $valuofaddon[0]->addons_maximum_wating_spots - count($bookTravelerAsPerTripIdPending);
							 
							 
							 // chec if trip allready booked//
							
						if(!empty($allreadyTravelerExists))
						{
							//echo '<pre>';print_r($addondetail['travler_info'][$keyofaddondetail]);die;
							$userBookTravelere = count($allreadyTravelerExists);
								
								if(count($addondetail['travler_info'][$keyofaddondetail]) <= $userBookTravelere)
								{
									foreach($addondetail['travler_info'][$keyofaddondetail] as $key1=>$value1) {
										 
										// echo '<pre>';print_r($value1);die;
										 $addonsetrecord[$keyofaddondetail]['travler_info'][$key1] = $value1;	
									 }
									
									
								}							
								
								// elseif(count($addondetail['travler_info'][$keyofaddondetail]) > $userBookTravelere)
								// {
									// if($bookTravelerRemaningConfrim >0)
									// {
										// foreach($addondetail['travler_info'][$keyofaddondetail] as $key1=>$value1) {
										 
										  // $addonsetrecord[$keyofaddondetail]['travler_info'][$key1] = $value1;	
										// }										
										
									// }elseif($bookTravelerRemaningPending > 0)
									// {
										// foreach($addondetail['travler_info'][$keyofaddondetail] as $key1=>$value1) {
										 
										  // $addonsetrecord[$keyofaddondetail]['travler_info'][$key1] = $value1;	
										// }
										
										
									// }else{
										// return  redirect('mytripdesign/'.$trip)
											// ->with('error','No any spots available in addon '.$valuofaddon[0]->addons_name);	
										
									// }
									
									
								// }
							
							
							
							
						}else{						
								
							
							if($valuofaddon[0]->addons_maximum_spots <= $bookTravelerRemaningConfrim && $bookTravelerRemaningConfrim > 0)
							{
									
									foreach($addondetail['travler_info'][$keyofaddondetail] as $key1=>$value1) {
										 
										 $addonsetrecord[$keyofaddondetail]['travler_info'][$key1] = $value1;	
									}
									// exit();											
								
							}elseif($valuofaddon[0]->addons_maximum_wating_spots <= $bookTravelerRemaningPending && $bookTravelerRemaningPending > 0)
							{								
										//echo $valuofaddon[0]->id;
									foreach($addondetail['travler_info'][$keyofaddondetail] as $key1=>$value1) {
											 
											 $addonsetrecord[$keyofaddondetail]['travler_info'][$key1] = $value1;	
										}
									// exit();								
								
							}else{
								
								return  redirect('mytripdesign/'.$trip)
											->with('error','No any spots available in addon '.$valuofaddon[0]->addons_name);											
							}	
						}
							
						 
					 }else{
						 //echo 'sdfdfd';die;
						return  redirect('mytripdesign/'.$trip)
											->with('error','you cannot add more traveler of addon'.$valuofaddon[0]->addons_name);
					 }
				}
			}else{
				$addonsetrecord=array();
			}
				
	// end here add on functionality//
	
	
	//echo '<pre>';print_r($addonsetrecord);die;		
	
	
	
	
	
	
	
		// trip activity start here ..//
		$activityflight= !empty($request->session()->get('card_item')['included_activity_flight'])?$request->session()->get('card_item')['included_activity_flight']:'0';
		$activityhotel=!empty($request->session()->get('card_item')['included_activity_hotel'])?$request->session()->get('card_item')['included_activity_hotel']:'0';
		
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
		
		
	//echo '<pre>';print_r($activityflight);die;
		
		
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
					
					$testactivity=array();
				}
		//echo '<pre>';print_r($testactivity);die;
		$dashboardData = $this->dashboardElements();	
        return view('cart',['data'=>$dashboardData,'tripdata'=>$data,'final'=>$addonsetrecord,'trip_id'=>$trip,'finaladd_on_amount'=>$finaladd_on_amount,'tripIncludedActivities'=>$testactivity]);
	}
    
	
	
    /**
     * Function to remove item from cart
     * @return \Illuminate\Http\Response
     */
	
	
	public function removecart()
	{
		//session_start();
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
		
		$userId = Auth::id();
		$trip=                !empty($request->input('trip_id'))?                                    $request->input('trip_id'):'';
		$trip_flight_id=       !empty($request->input('trip_flight_id'))?                            $request->input('trip_flight_id'):'';
		$trip_travelere=     !empty($request->input('trip_traveler_id'))?                            $request->input('trip_traveler_id'):'';
		$tripis_land_only=    !empty($request->session()->get('card_item')['is_land_only'])?         $request->session()->get('card_item')['is_land_only']:'';
		$trip_hotel_id=      !empty($request->input('trip_hotel_id'))?                               $request->input('trip_hotel_id'):'';
		$trip_hotel_amount=   !empty($request->input('add_on_hotel_id'))?                            $request->input('add_on_hotel_id'):'';
		$includedactivity_id=  !empty($request->input('includedactivity_id'))?                       $request->input('includedactivity_id'):'';
		$packing_list=          !empty($request->input('packing_list'))?                             $request->input('packing_list'):'';
		$add_on_flight_name=     !empty($request->session()->get('card_item')['add_on_flight_name'])? $request->session()->get('card_item')['add_on_flight_name']:'';
		$resever_pay_amount=     !empty($request->input('resever_pay_amount'))?                       $request->input('resever_pay_amount'):'';
		$trip_cost=              !empty($request->input('triptotalcost'))?                             $request->input('triptotalcost'):'';
		$tripBaseCost=              !empty($request->input('tripbasecost'))?                           $request->input('tripbasecost'):'';
	
		
		// manual flight add on //		
		
		$selected_add_on_id=      !empty($request->session()->get('card_item')['selected_addons'])?                  $request->session()->get('card_item')['selected_addons']:'';
		
		$cartSelectedTraveler = !empty($request->input('add_on_traveler_id'))?                                       $request->input('add_on_traveler_id'):'';
		
		$selected_addon_travelers=   !empty($request->session()->get('card_item')['selected_addon_traveler'])?        $request->session()->get('card_item')['selected_addon_traveler']:'';
		$selected_addon_flight=   !empty($request->session()->get('card_item')['addon_flight_name'])?                 $request->session()->get('card_item')['addon_flight_name']:'0';
		$selected_addon_hotel=  !empty($request->session()->get('card_item')['selected_addon_hotel'])?                $request->session()->get('card_item')['selected_addon_hotel']:'';
		$add_on_flight_name=  !empty($request->session()->get('card_item')['add_on_flight_name'])?                    $request->session()->get('card_item')['add_on_flight_name']:'';
		$add_on_flight_number=  !empty($request->session()->get('card_item')['add_on_flight_number'])?                $request->session()->get('card_item')['add_on_flight_number']:'';
		$add_on_departure_date= !empty($request->session()->get('card_item')['add_on_departure_date'])?               $request->session()->get('card_item')['add_on_departure_date']:'';
		$add_on_departure_time= !empty($request->session()->get('card_item')['add_on_departure_time'])?               $request->session()->get('card_item')['add_on_departure_time']:'';
		$add_on_land =         !empty($request->session()->get('card_item')['add_on_land-only'])?                     $request->session()->get('card_item')['add_on_land-only']:'';
		
		// end here..//
		
		$activityflight=          !empty($request->session()->get('card_item')['included_activity_flight'])?           $request->session()->get('card_item')['included_activity_flight']:'0';
		$activityhotel=          !empty($request->session()->get('card_item')['included_activity_hotel'])?             $request->session()->get('card_item')['included_activity_hotel']:'0';		
		$is_land_only_activity = !empty($request->session()->get('card_item')['is_land_only_activity_flight'])?        $request->session()->get('card_item')['is_land_only_activity_flight']:'';
		$activity_flight_name =  !empty($request->session()->get('card_item')['activity_flight_name'])?                $request->session()->get('card_item')['activity_flight_name']:'';
		$activity_flight_number= !empty($request->session()->get('card_item')['activity_flight_flight_number'])?       $request->session()->get('card_item')['activity_flight_flight_number']:'';
		$activity_flight_date = !empty($request->session()->get('card_item')['activity_flight_departure_date'])?       $request->session()->get('card_item')['activity_flight_departure_date']:'';
		$activity_flight_time = !empty($request->session()->get('card_item')['activity_flight_departure_time'])?       $request->session()->get('card_item')['activity_flight_departure_time']:'';
		
		
		
		//echo '<pre>';print_r($selected_addon_travelers);die;
		
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
			//print_r($flightdataaddon);die;
		
		$addonsetkey=array();
		$addondetail = array();
		$addonsetrecord=array();
		if(!empty($selected_add_on_id) && !empty($flightdataaddon) && !empty($selected_addon_hotel) && !empty($cartSelectedTraveler)){
			foreach(array($selected_add_on_id,$flightdataaddon,$selected_addon_hotel,$cartSelectedTraveler) as $arr){
					foreach($arr as $key=>$value){					
						 $addonsetkey[$key][] = $value;
					}				
			}	
		}else{			
			$addonsetkey=array();
		}		
		
		//echo '<pre>';print_r($addonsetkey);die;
		if(!empty($addonsetkey)){
		foreach($addonsetkey as $key=>$value)
				{
					$addondetail['addon_id'][$key]=$value[0];
					if(is_array($value[1]) && array_key_exists("manualflight",$value[1]))
					{
						$addondetail['manual_flight_id'][$key]=$value[1]['manualflight'];
					}else{
						$addondetail['flight_id'][$key] =$value[1];
					}																		
					$addondetail['hotel_id'][$key]=$value[2];
																	
				if(!empty($value[3])){
							foreach($value[3] as $travelerkey=>$traveler){
									$addondetail['travler_info'][$key][]=	$traveler;
							}
						}		
			}
			
			foreach($addondetail['addon_id'] as $keyofaddondetail=>$valuofaddon)
				{
									
					$addonsetrecord[$keyofaddondetail]['addon_id']= (!empty($addondetail['addon_id'][$keyofaddondetail]))?$addondetail['addon_id'][$keyofaddondetail]:'';
					if(!empty($addondetail['manual_flight_id'][$keyofaddondetail]))
					{
						$addonsetrecord[$keyofaddondetail]['manual_flight_id'] = (!empty($addondetail['manual_flight_id'][$keyofaddondetail]))?$addondetail['manual_flight_id'][$keyofaddondetail]:'';
					}else{
						$addonsetrecord[$keyofaddondetail]['flight_id'] = (!empty($addondetail['flight_id'][$keyofaddondetail]))?$addondetail['flight_id'][$keyofaddondetail]:'';
					}
					 $addonsetrecord[$keyofaddondetail]['hotel_id'] = (!empty($addondetail['hotel_id'][$keyofaddondetail]))?$addondetail['hotel_id'][$keyofaddondetail]:'';
					 if(!empty($addondetail['travler_info'][$keyofaddondetail]))
					 {

						 foreach($addondetail['travler_info'][$keyofaddondetail] as $key1=>$value1)
						 {			
							 $addonsetrecord[$keyofaddondetail]['travler_info'][$key1] = $value1;
						 }
						 
						 
					 }
				}
		}else{
			$addonsetrecord=array();
		}			
		
		
		//echo '<pre>';print_r($addondetail['addon_id']);die;
		// end here add on detail//
		
		
		
		// activity data set here ..//
		
		$activityflightarray=array();
		$activitysetkey=array();
		$activitdetail = array();
		$activitysetrecord=array();
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
		
		if(!empty($includedactivity_id) && !empty($activityflightarray) && !empty($activityhotel)){
			foreach(array($includedactivity_id,$activityflightarray,$activityhotel) as $activityarr){
					foreach($activityarr as $activityarrkey=>$activityarrvalue){					
						 $activitysetkey[$activityarrkey][] = $activityarrvalue;
					}				
			}	
		}else{			
			$activitysetkey=array();
		}			
		//echo '<pre>';print_r($activitysetkey);die;
		if(!empty($activitysetkey)){
		foreach($activitysetkey as $activitysetkey1=>$activitysetkeyvalue1)
				{
					$activitdetail['activity_id'][$activitysetkey1]=$activitysetkeyvalue1[0];
					if(is_array($activitysetkeyvalue1[1]) && array_key_exists("manualflightactivity",$activitysetkeyvalue1[1]))
					{
						$activitdetail['manual_activity_flight_id'][$activitysetkey1]=$activitysetkeyvalue1[1]['manualflightactivity'];
					}else{
						$activitdetail['activity_flight_id'][$activitysetkey1] =$activitysetkeyvalue1[1];
					}																		
					$activitdetail['activity_hotel_id'][$activitysetkey1]=$activitysetkeyvalue1[2];
																	
						
			}			
			foreach($activitdetail['activity_id'] as $keyofactivitydetail=>$valuofactivity)
				{
					$activitysetrecord[$keyofactivitydetail]['activity_id']= (!empty($activitdetail['activity_id'][$keyofactivitydetail]))?$activitdetail['activity_id'][$keyofactivitydetail]:'';
					if(!empty($activitdetail['manual_activity_flight_id'][$keyofactivitydetail]))
					{
						$activitysetrecord[$keyofactivitydetail]['manual_activity_flight_id'] = (!empty($activitdetail['manual_activity_flight_id'][$keyofactivitydetail]))?$activitdetail['manual_activity_flight_id'][$keyofactivitydetail]:'';
					}else{
						$activitysetrecord[$keyofactivitydetail]['activity_flight_id'] = (!empty($activitdetail['activity_flight_id'][$keyofactivitydetail]))?$activitdetail['activity_flight_id'][$keyofactivitydetail]:'';
					}					
					 $activitysetrecord[$keyofactivitydetail]['activity_hotel_id'] = (!empty($activitdetail['activity_hotel_id'][$keyofactivitydetail]))?$activitdetail['activity_hotel_id'][$keyofactivitydetail]:'';
					
				}
		}else{
			$activitysetrecord=array();
		}
		// end here to activity data//
		//print_r($activitysetrecord);die;
		
		
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

				DB::table('checkout')->where(array('trip_id'=>$trip,'user_id'=>$userId))->delete();						
				
				$checkoutdata['user_id']=$userId;
				$checkoutdata['trip_id']=$trip;
				if($tripis_land_only==0)
				{
					$checkoutdata['trip_flight_id']=$trip_flight_id;
				}else{
					$checkoutdata['flight_name']=!empty($request->session()->get('card_item')['flight_name'])?$request->session()->get('card_item')['flight_name']:'';
					$checkoutdata['flight_number']=!empty($request->session()->get('card_item')['flight_number'])?$request->session()->get('card_item')['flight_number']:'';
					$checkoutdata['flight_departure_date']=!empty($request->session()->get('card_item')['departure_date'])?$request->session()->get('card_item')['departure_date']:'';
					$checkoutdata['flight_departure_time']=!empty($request->session()->get('card_item')['departure_time'])?$request->session()->get('card_item')['departure_time']:'';
				}
				$checkoutdata['trip_hotel_id']=$trip_hotel_id;
				$checkoutdata['trip_total_cost']=$trip_cost;
				$checkoutdata['status']=1;
				$checkoutdata['trip_base_cost']=$tripBaseCost;
				$checkoutdata['traveler_ids']=$trip_travelere;				
				$checkoutdata['create_date']=date('y-m-d');
				$checkoutdata['payment_id']=$paymentdataid;
				$insertcheckoutid = DB::table('checkout')->insertGetId($checkoutdata);			 
				 
				 if(!empty($addonsetrecord))
				 {
					  DB::table('trip_addon_traveler')->where(array('trip_id'=>$trip,'user_id'=>$userId))->delete();
					  
					 					
					 foreach($addonsetrecord as $addonkey=>$addonvalue)
					 {
							$getaddonvalue= DB::table('trip_addon')
														->where('trip_id', '=', $trip)
														->where('id', '=', $addonvalue['addon_id'])
														->where('status', '=', '1')
														->first();
											
							$addonspots= !empty($getaddonvalue)?$getaddonvalue->addons_maximum_spots:'';
							$addonwaitingspots= !empty($getaddonvalue)?$getaddonvalue->addons_maximum_wating_spots:'';
						
						$addondata=array();
					//	print_r($addonvalue);
						 $addondata['user_id']=$userId;
						 $addondata['trip_id']=$trip;
						 $addondata['add_on_id']=$addonvalue['addon_id'];
						 if(isset($addonvalue['manual_flight_id']) && !empty($addonvalue['manual_flight_id']))
						 {
							 $addondata['flight_name']=(!empty($addonvalue['manual_flight_id'][0]))?$addonvalue['manual_flight_id'][0]:'';
							 $addondata['flight_number']=(!empty($addonvalue['manual_flight_id'][1]))?$addonvalue['manual_flight_id'][1]:'';
							 $addondata['flight_departure_date']=(!empty($addonvalue['manual_flight_id'][2]))?$addonvalue['manual_flight_id'][2]:'';
							 $addondata['flight_departure_time']=(!empty($addonvalue['manual_flight_id'][3]))?$addonvalue['manual_flight_id'][3]:'';
							 
						 }else{
							$addondata['flight_id']=(!empty($addonvalue['flight_id']))?$addonvalue['flight_id']:'0';
						 }
						 $addondata['hotel_id']=(!empty($addonvalue['hotel_id']))?$addonvalue['hotel_id']:'';
						 $addondata['checkout_id']=$insertcheckoutid;
						 $addondata['payment_id']=$paymentdataid;
						 $addondata['created_date']=date('y-m-d');
						 $insertaddondataid = DB::table('trip_addon_booking')->insertGetId($addondata);
						 
						 // travlere detail //
						 
						 
							$addonDetail = DB::select('select * from trip_addon where trip_id='.$trip.' and status="1" and id='.$addonvalue['addon_id'].'');
							
						 
							$allreadyTravelerExists = Helper::bookTravelerAsPerUserId($trip,$confirm='1',$userId,$addonvalue['addon_id']);
							
							$bookTravlerePendingAsPerDate= Helper::bookTravlerePendingAsPerDate($trip,$confirm='0',$addonvalue['addon_id']);
							
							// check spots //
								$bookTravelerAsPerTripIdConfirm = Helper::bookAddonAsPerTripId($trip,$confirm='1',$addonvalue['addon_id']);
								$bookTravelerAsPerTripIdPending = Helper::bookAddonAsPerTripId($trip,$confirm='0',$addonvalue['addon_id']);
							// end here//
							
							// remaning spots// 
								$bookTravelerRemaningConfrim = $addonDetail[0]->addons_maximum_spots - count($bookTravelerAsPerTripIdConfirm);
								$bookTravelerRemaningPending = $addonDetail[0]->addons_maximum_wating_spots - count($bookTravelerAsPerTripIdPending);
							 // end here//
						 
						 if(!empty($allreadyTravelerExists))
						 {
							 
							 
							 $userBookTravelere = count($allreadyTravelerExists);
							 
							 if(count($addonvalue['travler_info']) == $userBookTravelere)
								{
									
									DB::table('trip_addon_booking')->where(array('trip_id'=>$trip,'user_id'=>$userId))->delete();

									
									foreach($addonvalue['travler_info'] as $addonvaluekey=>$addonvalue1)
									{	
											$traveleredata['user_id']=$userId;
											$traveleredata['trip_id']=$trip;
											$traveleredata['is_confirm']='1';
											$traveleredata['addon_id']=$addonvalue['addon_id'];
											$traveleredata['traveler_id']=$addonvalue1;
											$traveleredata['checkout_id']=$insertcheckoutid;
											$traveleredata['payment_id']=$paymentdataid;
											$traveleredata['created_date']=date('y-m-d');
											$traveleredata['status']='1';
											$inserttravelerdataid = DB::table('trip_addon_traveler')->insertGetId($traveleredata);
									}
									
									
								}elseif(count($addonvalue['traveler_info']) < $userBookTravelere){
									
										$changePendingToConfirmSpots = 	$userBookTravelere - count($addonvalue['travler_info']);										
										$SpotsUpdateConfirm = Helper::SpotsUpdateConfirm($trip,$addonvalue['addon_id']);
										
									DB::table('trip_addon_booking')->where(array('trip_id'=>$trip,'user_id'=>$userId))->delete();
									
									foreach($addonvalue['travler_info'] as $addonvaluekey=>$addonvalue1)
									  {	
											$traveleredata['user_id']=$userId;
											$traveleredata['trip_id']=$trip;
											$traveleredata['is_confirm']='1';
											$traveleredata['addon_id']=$addonvalue['addon_id'];
											$traveleredata['traveler_id']=$addonvalue1;
											$traveleredata['checkout_id']=$insertcheckoutid;
											$traveleredata['payment_id']=$paymentdataid;
											$traveleredata['created_date']=date('y-m-d');
											$traveleredata['status']='1';
											$inserttravelerdataid = DB::table('trip_addon_traveler')->insertGetId($traveleredata);
									}
									
								}
							
						 }else{
							 
							if($addonDetail[0]->addons_maximum_spots <= $bookTravelerRemaningConfrim && $bookTravelerRemaningConfrim > 0)
							{
									
									foreach($addonvalue['travler_info'] as $addonvaluekey=>$addonvalue1)
									{	
											$traveleredata['user_id']=$userId;
											$traveleredata['trip_id']=$trip;
											$traveleredata['is_confirm']='1';
											$traveleredata['addon_id']=$addonvalue['addon_id'];
											$traveleredata['traveler_id']=$addonvalue1;
											$traveleredata['checkout_id']=$insertcheckoutid;
											$traveleredata['payment_id']=$paymentdataid;
											$traveleredata['created_date']=date('y-m-d');
											$traveleredata['status']='1';
											$inserttravelerdataid = DB::table('trip_addon_traveler')->insertGetId($traveleredata);			
									}											
								
							}elseif($addonDetail[0]->addons_maximum_wating_spots <= $bookTravelerRemaningPending && $bookTravelerRemaningPending > 0)
							{								
								foreach($addonvalue['travler_info'] as $addonvaluekey=>$addonvalue1)
									{	
											$traveleredata['user_id']=$userId;
											$traveleredata['trip_id']=$trip;
											$traveleredata['is_confirm']='0';
											$traveleredata['addon_id']=$addonvalue['addon_id'];
											$traveleredata['traveler_id']=$addonvalue1;
											$traveleredata['checkout_id']=$insertcheckoutid;
											$traveleredata['payment_id']=$paymentdataid;
											$traveleredata['created_date']=date('y-m-d');
											$traveleredata['status']='1';
											$inserttravelerdataid = DB::table('trip_addon_traveler')->insertGetId($traveleredata);			
									}
								
							}
							  
						 }							
						 //end here // 
					 }
					 
				 }
				 
				 if(!empty($activitysetrecord))
				 {
						DB::table('trip_included_activity_booking')->where(array('trip_id'=>$trip,'user_id'=>$userId))->delete();
					 foreach($activitysetrecord as $includeacitvitfinalkey=>$includeacitvitfinalvalue)
					 {
						 $activitydata=array();
						 
						 $activitydata['user_id']=$userId;
						 $activitydata['trip_id']=$trip;
						 $activitydata['activity_id']=(!empty($includeacitvitfinalvalue['activity_id']))?$includeacitvitfinalvalue['activity_id']:'';
						 if(isset($includeacitvitfinalvalue['manual_activity_flight_id']) && !empty($includeacitvitfinalvalue['manual_activity_flight_id'])){
							
							 $activitydata['flight_name']=(!empty($includeacitvitfinalvalue['manual_activity_flight_id'][0]))?$includeacitvitfinalvalue['manual_activity_flight_id'][0]:'';
							 $activitydata['flight_number']=(!empty($includeacitvitfinalvalue['manual_activity_flight_id'][1]))?$includeacitvitfinalvalue['manual_activity_flight_id'][1]:'';
							 $activitydata['flight_departure_date']=(!empty($includeacitvitfinalvalue['manual_activity_flight_id'][2]))?$includeacitvitfinalvalue['manual_activity_flight_id'][2]:'';
							 $activitydata['flight_departure_time']=(!empty($includeacitvitfinalvalue['manual_activity_flight_id'][3]))?$includeacitvitfinalvalue['manual_activity_flight_id'][3]:'';
						 }else{							 
							$activitydata['activity_flight_id']=(!empty($includeacitvitfinalvalue['activity_flight_id']))?$includeacitvitfinalvalue['activity_flight_id']:'0';
						 }
						 $activitydata['activity_hotel_id']=(!empty($includeacitvitfinalvalue['activity_hotel_id']))?$includeacitvitfinalvalue['activity_hotel_id']:'';
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
    public function emiCalculator(Request $request){
        
		//echo 'sfsdfdsfsdfd';die;
		//echo '<pre>';print_r($_POST);die;	
		$userId = Auth::id();
		$trip=                          !empty($request->input('trip_id'))?                                           $request->input('trip_id'):'';
		$trip_flight_id=                 !empty($request->input('trip_flight_id'))?                                   $request->input('trip_flight_id'):'';
		$trip_travelere=                 !empty($request->input('trip_traveler_id'))?                                 $request->input('trip_traveler_id'):'';
		$tripis_land_only=                 $request->session()->get('card_item')['is_land_only'];
		$trip_hotel_id=                  !empty($request->input('trip_hotel_id'))?                                     $request->input('trip_hotel_id'):'';
		$trip_hotel_amount=              !empty($request->input('add_on_hotel_id'))?                                   $request->input('add_on_hotel_id'):'';
		$includedactivity_id=             !empty($request->input('includedactivity_id'))?                              $request->input('includedactivity_id'):'';
		$packing_list=                   !empty($request->input('packing_list'))?                                      $request->input('packing_list'):'';
		$add_on_flight_name=             !empty($request->session()->get('card_item')['add_on_flight_name'])?          $request->session()->get('card_item')['add_on_flight_name']:'';
		$resever_pay_amount=              !empty($request->input('resever_pay_amount'))?                               $request->input('resever_pay_amount'):'';
		$trip_cost=                       !empty($request->input('triptotalcost'))?                                    $request->input('triptotalcost'):'';
		$tripBaseCost=                  !empty($request->input('tripbasecost'))?                                       $request->input('tripbasecost'):'';
		
		// manual flight add on //		
		
		$selected_add_on_id=                !empty($request->session()->get('card_item')['selected_addons'])?               $request->session()->get('card_item')['selected_addons']:'';
		$selected_addon_travelers=         !empty($request->session()->get('card_item')['selected_addon_traveler'])?        $request->session()->get('card_item')['selected_addon_traveler']:'';
		
		$cartSelectedTraveler =            !empty($request->input('add_on_traveler_id'))?                                   $request->input('add_on_traveler_id'):'';
		
		$selected_addon_flight=           !empty($request->session()->get('card_item')['addon_flight_name'])?                $request->session()->get('card_item')['addon_flight_name']:'0';
		$selected_addon_hotel=            !empty($request->session()->get('card_item')['selected_addon_hotel'])?             $request->session()->get('card_item')['selected_addon_hotel']:'';
		$add_on_flight_name=              !empty($request->session()->get('card_item')['add_on_flight_name'])?               $request->session()->get('card_item')['add_on_flight_name']:'';
		$add_on_flight_number=            !empty($request->session()->get('card_item')['add_on_flight_number'])?             $request->session()->get('card_item')['add_on_flight_number']:'';
		$add_on_departure_date=           !empty($request->session()->get('card_item')['add_on_departure_date'])?            $request->session()->get('card_item')['add_on_departure_date']:'';
		$add_on_departure_time=           !empty($request->session()->get('card_item')['add_on_departure_time'])?            $request->session()->get('card_item')['add_on_departure_time']:'';
		$add_on_land =                    !empty($request->session()->get('card_item')['add_on_land-only'])?                 $request->session()->get('card_item')['add_on_land-only']:'';
		
		// end here..//
		
		$activityflight=                   !empty($request->session()->get('card_item')['included_activity_flight'])?            $request->session()->get('card_item')['included_activity_flight']:'0';
		$activityhotel=                   !empty($request->session()->get('card_item')['included_activity_hotel'])?              $request->session()->get('card_item')['included_activity_hotel']:'0';		
		$is_land_only_activity =          !empty($request->session()->get('card_item')['is_land_only_activity_flight'])?         $request->session()->get('card_item')['is_land_only_activity_flight']:'';
		$activity_flight_name =            !empty($request->session()->get('card_item')['activity_flight_name'])?                $request->session()->get('card_item')['activity_flight_name']:'';
		$activity_flight_number =          !empty($request->session()->get('card_item')['activity_flight_flight_number'])?       $request->session()->get('card_item')['activity_flight_flight_number']:'';
		$activity_flight_date =             !empty($request->session()->get('card_item')['activity_flight_departure_date'])?     $request->session()->get('card_item')['activity_flight_departure_date']:'';
		$activity_flight_time =          !empty($request->session()->get('card_item')['activity_flight_departure_time'])?        $request->session()->get('card_item')['activity_flight_departure_time']:'';
		
		
		
		
		
		
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
			
		
		$addonsetkey=array();
		$addondetail = array();
		$addonsetrecord=array();
		if(!empty($selected_add_on_id) && !empty($flightdataaddon) && !empty($selected_addon_hotel) && !empty($cartSelectedTraveler)){
			foreach(array($selected_add_on_id,$flightdataaddon,$selected_addon_hotel,$cartSelectedTraveler) as $arr){
					foreach($arr as $key=>$value){					
						 $addonsetkey[$key][] = $value;
					}				
			}	
		}else{			
			$addonsetkey='';
		}		
		
		//print_r($addonsetkey);die;
		if(!empty($addonsetkey)){
		foreach($addonsetkey as $key=>$value)
				{
					$addondetail['addon_id'][$key]=$value[0];
					if(is_array($value[1]) && array_key_exists("manualflight",$value[1]))
					{
						$addondetail['manual_flight_id'][$key]=$value[1]['manualflight'];
					}else{
						$addondetail['flight_id'][$key] =$value[1];
					}																		
					$addondetail['hotel_id'][$key]=$value[2];
																	
				if(!empty($value[3])){
							foreach($value[3] as $travelerkey=>$traveler){
									$addondetail['travler_info'][$key][]=	$traveler;
							}
						}		
			}
			
			foreach($addondetail['addon_id'] as $keyofaddondetail=>$valuofaddon)
				{
					$addonsetrecord[$keyofaddondetail]['addon_id']= (!empty($addondetail['addon_id'][$keyofaddondetail]))?$addondetail['addon_id'][$keyofaddondetail]:'';
					if(!empty($addondetail['manual_flight_id'][$keyofaddondetail]))
					{
						$addonsetrecord[$keyofaddondetail]['manual_flight_id'] = (!empty($addondetail['manual_flight_id'][$keyofaddondetail]))?$addondetail['manual_flight_id'][$keyofaddondetail]:'';
					}else{
						$addonsetrecord[$keyofaddondetail]['flight_id'] = (!empty($addondetail['flight_id'][$keyofaddondetail]))?$addondetail['flight_id'][$keyofaddondetail]:'';
					}
					 $addonsetrecord[$keyofaddondetail]['hotel_id'] = (!empty($addondetail['hotel_id'][$keyofaddondetail]))?$addondetail['hotel_id'][$keyofaddondetail]:'';
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
		
		
		
		// end here add on detail//
		
		
		
		// activity data set here ..//
		
		$activityflightarray=array();
		$activitysetkey=array();
		$activitdetail = array();
		$activitysetrecord=array();
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
		
		if(!empty($includedactivity_id) && !empty($activityflightarray) && !empty($activityhotel)){
			foreach(array($includedactivity_id,$activityflightarray,$activityhotel) as $activityarr){
					foreach($activityarr as $activityarrkey=>$activityarrvalue){					
						 $activitysetkey[$activityarrkey][] = $activityarrvalue;
					}				
			}	
		}else{			
			$activitysetkey='';
		}			
		
		if(!empty($activitysetkey)){
		foreach($activitysetkey as $activitysetkey1=>$activitysetkeyvalue1)
				{
					$activitdetail['activity_id'][$activitysetkey1]=$activitysetkeyvalue1[0];
					if(is_array($activitysetkeyvalue1[1]) && array_key_exists("manualflightactivity",$activitysetkeyvalue1[1]))
					{
						$activitdetail['manual_activity_flight_id'][$activitysetkey1]=$activitysetkeyvalue1[1]['manualflightactivity'];
					}else{
						$activitdetail['activity_flight_id'][$activitysetkey1] =$activitysetkeyvalue1[1];
					}																		
					$activitdetail['activity_hotel_id'][$activitysetkey1]=$activitysetkeyvalue1[2];
																	
						
			}			
			foreach($activitdetail['activity_id'] as $keyofactivitydetail=>$valuofactivity)
				{
					$activitysetrecord[$keyofactivitydetail]['activity_id']= (!empty($activitdetail['activity_id'][$keyofactivitydetail]))?$activitdetail['activity_id'][$keyofactivitydetail]:'';
					if(!empty($activitdetail['manual_activity_flight_id'][$keyofactivitydetail]))
					{
						$activitysetrecord[$keyofactivitydetail]['manual_activity_flight_id'] = (!empty($activitdetail['manual_activity_flight_id'][$keyofactivitydetail]))?$activitdetail['manual_activity_flight_id'][$keyofactivitydetail]:'';
					}else{
						$activitysetrecord[$keyofactivitydetail]['activity_flight_id'] = (!empty($activitdetail['activity_flight_id'][$keyofactivitydetail]))?$activitdetail['activity_flight_id'][$keyofactivitydetail]:'';
					}					
					 $activitysetrecord[$keyofactivitydetail]['activity_hotel_id'] = (!empty($activitdetail['activity_hotel_id'][$keyofactivitydetail]))?$activitdetail['activity_hotel_id'][$keyofactivitydetail]:'';
					
				}
		}else{
			$activitysetrecord='';
		}
		
		
				//echo '<pre>';print_r($addonsetrecord);die;		
			
				
				
				$checkoutdata['user_id']=$userId;
				$checkoutdata['trip_id']=$trip;
				if($tripis_land_only==0)
				{
					$checkoutdata['trip_flight_id']=$trip_flight_id;
					$checkoutdata['flight_name']='';
					$checkoutdata['flight_number']='';
					$checkoutdata['flight_departure_date']='';
					$checkoutdata['flight_departure_time']='';
				}else{
					$checkoutdata['trip_flight_id']='';
					$checkoutdata['flight_name']=!empty($request->session()->get('card_item')['flight_name'])?$request->session()->get('card_item')['flight_name']:'';
					$checkoutdata['flight_number']=!empty($request->session()->get('card_item')['flight_number'])?$request->session()->get('card_item')['flight_number']:'';
					$checkoutdata['flight_departure_date']=!empty($request->session()->get('card_item')['departure_date'])?$request->session()->get('card_item')['departure_date']:'';
					$checkoutdata['flight_departure_time']=!empty($request->session()->get('card_item')['departure_time'])?$request->session()->get('card_item')['departure_time']:'';
				}
				$checkoutdata['trip_hotel_id']=$trip_hotel_id;
				$checkoutdata['trip_total_cost']=$trip_cost;
				$checkoutdata['status']=1;
				$checkoutdata['trip_base_cost']=$tripBaseCost;
				$checkoutdata['traveler_ids']=$trip_travelere;				
				
				$insertcheckoutid = DB::table('checkout')->where('trip_id',$trip)
														->where('user_id',$userId)
														->update($checkoutdata);			 
				 
			if(!empty($addonsetrecord))
				 {
					 
					 //echo 'sdfdfdfsdaf';die;
					 					 
					 foreach($addonsetrecord as $addonkey=>$addonvalue)
					 {		
							$getaddonvalue= DB::table('trip_addon')
														->where('trip_id', '=', $trip)
														->where('id', '=', $addonvalue['addon_id'])
														->where('status', '=', '1')
														->first();
											
							$addonspotsMaximum= !empty($getaddonvalue)?$getaddonvalue->addons_maximum_spots:'';
							$addonwaitingspots= !empty($getaddonvalue)?$getaddonvalue->addons_maximum_wating_spots:'';

					 
						$addondata=array();
					//	print_r($addonvalue);
						 $addondata['user_id']=$userId;
						 $addondata['trip_id']=$trip;
						 $addondata['add_on_id']=$addonvalue['addon_id'];
						 if(isset($addonvalue['manual_flight_id']) && !empty($addonvalue['manual_flight_id']))
						 {
							 $addondata['flight_name']=(!empty($addonvalue['manual_flight_id'][0]))?$addonvalue['manual_flight_id'][0]:'';
							 $addondata['flight_number']=(!empty($addonvalue['manual_flight_id'][1]))?$addonvalue['manual_flight_id'][1]:'';
							 $addondata['flight_departure_date']=(!empty($addonvalue['manual_flight_id'][2]))?$addonvalue['manual_flight_id'][2]:'';
							 $addondata['flight_departure_time']=(!empty($addonvalue['manual_flight_id'][3]))?$addonvalue['manual_flight_id'][3]:'';
							 
						 }else{
							$addondata['flight_id']=(!empty($addonvalue['flight_id']))?$addonvalue['flight_id']:'0';
						 }
						 $addondata['hotel_id']=(!empty($addonvalue['hotel_id']))?$addonvalue['hotel_id']:'';
						
						 $insertaddondataid = DB::table('trip_addon_booking')->where('trip_id',$trip)
														->where('user_id',$userId)
														->where('add_on_id',$addonvalue['addon_id'])
														->update($addondata);
									

							// check here to spots//
								
							
						 
							$allreadyTravelerExists = Helper::bookTravelerAsPerUserId($trip,$confirm='1',$userId,$addonvalue['addon_id']);
							
							$bookTravlerePendingAsPerDate= Helper::bookTravlerePendingAsPerDate($trip,$confirm='0',$addonvalue['addon_id']);
							
							// check spots //
								$bookTravelerAsPerTripIdConfirm = Helper::bookAddonAsPerTripId($trip,$confirm='1',$addonvalue['addon_id']);
								$bookTravelerAsPerTripIdPending = Helper::bookAddonAsPerTripId($trip,$confirm='0',$addonvalue['addon_id']);
							// end here//
							
							// remaning spots// 
								$bookTravelerRemaningConfrim = $addonspotsMaximum - count($bookTravelerAsPerTripIdConfirm);
								$bookTravelerRemaningPending = $addonwaitingspots - count($bookTravelerAsPerTripIdPending);
							 // end here//
							
							
							if(!empty($allreadyTravelerExists))
							{
									 $userBookTravelere = count($allreadyTravelerExists);
							 
							 if(count($addonvalue['travler_info']) == $userBookTravelere)
								{
									
									//echo 'dfdf';die;
									
									 DB::table('trip_addon_traveler')->where(array('trip_id'=>$trip,'user_id'=>$userId))->delete();
								
										foreach($addonvalue['travler_info'] as $addonvaluekey=>$addonvalue1)
										{																						
											$traveleredata['user_id']=$userId;
											$traveleredata['trip_id']=$trip;
											$traveleredata['addon_id']=$addonvalue['addon_id'];
											$traveleredata['traveler_id']=$addonvalue1;														
											$traveleredata['status']='1';
											$traveleredata['is_confirm']='1';
														
											$inserttravelerdataid =  DB::table('trip_addon_traveler')->insertGetId($traveleredata);	
												
										}
										
								}elseif(count($addonvalue['travler_info']) < $userBookTravelere)
								{
									 DB::table('trip_addon_traveler')->where(array('trip_id'=>$trip,'user_id'=>$userId))->delete();
									
										$changePendingToConfirmSpots = 	$userBookTravelere - count($addonvalue['travler_info']); 
										
										$spotsUpdateConfirm = Helper::SpotsUpdateConfirm($trip,$addonvalue['addon_id']);
										foreach($addonvalue['travler_info'] as $addonvaluekey=>$addonvalue1)
										{																						
											$traveleredata['user_id']=$userId;
											$traveleredata['trip_id']=$trip;
											$traveleredata['addon_id']=$addonvalue['addon_id'];
											$traveleredata['traveler_id']=$addonvalue1;														
											$traveleredata['status']='1';
											$traveleredata['is_confirm']='1';
														
											$inserttravelerdataid =  DB::table('trip_addon_traveler')->insertGetId($traveleredata);	
												
										}
										
								}								
								
							 }else{
								 //echo 'mukesh';die;
							 
								if($addonspotsMaximum <= $bookTravelerRemaningConfrim && $bookTravelerRemaningConfrim > 0)
									{
												foreach($addonvalue['travler_info'] as $addonvaluekey=>$addonvalue1)
												{
														$traveleredata['user_id']=$userId;
														$traveleredata['trip_id']=$trip;
														$traveleredata['addon_id']=$addonvalue['addon_id'];
														$traveleredata['traveler_id']=$addonvalue1;														
														$traveleredata['status']='1';
														$traveleredata['is_confirm']='1';
														
														$inserttravelerdataid =  DB::table('trip_addon_traveler')->insertGetId($traveleredata);	
														
												}
									}elseif($addonwaitingspots <= $bookTravelerRemaningPending && $bookTravelerRemaningPending > 0){
								
											foreach($addonvalue['travler_info'] as $addonvaluekey=>$addonvalue1)
												{														
													$traveleredata['user_id']=$userId;
													$traveleredata['trip_id']=$trip;
													$traveleredata['is_confirm']='0';
													$traveleredata['addon_id']=$addonvalue['addon_id'];
													$traveleredata['traveler_id']=$addonvalue1;
													$traveleredata['status']='1';														
														
													$inserttravelerdataid =  DB::table('trip_addon_traveler')->insertGetId($traveleredata);	
														//DB::table('trip_addon_traveler')->insertGetId($traveleredata);
												}
									}
							 }				 
						 //end here // 
					 }
					 
				 }
				 
				 if(!empty($activitysetrecord))
				 {
						//DB::table('trip_included_activity_booking')->where(array('trip_id'=>$trip,'user_id'=>$userId))->delete();
					 foreach($activitysetrecord as $includeacitvitfinalkey=>$includeacitvitfinalvalue)
					 {
						 $activitydata=array();
						 
						 $activitydata['user_id']=$userId;
						 $activitydata['trip_id']=$trip;
						 $activitydata['activity_id']=(!empty($includeacitvitfinalvalue['activity_id']))?$includeacitvitfinalvalue['activity_id']:'';
						 if(isset($includeacitvitfinalvalue['manual_activity_flight_id']) && !empty($includeacitvitfinalvalue['manual_activity_flight_id'])){
							
							 $activitydata['flight_name']=(!empty($includeacitvitfinalvalue['manual_activity_flight_id'][0]))?$includeacitvitfinalvalue['manual_activity_flight_id'][0]:'';
							 $activitydata['flight_number']=(!empty($includeacitvitfinalvalue['manual_activity_flight_id'][1]))?$includeacitvitfinalvalue['manual_activity_flight_id'][1]:'';
							 $activitydata['flight_departure_date']=(!empty($includeacitvitfinalvalue['manual_activity_flight_id'][2]))?$includeacitvitfinalvalue['manual_activity_flight_id'][2]:'';
							 $activitydata['flight_departure_time']=(!empty($includeacitvitfinalvalue['manual_activity_flight_id'][3]))?$includeacitvitfinalvalue['manual_activity_flight_id'][3]:'';
						 }else{							 
							$activitydata['activity_flight_id']=(!empty($includeacitvitfinalvalue['activity_flight_id']))?$includeacitvitfinalvalue['activity_flight_id']:'0';
						 }
						 $activitydata['activity_hotel_id']=(!empty($includeacitvitfinalvalue['activity_hotel_id']))?$includeacitvitfinalvalue['activity_hotel_id']:'';
						
						 $activitydata['status']='1';
						 $insertactivitydataid = DB::table('trip_included_activity_booking')->where('trip_id',$trip)
														->where('user_id',$userId)
														->where('activity_id',$includeacitvitfinalvalue['activity_id'])
														->update($activitydata);
						 //DB::table('trip_included_activity_booking')->insertGetId($activitydata);
						 
					 }
					 
				 }	
				 echo 'Emidataupdate';die;
        
    }
    public function recurlyPaymentProcess(){
        //echo  "hello hi bye bye";
        //        require_once('lib/recurly.php');
        //        // Required for the API
        //        Recurly_Client::$subdomain = 'https://niwedita.recurly.com';
        //        Recurly_Client::$apiKey = '886d7911953043a096d82237ba8e510c'; 
    }
}
