<?php
// Custom helper class that contains the common function to be used in entire application

namespace App\Helpers;

use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Helper
{
	/**
     * Function to get trip addon ariline list
     * @param void
     * @return array
     */
    public static function getAddonAirline($tipid,$addonId,$flightId)
    {
		$addonflight = DB::table('trip_addon_airline')
							->join('airlines', 'trip_addon_airline.airline_name', '=', 'airlines.id')
							->where('trip_addon_airline.trip_id', '=', $tipid)
							->where('trip_addon_airline.addon_id', '=', $addonId)
							->where('trip_addon_airline.status', '=', '1')
							->where('airlines.id', '=', $flightId)
							->get();
							
		return 	$addonflight;				
    }
	
	
	
	/**
     * Function to get trip addon hotel list
     * @param void
     * @return array
     */
    public static function getAddonHotel($tipid,$hotelId)
    {
		$addonHotels =DB::table('trip_addon_hotel')
					->where('trip_id', '=', $tipid)
					->where('id', '=', $hotelId)
					->where('status', '=', '1')
					->get();
							
		return 	$addonHotels;				
    }
	
	
	/**
     * Function to get trip includedacitivity airline list
     * @param void
     * @return array
     */
	
	public static function getIncludedActivityAir($tripId,$activityId,$flightId)
	{
		
		$activityflight= DB::table('trip_included_activity_airline')
						->join('airlines', 'trip_included_activity_airline.airline_name', '=', 'airlines.id')
						//->where('trip_included_activity_airline.airline_departure_date', '>', date('Y-m-d'))
						->where('trip_included_activity_airline.trip_id', '=', $tripId)
						->where('trip_included_activity_airline.activity_id', '=', $activityId)
						->where('trip_included_activity_airline.id', $flightId)
						->where('trip_included_activity_airline.status', '=', '1')
						->get();
						
		return 	$activityflight;		
	}
	
	
	public static function getIncludeActivityHotel($tripId,$activityId,$hotelId)
	{
		
		$activityhotel= DB::table('trip_included_activity_hotel')
						->where('trip_id', '=', $tripId)
						//->where('hotel_due_date', '>', date('Y-m-d'))
						->where('activity_id', '=', $activityId)
						->where('id', $hotelId)
						->where('status', '=', '1')
						->get();
			return 	$activityhotel;		
	}
	
	/**
     * Function to get dates between two date
     * @param void
     * @return array
     */
	 
	 public  static function getDateBetweenDates($emiDate,$adjustMentDate,$monthlyPaymentDate=false)
	 { 
		
		 $dates=array();
		
		 $paymentday= strtotime(!empty($monthlyPaymentDate)?$monthlyPaymentDate:(date('Y-m-15')));
		 
		for($second= $emiDate; $second <= $adjustMentDate; $second+=86400)
			{	
					$date= date('Y-m-d',$second);
					$days = date('d',$second);							
				if($days == date('d',$paymentday)){	
						array_push($dates,$date);
					}			
			}
			
		return $dates;		
										
	 }
	 
	 public static function bookAddonAsPerTripId($trip,$confirm)
	 {
		 
		 $tripDetail= DB::select('select * from trip_addon_traveler where trip_id='.$trip.' and is_confirm ='.$confirm.'');
		 return $tripDetail;
	 }

   
}