<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
//use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use File;
use App\User;
use App\Trip;
use App\UserProfile;
use App\Country;
use App\Airline;
use App\TripAirline;
use App\TripIncludedActivity;
use App\TripIncludedActivityHotel;
use App\TripIncludedActivityAirline;
use App\TripAddon;
use App\TripAddonHotel;
use App\TripAddonAirline;
use App\TripHotel;
use App\TripTodo;
use App\TripTravelerProfile;
use App\TripMiscExpense;
use App\TripTraveler;
use Validator;
use Mail;


class AdminController extends Controller {

    /**
     * Function to load User 0
     * @param void
     * @return array
     */
    public function userDashboard(Request $request) {
        $userId = Auth::id();
		 $userData = User::where('id', '=', $userId)->first();
		$tripalldetail=array();
		 $userTrips['trip_detail'] =   DB::table('checkout')
												->join('trips', 'checkout.trip_id', '=', 'trips.id')
												->select('trips.*', 'checkout.*')
												->where('trips.status', '=', '1')		
												->get();
												
		foreach($userTrips['trip_detail'] as $key=>$value)
			{
				$userTrips['user_detail'][$key]=DB::table('users')
													->where('id',$value->user_id)
													->get();
				
				$userTrips['selected_add_on'][$key]= DB::table('trip_addon_booking')
														->leftjoin('trip_addon','trip_addon_booking.add_on_id','=','trip_addon.id')	
														->where('trip_addon_booking.trip_id', '=', $value->trip_id)
														->where('trip_addon_booking.user_id', '=', $value->user_id)
														->get();
											
				$userTrips['paidamount'][$key]=DB::table('trip_reserve_payment')
													->select(DB::raw("SUM(reserve_paid_amount) as total_paid"))
													->where('trip_id', '=', $value->trip_id)
													->where('user_id', '=', $value->user_id)													
													->get();									
			}

	for ($i = 0; $i < count($userTrips['trip_detail']); $i++) {
			
              $tripalldetail[$i]['trip_detail'] = $userTrips['trip_detail'][$i];
					

					foreach ($userTrips['selected_add_on'][$i] as $activityhotelkey2 => $activityhotelvalue2) {

						$tripalldetail[$i]['selected_add_on'][$activityhotelkey2] = $activityhotelvalue2;
					}
					 foreach ($userTrips['paidamount'][$i] as $activityhotelkey3 => $activityhotelvalue3) {
								
								
							$tripalldetail[$i]['paidamount'][$activityhotelkey3] = $activityhotelvalue3;
						}
					foreach ($userTrips['user_detail'][$i] as $activityhotelkey4 => $activityhotelvalue4) {

							$tripalldetail[$i]['user_detail'][$activityhotelkey4] = $activityhotelvalue4;
						}
                
            }							
												
		//echo '<pre>';print_r($tripalldetail);die;								
				
				
	    return view('admin/dashboard', ['tripalldetail' => $tripalldetail,'data'=>$userData]);
    }

    /**
     * Function to update user basic information
     * @param void
     * @return url
     * 
     */
    public function updateUserBasicInfo(Request $request) {
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $gender = $request->input('gender');
        $dob = $request->input('dob');
        $email = $request->input('email');
        $passportAvailable = $request->input('passportAvailable');
        $passportExpDate = $request->input('passportExpDate');
        $issuingCountry = $request->input('issuingCountry');
        $countryOfBirth = $request->input('countryOfBirth');
        $passportPic = $request->file('passportPic');

        // Server Side Validation
        $response = array();

        $validation = Validator::make(
                        array(
                    'fname' => $fname,
                    'lname' => $lname,
                    'dob' => $dob,
                    'email' => $email
                        ), array(
                    'fname' => array('required'),
                    'lname' => array('required'),
                    'dob' => array('required'),
                    'email' => array('required', 'email')
                        ), array(
                    'fname.required' => 'Please enter first name',
                    'lname.required' => 'Please enter last name',
                    'dob.required' => 'Please select dob',
                    'email.required' => 'Please enter email',
                    'email.email' => 'Please enter valid email'
                        )
        );

        if ($validation->fails()) {  // Some data is not valid as per the defined rules
            $error = $validation->errors()->first();

            if (isset($error) && !empty($error)) {
                $response['errCode'] = 1;
                $response['errMsg'] = $error;
            }
        } else {
            if ($passportAvailable == '1') {  // Passport available
                if (isset($passportPic) && count($passportPic) > 0) {
                    $destinationPath = storage_path() . '/uploads/passport_images/';

                    if ($passportPic->isValid()) {  // If the file is valid or not
                        $fileExt = $passportPic->getClientOriginalExtension();
                        $fileType = $passportPic->getMimeType();
                        $fileSize = $passportPic->getSize();

                        if (( $fileType == 'image/jpeg' || $fileType == 'image/png' ) && $fileSize <= 3000000) {     // 3 MB = 3000000 Bytes
                            // Rename the file
                            $fileNewName = str_random(10) . '.' . $fileExt;

                            if ($passportPic->move($destinationPath, $fileNewName)) {
                                // Get the logged-in user id
                                $userId = Auth::id();

                                $userDetails = array(
                                    'email' => $email,
                                    'first_name' => $fname,
                                    'last_name' => $lname,
                                    'gender' => $gender,
                                    'dob' => $dob,
                                    'is_passport' => $passportAvailable,
                                    'passport_pic' => $fileNewName,
                                    'passport_exp_date' => $passportExpDate,
                                    'issuing_country' => $issuingCountry,
                                    'country_of_Birth' => $countryOfBirth,
                                );

                                if (User::where(['id' => $userId])->update($userDetails)) {
                                    $response['errCode'] = 0;
                                    $response['errMsg'] = 'Profile updated successfully';
                                } else {
                                    $response['errCode'] = 4;
                                    $response['errMsg'] = 'Some issue in profile update';
                                }
                            } else {
                                $response['errCode'] = 2;
                                $response['errMsg'] = 'Some issue in uploading the file';
                            }
                        } else {
                            $response['errCode'] = 3;
                            $response['errMsg'] = 'Only image file with size less than 3MB is allowed';
                        }
                    }
                }
            } else { 
                // Passport is not available
                // Get the logged-in user id
                $userId = Auth::id();
                $userDetails = array(
                    'email' => $email,
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'gender' => $gender,
                    'dob' => $dob,
                    'is_passport' => $passportAvailable,
                );
                if (User::where(['id' => $userId])->update($userDetails)) {
                    $response['errCode'] = 0;
                    $response['errMsg'] = 'Profile updated successfully';
                } else {
                    $response['errCode'] = 4;
                    $response['errMsg'] = 'Some issue in profile update';
                }
            }
        }
        return response()->json($response);
    }

    /**
     * Function to update user Profile information
     * @param void
     * @return url
     */
    public function updateUserProfileInfo(Request $request) {
        $profile_pic = $request->file('profile_pic')?$request->file('profile_pic'):'';
        $is_helth_mental = $request->input('is_helth_mental');
        $helth_mental_conditions = $request->input('helth_mental_conditions');
        $is_mental_conditions = $request->input('is_mental_conditions');
        $mental_conditions = $request->input('mental_conditions');
        $food_allergies = $request->input('food_allergies')?$request->input('food_allergies'):'';
        $shirt_size = $request->input('shirt_size');
        $emergency_contact_name = $request->input('emergency_contact_name');
        $emergency_contact_phone = $request->input('emergency_contact_phone');
        $personality_previous_travel = $request->input('personality_previous_travel');
        $personality_originally_from = $request->input('personality_originally_from');
        $personality_school = $request->input('personality_school');
        $personality_about = $request->input('personality_about');
        // Server Side Validation
        $response = array();
        $destinationPath = storage_path() . '/uploads/profile_images/';
        if ($profile_pic->isValid()) {  // If the file is valid or not
            $fileExt = $profile_pic->getClientOriginalExtension();
            $fileType = $profile_pic->getMimeType();
            $fileSize = $profile_pic->getSize();

            if (( $fileType == 'image/jpeg' || $fileType == 'image/png' ) && $fileSize <= 3000000) {     // 3 MB = 3000000 Bytes
                // Rename the file
                $fileNewName = str_random(10) . '.' . $fileExt;

                if ($profile_pic->move($destinationPath, $fileNewName)) {
                    // Get the logged-in user id
                    $userId = Auth::id();
                    $userProfileDetails = array(
                        'profile_pic' => $fileNewName,
                        'is_helth_mental' => $is_helth_mental,
                        'helth_mental_conditions' => $helth_mental_conditions,
                        'is_mental_conditions' => $is_mental_conditions,
                        'mental_conditions' => $mental_conditions,
                        'food_allergies' => $food_allergies,
                        'shirt_size' => $shirt_size,
                        'emergency_contact_name' => $emergency_contact_name,
                        'emergency_contact_phone' => $emergency_contact_phone,
                        'personality_previous_travel' => $personality_previous_travel,
                        'personality_originally_from' => $personality_originally_from,
                        'personality_school' => $personality_school,
                        'personality_about' => $personality_about
                    );

                    if (UserProfile::where(['user_id' => $userId])->update($userProfileDetails)) {
                        $response['errCode'] = 0;
                        $response['errMsg'] = 'Profile updated successfully';
                    } else {
                        $response['errCode'] = 4;
                        $response['errMsg'] = 'Some issue in profile update';
                    }
                } else {
                    $response['errCode'] = 2;
                    $response['errMsg'] = 'Some issue in uploading the file';
                }
            } else {
                $response['errCode'] = 3;
                $response['errMsg'] = 'Only image file with size less than 3MB is allowed';
            }
            // }  
        }
        return response()->json($response);
    }

    /**
     * Function to return create trip view
     * @param void
     * @return url
     */
    public function createTrip()
    {
        // Get the airlines list
    	$airlines = Airline::where(['status' => '1'])->get();
        $airlinesPluck = Airline::where(['status' => '1'])->pluck('name', 'id')->toArray();

        // Default misc expense
        $miscExpense = array('Collection Percentage', 'Shirts and Pamphlets', 'Photography');

        return view('admin/createTrip', compact('airlines', 'airlinesPluck', 'miscExpense'));
    }

    /**
     * Store a newly created trip and its component.
     *
     * @param Request $request
     *
     * @return Response
     */
    function storeTrip(Request $request)
    {
        // Validations
        $rules = [
            'name'          => 'required',
            'date'          => 'required',
            'end_date'      => 'required',
            'about_trip'    => 'required',
            'banner_image'  => 'required|image|mimes:jpg,png,jpeg|max:2048',
			'maximum_spots'     => 'required',
			'minimum_spots'  =>'required',
			'maximum_wating_spots' =>'required',
            'base_cost'     => 'required',
            'adjustment_date'   => 'required',
            'land_only_date'    => 'required',
			'refund_detail' =>'required'
        ];
		
        // Airline validation
        foreach($request->get('airline') as $key => $val)
        {
            $rules["airline.{$key}.airline_name"]           = 'required';
            $rules["airline.{$key}.airline_departure_date"] = 'required';
            $rules["airline.{$key}.airline_departure_time"] = 'required';
            $rules["airline.{$key}.airline_layovers"]       = 'required';
            $rules["airline.{$key}.airline_baggage_allowance"] = 'required';
            $rules["airline.{$key}.airline_our_cost"]       = 'required';
            $rules["airline.{$key}.airline_cost"]           = 'required';
            $rules["airline.{$key}.airline_due_date"]       = 'required';
            $rules["airline.{$key}.airline_reserve_type"]   = 'required';
            $rules["airline.{$key}.airline_reserve_amount"] = 'required';
			
			 $message["airline.{$key}.airline_departure_date.required"] = 'Air line departure date required';
			 $message["airline.{$key}.airline_departure_time.required"] = 'Air line departure time required';
			 $message["airline.{$key}.airline_layovers.required"] = 'Air line layovers required';
			 $message["airline.{$key}.airline_baggage_allowance.required"] = 'Air line baggage allowance required';
			 $message["airline.{$key}.airline_our_cost.required"] = 'Air line our cost required';
			 $message["airline.{$key}.airline_cost.required"] = 'Air line cost  date required';
			 $message["airline.{$key}.airline_due_date.required"] = 'Air line due date required';
			 $message["airline.{$key}.airline_reserve_amount.required"] = 'Air line reserve amount required';
				
			
        }

        // Included Activity validation
        foreach($request->get('included_activity') as $key => $val)
        {
            $rules["included_activity.{$key}.activity_name"]            = 'required';
            $rules["included_activity.{$key}.activity_detail"]          = 'required';
            $rules["included_activity.{$key}.activity_cost"]            = 'required';
            $rules["included_activity.{$key}.activity_our_cost"]        = 'required';
            $rules["included_activity.{$key}.activity_due_date"]        = 'required';
            $rules["included_activity.{$key}.activity_reserve_type"]    = 'required';
            $rules["included_activity.{$key}.activity_reserve_amount"]  = 'required';
			
			
			 $message["included_activity.{$key}.activity_name.required"] = 'Activity name required';
			 $message["included_activity.{$key}.activity_detail.required"] = 'Activity detail required';
			 $message["included_activity.{$key}.activity_cost.required"] = 'Activity cost required';
			 $message["included_activity.{$key}.activity_our_cost.required"] = 'Activity our cost required';
			 $message["included_activity.{$key}.activity_due_date.required"] = 'Activity due date required';
			 $message["included_activity.{$key}.activity_reserve_amount.required"] = 'Activity reserve amount required';
			

            // Included Activity Hotels
            foreach($request->get('included_activity')[$key]['activity_hotels'] as $key1 => $val1)
            {
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_name"]           = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_type"]           = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_cost"]           = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_solo_cost"]      = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_our_cost"]       = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_our_solo_cost"]  = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_due_date"]       = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_reserve_type"]   = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_reserve_amount"] = 'required';
				
			 
				$message["included_activity.{$key}.activity_hotels.{$key1}.hotel_name.required"]           = 'Activity hotel name required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_type.required"]           = 'Activity hotel type required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_cost.required"]           = 'Activity hotel cost required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_solo_cost.required"]      = 'Activity hotel solocost required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_our_cost.required"]       = 'Activity hotel our cost required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_our_solo_cost.required"]  = 'Activity hotel our solo cost required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_due_date.required"]       = 'Activity hotel due date required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_reserve_type.required"]   = 'Activity hotel reserve type required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_reserve_amount.required"] = 'Activity reserve amount required';
				
            }

            // Included Activity Airlines
            foreach($request->get('included_activity')[$key]['activity_airlines'] as $key1 => $val1)
            {
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_name"]           = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_departure_date"] = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_departure_time"] = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_layovers"]       = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_baggage_allowance"] = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_our_cost"]       = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_cost"]           = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_due_date"]       = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_reserve_type"]   = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_reserve_amount"] = 'required';
				
				
				$message["included_activity.{$key}.activity_airlines.{$key1}.airline_name.required"]           = 'Activity airline name required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_departure_date.required"]           = 'Activity airline departure date required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_departure_time.required"]           = 'Activity airline departure time required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_layovers.required"]      = 'Activity airline layovers required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_baggage_allowance.required"]       = 'Activity airline baggage allowance required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_our_cost.required"]  = 'Activity airline our cost required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_cost.required"]       = 'Activity airline cost required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_due_date.required"]   = 'Activity airline due date required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_reserve_type.required"] = 'Activity airline reserve type required';
				$message["included_activity.{$key}.activity_airlines.{$key1}.airline_reserve_amount.required"] = 'Activity airline reserve amount required';
            }
        }

        // Add-ons validation
        foreach($request->get('addon') as $key => $val)
        {
            $rules["addon.{$key}.addons_name"]            = 'required';
            $rules["addon.{$key}.addons_detail"]          = 'required';
            $rules["addon.{$key}.addons_cost"]            = 'required';
            $rules["addon.{$key}.addons_our_cost"]        = 'required';
            $rules["addon.{$key}.addons_due_date"]        = 'required';
            $rules["addon.{$key}.addons_reserve_type"]    = 'required';
            $rules["addon.{$key}.addons_reserve_amount"]  = 'required';
			$rules["addon.{$key}.addons_maximum_spots"]  = 'required';
			$rules["addon.{$key}.addons_minimum_spots"]  = 'required';
			$rules["addon.{$key}.addons_maximum_wating_spots"]  = 'required';
			
			
			 $message["addon.{$key}.addons_name.required"] = 'Addon name required';
			 $message["addon.{$key}.addons_detail.required"] = 'Addon detail required';
			 $message["addon.{$key}.addons_cost.required"] = 'Addon cost required';
			 $message["addon.{$key}.addons_our_cost.required"] = 'Addon our cost required';
			 $message["addon.{$key}.addons_due_date.required"] = 'Addon due date required';
			 $message["addon.{$key}.addons_reserve_type.required"] = 'Addon reserve amount required';
			 $message["addon.{$key}.addons_reserve_amount.required"] = 'Addon reserve amount required';
			 $message["addon.{$key}.addons_maximum_spots.required"]  = 'Addon maximum spots';
			$message["addon.{$key}.addons_minimum_spots.required"]  = 'Addon minimum spots';
			$message["addon.{$key}.addons_maximum_wating_spots.required"]  = 'Addon maximum waiting spots';

            // Included Activity Hotels
            foreach($request->get('addon')[$key]['addons_hotels'] as $key1 => $val1)
            {
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_name"]           = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_type"]           = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_cost"]           = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_solo_cost"]      = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_our_cost"]       = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_our_solo_cost"]  = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_due_date"]       = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_reserve_type"]   = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_reserve_amount"] = 'required';
				
				$message["addon.{$key}.addons_hotels.{$key1}.hotel_name.required"]           = 'Addon hotel name required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_type.required"]           = 'Addon hotel type required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_cost.required"]           = 'Addon hotel cost required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_solo_cost.required"]      = 'Addon hotel solocost required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_our_cost.required"]       = 'Addon hotel our cost required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_our_solo_cost.required"]  = 'Addon hotel our solo cost required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_due_date.required"]       = 'Addon hotel due date required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_reserve_type.required"]   = 'Addon hotel reserve type required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_reserve_amount.required"] = 'Addon reserve amount required';
            }

            // Included Activity Airlines
            foreach($request->get('addon')[$key]['addons_airlines'] as $key1 => $val1)
            {
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_name"]           = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_departure_date"] = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_departure_time"] = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_layovers"]       = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_baggage_allowance"] = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_our_cost"]       = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_cost"]           = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_due_date"]       = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_reserve_type"]   = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_reserve_amount"] = 'required';
				
				
				$message["addon.{$key}.addons_airlines.{$key1}.airline_name.required"]           = 'Addon airline name required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_departure_date.required"]           = 'Addon airline departure date required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_departure_time.required"]           = 'Addon airline departure time required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_layovers.required"]      = 'Addon airline layovers required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_baggage_allowance.required"]       = 'Addon airline baggage allowance required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_our_cost.required"]  = 'Addon airline our cost required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_cost.required"]       = 'Addon airline cost required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_due_date.required"]   = 'Addon airline due date required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_reserve_type.required"] = 'Addon airline reserve type required';
				$message["addon.{$key}.addons_airlines.{$key1}.airline_reserve_amount.required"] = 'Addon airline reserve amount required';
				
            }
        }

        // Hotel validation
        foreach($request->get('hotels') as $key => $val)
        {
            $rules["hotels.{$key}.hotel_name"]           = 'required';
            $rules["hotels.{$key}.hotel_type"]           = 'required';
            $rules["hotels.{$key}.hotel_cost"]           = 'required';
            $rules["hotels.{$key}.hotel_solo_cost"]      = 'required';
            $rules["hotels.{$key}.hotel_our_cost"]       = 'required';
            $rules["hotels.{$key}.hotel_our_solo_cost"]  = 'required';
            $rules["hotels.{$key}.hotel_due_date"]       = 'required';
            $rules["hotels.{$key}.hotel_reserve_type"]   = 'required';
            $rules["hotels.{$key}.hotel_reserve_amount"] = 'required';
			
			 $message["hotels.{$key}.hotel_name.required"] = 'Hotel name required';
			 $message["hotels.{$key}.hotel_type.required"] = 'Hotel type required';
			 $message["hotels.{$key}.hotel_cost.required"] = 'Hotel cost required';
			 $message["hotels.{$key}.hotel_solo_cost.required"] = 'Hotel solo cost required';
			 $message["hotels.{$key}.hotel_our_cost.required"] = 'Hotel our cost required';
			 $message["hotels.{$key}.hotel_our_solo_cost.required"] = 'Hotel our solo cost  date required';
			 $message["hotels.{$key}.hotel_due_date.required"] = 'Hotel due date required';
			 $message["hotels.{$key}.hotel_reserve_type.required"] = 'Hotel reserve type required';
			 $message["hotels.{$key}.hotel_reserve_amount.required"] = 'Hotel reserve amount required';
        }

        // To-do validation
        foreach($request->get('to_do') as $key => $val)
        {
            $rules["to_do.{$key}.todo_name"] = 'required';
			$message["to_do.{$key}.todo_name.required"] = 'To do name required';
        }

        // Misc expense validation
        foreach($request->get('misc_expense') as $key => $val)
        {
            // Validation upto 3 column 'default'
            if($key <= 2)
            {
                $rules["misc_expense.{$key}.label"] = 'required';
                $rules["misc_expense.{$key}.value"] = 'required';
				$message["misc_expense.{$key}.label.required"] = 'The misc expense  required';
				$message["misc_expense.{$key}.value.required"] = 'The misc expense  required';
            }
        }

//        echo '<pre>'; print_r($request->all()); exit;

        $this->validate($request, $rules,$message);

        // Create trip
        $trip = $request->only(['name', 'date', 'end_date', 'about_trip', 'banner_video', 'maximum_spots' ,'minimum_spots', 'maximum_wating_spots', 'base_cost', 'adjustment_date', 'land_only_date', 'requirement_is_passport', 'requirement_passport_min_expiry', 'requirement_is_visa', 'requirement_visa_cost', 'requirement_visa_process', 'requirement_is_shots', 'requirement_shots_cost', 'requirement_shots_timeframe','refund_detail']);
          
        if( $request->hasFile('banner_image') )
        {
            $trip['banner_image'] = $this->imageUpload($request->file('banner_image'), 'trip', 'banner-img');
        }

        $id = Trip::create($trip)->id;
        //$id  = 24;

        // If trip created successfully, add other detail
        if($id)
        {
            // Add Airline
            $airline = $request->input('airline');

            foreach($airline as $row)
            {
                $row['trip_id'] = $id;

                TripAirline::create($row);
            }

            // Add Included Activity, Included Activity Holel, Included Activity Airline
            $included_activity = $request->input('included_activity');

            foreach($included_activity as $index => $row)
            {
                // Add Included Activity
                $fileName = '';
                if( $request->hasFile('included_activity.'.$index.'.activity_image') )
                {
                    $fileName = $this->imageUpload($request->file('included_activity.'.$index.'.activity_image'), 'trip', 'activity-img');
                }

                $activity_id = TripIncludedActivity::create(array(
                    'trip_id'               => $id,
                    'activity_name'         => $row['activity_name'],
                    'activity_detail'       => $row['activity_detail'],
                    'activity_cost'         => $row['activity_cost'],
                    'activity_our_cost'     => $row['activity_our_cost'],
                    'activity_due_date'     => $row['activity_due_date'],
                    'activity_reserve_type' => $row['activity_reserve_type'],
                    'activity_reserve_amount' => $row['activity_reserve_amount'],
                    'activity_image'        => $fileName
                ))->id;

                // Add Included Hotel
                foreach($row['activity_hotels'] as $row_hotel)
                {
                    TripIncludedActivityHotel::create(array(
                        'trip_id'               => $id,
                        'activity_id'           => $activity_id,
                        'hotel_name'            => $row_hotel['hotel_name'],
                        'hotel_type'            => $row_hotel['hotel_type'],
                        'hotel_cost'            => $row_hotel['hotel_cost'],
                        'hotel_solo_cost'       => $row_hotel['hotel_solo_cost'],
                        'hotel_our_cost'        => $row_hotel['hotel_our_cost'],
                        'hotel_our_solo_cost'   => $row_hotel['hotel_our_solo_cost'],
                        'hotel_due_date'        => $row_hotel['hotel_due_date'],
                        'hotel_reserve_type'    => $row_hotel['hotel_reserve_type'],
                        'hotel_reserve_amount'  => $row_hotel['hotel_reserve_amount'],
                    ));
                }

                // Add Included Airline
                foreach($row['activity_airlines'] as $row_airline)
                {
                    TripIncludedActivityAirline::create(array(
                        'trip_id'                   => $id,
                        'activity_id'               => $activity_id,
                        'airline_name'              => $row_airline['airline_name'],
                        'airline_departure_date'    => $row_airline['airline_departure_date'],
                        'airline_departure_time'    => $row_airline['airline_departure_time'],
                        'airline_departure_location' => $row_airline['airline_departure_location'],
                        'airline_layovers'          => $row_airline['airline_layovers'],
                        'airline_baggage_allowance' => $row_airline['airline_baggage_allowance'],
                        'airline_our_cost'          => $row_airline['airline_our_cost'],
                        'airline_cost'              => $row_airline['airline_cost'],
                        'airline_due_date'          => $row_airline['airline_due_date'],
                        'airline_reserve_type'      => $row_airline['airline_reserve_type'],
                        'airline_reserve_amount'    => $row_airline['airline_reserve_amount'],
                    ));
                }
            }

            // Add Addon, Addon Holel, Addon Airline
            $addon = $request->input('addon');

            foreach($addon as $index => $row)
            {
                // Add Addon
                $fileName = '';
                if( $request->hasFile('addon.'.$index.'.addons_image') )
                {
                    $fileName = $this->imageUpload($request->file('addon.'.$index.'.addons_image'), 'trip', 'addons-img');
                }

                $addon_id = TripAddon::create(array(
                    'trip_id'               => $id,
                    'addons_name'         => $row['addons_name'],
                    'addons_detail'       => $row['addons_detail'],
                    'addons_cost'         => $row['addons_cost'],
                    'addons_our_cost'     => $row['addons_our_cost'],
                    'addons_due_date'     => $row['addons_due_date'],
                    'addons_reserve_type' => $row['addons_reserve_type'],
                    'addons_reserve_amount' => $row['addons_reserve_amount'],
                    'addons_image'        => $fileName,
					'addons_maximum_spots'=>$row['addons_maximum_spots'],
					'addons_minimum_spots'=>$row['addons_minimum_spots'],
					'addons_maximum_wating_spots'=>$row['addons_maximum_wating_spots']
                ))->id;

                // Add Addon Hotel
                foreach($row['addons_hotels'] as $row_hotel)
                {
                    TripAddonHotel::create(array(
                        'trip_id'               => $id,
                        'addon_id'              => $addon_id,
                        'hotel_name'            => $row_hotel['hotel_name'],
                        'hotel_type'            => $row_hotel['hotel_type'],
                        'hotel_cost'            => $row_hotel['hotel_cost'],
                        'hotel_solo_cost'       => $row_hotel['hotel_solo_cost'],
                        'hotel_our_cost'        => $row_hotel['hotel_our_cost'],
                        'hotel_our_solo_cost'   => $row_hotel['hotel_our_solo_cost'],
                        'hotel_due_date'        => $row_hotel['hotel_due_date'],
                        'hotel_reserve_type'    => $row_hotel['hotel_reserve_type'],
                        'hotel_reserve_amount'  => $row_hotel['hotel_reserve_amount'],
                    ));
                }

                // Add Addon Airline
                foreach($row['addons_airlines'] as $row_airline)
                {
                    TripAddonAirline::create(array(
                        'trip_id'                   => $id,
                        'addon_id'                  => $addon_id,
                        'airline_name'              => $row_airline['airline_name'],
                        'airline_departure_date'    => $row_airline['airline_departure_date'],
                        'airline_departure_time'    => $row_airline['airline_departure_time'],
                        'airline_departure_location' => $row_airline['airline_departure_location'],
                        'airline_layovers'          => $row_airline['airline_layovers'],
                        'airline_baggage_allowance' => $row_airline['airline_baggage_allowance'],
                        'airline_our_cost'          => $row_airline['airline_our_cost'],
                        'airline_cost'              => $row_airline['airline_cost'],
                        'airline_due_date'          => $row_airline['airline_due_date'],
                        'airline_reserve_type'      => $row_airline['airline_reserve_type'],
                        'airline_reserve_amount'    => $row_airline['airline_reserve_amount'],
                    ));
                }
            }

            // Add Hotel
            $hotels = $request->input('hotels');

            foreach($hotels as $row)
            {
                $row['trip_id'] = $id;

                TripHotel::create($row);
            }

            // Add to-do list
            $to_do = $request->input('to_do');

            foreach($to_do as $row)
            {
                $row['trip_id'] = $id;

                TripTodo::create($row);
            }

            // Add Misc Expense
            $misc_expense = $request->input('misc_expense');

            foreach($misc_expense as $row)
            {
                if( !empty(trim($row['label'])) || !empty(trim($row['value'])) )
                {
                    $row['trip_id'] = $id;

                    TripMiscExpense::create($row);
                }
            }
        }

        $request->session()->flash('success', 'Trip created successfully!');

        return redirect('admin/listtrip');
    }

    /**
     * Function to return view for edit trip
     *
     * @param  int  $id
     * @return url
     */
    function editTrip($id)
    {
        // Get trip
        $trip = Trip::find($id);

        if(empty($trip))
        {
            $request->session()->flash('error', 'Trip not found!');

            return redirect('admin/listtrip');
        }

        // Get trip airline
        $tripAirline = TripAirline::where(['trip_id' => $id, 'status' => '1' ])->get();

        // Get trip included activity and its associated hotels and airline
        $tripIncludedActivity = TripIncludedActivity::where(['trip_id' => $id, 'status' => '1'])->get();

        if( !empty($tripIncludedActivity) )
        {
            foreach($tripIncludedActivity as $key => $value)
            {
                $tripIncludedActivity[$key]['activity_hotels'] = TripIncludedActivityHotel::where(['trip_id' => $id, 'activity_id' => $value->id, 'status' => '1'])->get();

                $tripIncludedActivity[$key]['activity_airlines'] = TripIncludedActivityAirline::where(['trip_id' => $id, 'activity_id' => $value->id, 'status' => '1'])->get();
            }
        }

        // Get addons and its associated hotels and airline
        $tripAddon = TripAddon::where(['trip_id' => $id, 'status' => '1'])->get();

        if( !empty($tripAddon) )
        {
            foreach($tripAddon as $key => $value)
            {
                $tripAddon[$key]['addons_hotels'] = TripAddonHotel::where(['trip_id' => $id, 'addon_id' => $value->id, 'status' => '1'])->get();

                $tripAddon[$key]['addons_airlines'] = TripAddonAirline::where(['trip_id' => $id, 'addon_id' => $value->id, 'status' => '1'])->get();
            }
        }

        // Get trip hotel
        $tripHotel = TripHotel::where(['trip_id' => $id, 'status' => '1'])->get();

        // Get trip todo
        $tripTodo = TripTodo::where(['trip_id' => $id, 'status' => '1'])->get();

        // Get trip misc expense
        $tripMiscExpense = TripMiscExpense::where(['trip_id' => $id])->get();
        
      //  echo '<pre>'; print_r($tripMiscExpense); exit;
        
        // Combine all trip associates data into trip to fill it automatically into edit form
        $trip['airline']            = $tripAirline;
        $trip['included_activity']  = $tripIncludedActivity;
        $trip['addon']              = $tripAddon;
        $trip['hotels']             = $tripHotel;
        $trip['to_do']              = $tripTodo;
        $trip['misc_expense']       = $tripMiscExpense;

       

        // Get the airlines list
        $airlines = Airline::where(['status' => '1'])->get();
        $airlinesPluck = Airline::where(['status' => '1'])->pluck('name', 'id')->toArray();

        // Default misc expense
        $miscExpense = array('Collection Percentage', 'Shirts and Pamphlets', 'Photography');

        return view('admin/edittrip', compact('airlines', 'airlinesPluck', 'miscExpense'))->with('trip', $trip);
    }

    /**
     * Update the trip.
     * 
     * @param int  $id
     * @param Request $request
     *
     * @return Response
     */
    public function updateTrip($id, Request $request)
    {
        // Validations
        $rules = [
            'name'          => 'required',
            'date'          => 'required',
            'end_date'      => 'required',
            'about_trip'    => 'required',
            'banner_image'  => 'image|mimes:jpg,png,jpeg|max:2048',
			'maximum_spots'     => 'required',
			'minimum_spots'  =>'required',
			'maximum_wating_spots' =>'required',
            'base_cost'     => 'required',            
            'adjustment_date'   => 'required',
            'land_only_date'    => 'required',
			'refund_detail' => 'required'
        ];

        // Airline validation
		//echo '<pre>';print_r($request->get('airline'));die;
        foreach($request->get('airline') as $key => $val)
        {
            $rules["airline.{$key}.airline_name"]           = 'required';
            $rules["airline.{$key}.airline_departure_date"] = 'required';
            $rules["airline.{$key}.airline_departure_time"] = 'required';
            $rules["airline.{$key}.airline_layovers"]       = 'required';
            $rules["airline.{$key}.airline_baggage_allowance"] = 'required';
            $rules["airline.{$key}.airline_our_cost"]       = 'required';
            $rules["airline.{$key}.airline_cost"]           = 'required';
            $rules["airline.{$key}.airline_due_date"]       = 'required';
            $rules["airline.{$key}.airline_reserve_type"]   = 'required';
            $rules["airline.{$key}.airline_reserve_amount"] = 'required';
			
			 $message["airline.{$key}.airline_departure_date.required"] = 'Air line departure date required';
			 $message["airline.{$key}.airline_departure_time.required"] = 'Air line departure time required';
			 $message["airline.{$key}.airline_layovers.required"] = 'Air line layovers required';
			 $message["airline.{$key}.airline_baggage_allowance.required"] = 'Air line baggage allowance required';
			 $message["airline.{$key}.airline_our_cost.required"] = 'Air line our cost required';
			 $message["airline.{$key}.airline_cost.required"] = 'Air line cost  date required';
			 $message["airline.{$key}.airline_due_date.required"] = 'Air line due date required';
			 $message["airline.{$key}.airline_reserve_amount.required"] = 'Air line reserve amount required';
        }

        // Included Activity validation
        foreach($request->get('included_activity') as $key => $val)
        {
            $rules["included_activity.{$key}.activity_name"]            = 'required';
            $rules["included_activity.{$key}.activity_detail"]          = 'required';
            $rules["included_activity.{$key}.activity_cost"]            = 'required';
            $rules["included_activity.{$key}.activity_our_cost"]        = 'required';
            $rules["included_activity.{$key}.activity_due_date"]        = 'required';
            $rules["included_activity.{$key}.activity_reserve_type"]    = 'required';
            $rules["included_activity.{$key}.activity_reserve_amount"]  = 'required';
			
			$message["included_activity.{$key}.activity_name.required"] = 'Activity name required';
			 $message["included_activity.{$key}.activity_detail.required"] = 'Activity detail required';
			 $message["included_activity.{$key}.activity_cost.required"] = 'Activity cost required';
			 $message["included_activity.{$key}.activity_our_cost.required"] = 'Activity our cost required';
			 $message["included_activity.{$key}.activity_due_date.required"] = 'Activity due date required';
			 $message["included_activity.{$key}.activity_reserve_amount.required"] = 'Activity reserve amount required';

            // Included Activity Hotels
            foreach($request->get('included_activity')[$key]['activity_hotels'] as $key1 => $val1)
            {
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_name"]           = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_type"]           = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_cost"]           = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_solo_cost"]      = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_our_cost"]       = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_our_solo_cost"]  = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_due_date"]       = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_reserve_type"]   = 'required';
                $rules["included_activity.{$key}.activity_hotels.{$key1}.hotel_reserve_amount"] = 'required';
				
				
				
				$message["included_activity.{$key}.activity_hotels.{$key1}.hotel_name.required"]           = 'Activity hotel name required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_type.required"]           = 'Activity hotel type required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_cost.required"]           = 'Activity hotel cost required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_solo_cost.required"]      = 'Activity hotel solocost required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_our_cost.required"]       = 'Activity hotel our cost required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_our_solo_cost.required"]  = 'Activity hotel our solo cost required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_due_date.required"]       = 'Activity hotel due date required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_reserve_type.required"]   = 'Activity hotel reserve type required';
                $message["included_activity.{$key}.activity_hotels.{$key1}.hotel_reserve_amount.required"] = 'Activity reserve amount required';
				
            }

            // Included Activity Airlines
            foreach($request->get('included_activity')[$key]['activity_airlines'] as $key1 => $val1)
            {
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_name"]           = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_departure_date"] = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_departure_time"] = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_layovers"]       = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_baggage_allowance"] = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_our_cost"]       = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_cost"]           = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_due_date"]       = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_reserve_type"]   = 'required';
                $rules["included_activity.{$key}.activity_airlines.{$key1}.airline_reserve_amount"] = 'required';
				
				
				$message["included_activity.{$key}.activity_airlines.{$key1}.airline_name.required"]           = 'Activity airline name required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_departure_date.required"]           = 'Activity airline departure date required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_departure_time.required"]           = 'Activity airline departure time required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_layovers.required"]      = 'Activity airline layovers required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_baggage_allowance.required"]       = 'Activity airline baggage allowance required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_our_cost.required"]  = 'Activity airline our cost required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_cost.required"]       = 'Activity airline cost required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_due_date.required"]   = 'Activity airline due date required';
                $message["included_activity.{$key}.activity_airlines.{$key1}.airline_reserve_type.required"] = 'Activity airline reserve type required';
				$message["included_activity.{$key}.activity_airlines.{$key1}.airline_reserve_amount.required"] = 'Activity airline reserve amount required';
				
            }
        }

        // Add-ons validation
        foreach($request->get('addon') as $key => $val)
        {
            $rules["addon.{$key}.addons_name"]            = 'required';
            $rules["addon.{$key}.addons_detail"]          = 'required';
            $rules["addon.{$key}.addons_cost"]            = 'required';
            $rules["addon.{$key}.addons_our_cost"]        = 'required';
            $rules["addon.{$key}.addons_due_date"]        = 'required';
            $rules["addon.{$key}.addons_reserve_type"]    = 'required';
            $rules["addon.{$key}.addons_reserve_amount"]  = 'required';
			$rules["addon.{$key}.addons_maximum_spots"]  = 'required';
			$rules["addon.{$key}.addons_minimum_spots"]  = 'required';
			$rules["addon.{$key}.addons_maximum_wating_spots"]  = 'required';
			
			 $message["addon.{$key}.addons_name.required"] = 'Addon name required';
			 $message["addon.{$key}.addons_detail.required"] = 'Addon detail required';
			 $message["addon.{$key}.addons_cost.required"] = 'Addon cost required';
			 $message["addon.{$key}.addons_our_cost.required"] = 'Addon our cost required';
			 $message["addon.{$key}.addons_due_date.required"] = 'Addon due date required';
			 $message["addon.{$key}.addons_reserve_type.required"] = 'Addon reserve amount required';
			 $message["addon.{$key}.addons_reserve_amount.required"] = 'Addon reserve amount required';
			 $message["addon.{$key}.addons_maximum_spots.required"]  = 'Addon maximum spots';
			$message["addon.{$key}.addons_minimum_spots.required"]  = 'Addon minimum spots';
			$message["addon.{$key}.addons_maximum_wating_spots.required"]  = 'Addon maximum waiting spots';
			 

            // Included Activity Hotels
            foreach($request->get('addon')[$key]['addons_hotels'] as $key1 => $val1)
            {
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_name"]           = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_type"]           = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_cost"]           = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_solo_cost"]      = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_our_cost"]       = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_our_solo_cost"]  = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_due_date"]       = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_reserve_type"]   = 'required';
                $rules["addon.{$key}.addons_hotels.{$key1}.hotel_reserve_amount"] = 'required';
				
				$message["addon.{$key}.addons_hotels.{$key1}.hotel_name.required"]           = 'Addon hotel name required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_type.required"]           = 'Addon hotel type required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_cost.required"]           = 'Addon hotel cost required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_solo_cost.required"]      = 'Addon hotel solocost required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_our_cost.required"]       = 'Addon hotel our cost required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_our_solo_cost.required"]  = 'Addon hotel our solo cost required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_due_date.required"]       = 'Addon hotel due date required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_reserve_type.required"]   = 'Addon hotel reserve type required';
                $message["addon.{$key}.addons_hotels.{$key1}.hotel_reserve_amount.required"] = 'Addon reserve amount required';
            }

            // Included Activity Airlines
            foreach($request->get('addon')[$key]['addons_airlines'] as $key1 => $val1)
            {
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_name"]           = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_departure_date"] = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_departure_time"] = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_layovers"]       = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_baggage_allowance"] = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_our_cost"]       = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_cost"]           = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_due_date"]       = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_reserve_type"]   = 'required';
                $rules["addon.{$key}.addons_airlines.{$key1}.airline_reserve_amount"] = 'required';
				
				$message["addon.{$key}.addons_airlines.{$key1}.airline_name.required"]           = 'Addon airline name required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_departure_date.required"]           = 'Addon airline departure date required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_departure_time.required"]           = 'Addon airline departure time required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_layovers.required"]      = 'Addon airline layovers required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_baggage_allowance.required"]       = 'Addon airline baggage allowance required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_our_cost.required"]  = 'Addon airline our cost required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_cost.required"]       = 'Addon airline cost required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_due_date.required"]   = 'Addon airline due date required';
                $message["addon.{$key}.addons_airlines.{$key1}.airline_reserve_type.required"] = 'Addon airline reserve type required';
				$message["addon.{$key}.addons_airlines.{$key1}.airline_reserve_amount.required"] = 'Addon airline reserve amount required';
				
            }
        }

        // Hotel validation
        foreach($request->get('hotels') as $key => $val)
        {
            $rules["hotels.{$key}.hotel_name"]           = 'required';
            $rules["hotels.{$key}.hotel_type"]           = 'required';
            $rules["hotels.{$key}.hotel_cost"]           = 'required';
            $rules["hotels.{$key}.hotel_solo_cost"]      = 'required';
            $rules["hotels.{$key}.hotel_our_cost"]       = 'required';
            $rules["hotels.{$key}.hotel_our_solo_cost"]  = 'required';
            $rules["hotels.{$key}.hotel_due_date"]       = 'required';
            $rules["hotels.{$key}.hotel_reserve_type"]   = 'required';
            $rules["hotels.{$key}.hotel_reserve_amount"] = 'required';
			
			$message["hotels.{$key}.hotel_name.required"] = 'Hotel name required';
			 $message["hotels.{$key}.hotel_type.required"] = 'Hotel type required';
			 $message["hotels.{$key}.hotel_cost.required"] = 'Hotel cost required';
			 $message["hotels.{$key}.hotel_solo_cost.required"] = 'Hotel solo cost required';
			 $message["hotels.{$key}.hotel_our_cost.required"] = 'Hotel our cost required';
			 $message["hotels.{$key}.hotel_our_solo_cost.required"] = 'Hotel our solo cost  date required';
			 $message["hotels.{$key}.hotel_due_date.required"] = 'Hotel due date required';
			 $message["hotels.{$key}.hotel_reserve_type.required"] = 'Hotel reserve type required';
			 $message["hotels.{$key}.hotel_reserve_amount.required"] = 'Hotel reserve amount required';
        }

        // To-do validation
        foreach($request->get('to_do') as $key => $val)
        {
            $rules["to_do.{$key}.todo_name"] = 'required';
			$message["to_do.{$key}.todo_name.required"] = 'To do name required';
        }

        // Misc expense validation
        foreach($request->get('misc_expense') as $key => $val)
        {
            // Validation upto 3 column 'default'
            if($key <= 2)
            {
                $rules["misc_expense.{$key}.label"] = 'required';
                $rules["misc_expense.{$key}.value"] = 'required';
				$message["misc_expense.{$key}.label.required"] = 'The misc expense  required';
				$message["misc_expense.{$key}.value.required"] = 'The misc expense  required';
            }
        }

       

        $this->validate($request, $rules,$message);

        // 'UPDATE' Get trip data and update it
        $trip = Trip::findOrFail($id);

        $dataTrip = $request->only(['name', 'date', 'end_date', 'about_trip', 'banner_video', 'maximum_spots' ,'minimum_spots', 'maximum_wating_spots', 'base_cost', 'adjustment_date', 'land_only_date', 'requirement_is_passport', 'requirement_passport_min_expiry', 'requirement_is_visa', 'requirement_visa_cost', 'requirement_visa_process', 'requirement_is_shots', 'requirement_shots_cost', 'requirement_shots_timeframe','refund_detail']);
		//echo '<pre>'; print_r($dataTrip); exit;
        if($dataTrip['requirement_is_passport'] == '0')
        {
            $dataTrip['requirement_passport_min_expiry'] = NULL;
        }

        if($dataTrip['requirement_is_visa'] == '0')
        {
            $dataTrip['requirement_visa_cost'] = NULL;
            $dataTrip['requirement_visa_process'] = NULL;
        }

        if($dataTrip['requirement_is_shots'] == '0')
        {
            $dataTrip['requirement_shots_cost'] = NULL;
            $dataTrip['requirement_shots_timeframe'] = NULL;
        }
        
        
        
        // Upload trip image
        if ($request->hasFile('banner_image'))
        {
            $dataTrip['banner_image'] = $this->imageUpload($request->file('banner_image'), 'trip', 'banner-img');
           
        }
	//echo '<pre>';print_r($dataTrip);die;
        $trip->update($dataTrip);

        
        // 'UPDATE' TRIP AIRLINE
        $existingIds = TripAirline::where('trip_id', $id)->pluck('id')->toArray();
		
        $updatingIds = array();
        
        // Get post airline
        $airline = $request->input('airline');
		
        foreach($airline as $row)
        {

            if( isset($row['airline_id']) && is_numeric($row['airline_id']) )
            {
                $updatingIds[] = $row['airline_id'];

                // Update trip airline
                $findRow = TripAirline::findOrFail($row['airline_id']);
                $findRow->update($row);
            }
            else
            {
                $row['trip_id'] = $id;
                TripAirline::create($row);
            }
        }

        // Delete airline by ids
        $deleteRowByIds = array_diff($existingIds, $updatingIds);
        //echo '<pre>'; print_r($deleteRowByIds); exit;
        
        if( !empty($deleteRowByIds) )
        {
            TripAirline::destroy($deleteRowByIds);
        }

        // 'UPDATE' INCLUDED ACTIVITY
        $this->updateTripIncludedActivity($id, $request);

        // 'UPDATE' ADD-ONS
        $this->updateTripAddon($id, $request);
        
        // 'UPDATE' TRIP HOTEL
        $existingIds = TripHotel::where('trip_id', $id)->pluck('id')->toArray();
        $updatingIds = array();
        
        // Get post hotel
        $hotels = $request->input('hotels');

        foreach($hotels as $row)
        {
            if( isset($row['hotel_id']) && is_numeric($row['hotel_id']) )
            {
                $updatingIds[] = $row['hotel_id'];

                // Update trip hotels
                $findRow = TripHotel::findOrFail($row['hotel_id']);
                $findRow->update($row);
            }
            else
            {
                $row['trip_id'] = $id;
                TripHotel::create($row);
            }
        }

        // Delete hotel by ids
        $deleteRowByIds = array_diff($existingIds, $updatingIds);
        
        if( !empty($deleteRowByIds) )
        {
            TripHotel::destroy($deleteRowByIds);
        }

        
        // 'UPDATE' TRIP TODO
        $existingIds = TripTodo::where('trip_id', $id)->pluck('id')->toArray();
        $updatingIds = array();
        
        // Get post todo
        $to_do = $request->input('to_do');

        foreach($to_do as $row)
        {
            if( isset($row['todo_id']) && is_numeric($row['todo_id']) )
            {
                $updatingIds[] = $row['todo_id'];

                // Update trip to_do
                $findRow = TripTodo::findOrFail($row['todo_id']);
                $findRow->update($row);
            }
            else
            {
                $row['trip_id'] = $id;
                TripTodo::create($row);
            }
        }

        // Delete todo by ids
        $deleteRowByIds = array_diff($existingIds, $updatingIds);
        
        if( !empty($deleteRowByIds) )
        {
            TripTodo::destroy($deleteRowByIds);
        }

        // 'UPDATE' MISC EXPENSE
        $existingIds = TripMiscExpense::where('trip_id', $id)->pluck('id')->toArray();
        $updatingIds = array();

        // Get post misc
        $misc_expense = $request->input('misc_expense');
        //echo '<pre>'; print_r($misc_expense); exit;

        foreach($misc_expense as $row)
        {
            if( isset($row['misc_id']) && is_numeric($row['misc_id']) )
            {
                $updatingIds[] = $row['misc_id'];

                // Update trip to_do
                $findRow = TripMiscExpense::findOrFail($row['misc_id']);
                $findRow->update($row);
            }
            else
            {
                if( !empty(trim($row['label'])) || !empty(trim($row['value'])) )
                {
                    $row['trip_id'] = $id;
                    TripMiscExpense::create($row);
                }
            }
        }

        // Delete misc by ids
        $deleteRowByIds = array_diff($existingIds, $updatingIds);
        
        if( !empty($deleteRowByIds) )
        {
            TripMiscExpense::destroy($deleteRowByIds);
        }

        //
        $request->session()->flash('success', 'Trip updated successfully!');

        return redirect('admin/listtrip');
    }

    /**
     * Update trip included activity
     *
     * @param  int  $id
     * @param $request
     */
    function updateTripIncludedActivity($id, $request)
    {
        $existingActivityIds = TripIncludedActivity::where('trip_id', $id)->pluck('id')->toArray();
        $updatingActivityIds = array();

        // Get post activity
        $included_activity = $request->input('included_activity');

        // echo '<pre>'; print_r($included_activity); exit;

        foreach($included_activity as $index => $row)
        {
            if( isset($row['activity_id']) && is_numeric($row['activity_id']) )
            {
                $updatingActivityIds[] = $row['activity_id'];

                // Update Included Activity
                $includedActivity = TripIncludedActivity::findOrFail($row['activity_id']);

                $data = array(
                    'activity_name'         => $row['activity_name'],
                    'activity_detail'       => $row['activity_detail'],
                    'activity_cost'         => $row['activity_cost'],
                    'activity_our_cost'     => $row['activity_our_cost'],
                    'activity_due_date'     => $row['activity_due_date'],
                    'activity_reserve_type' => $row['activity_reserve_type'],
                    'activity_reserve_amount' => $row['activity_reserve_amount'],
                );

                if( $request->hasFile('included_activity.'.$index.'.activity_image') )
                {
                    $data['activity_image'] = $this->imageUpload($request->file('included_activity.'.$index.'.activity_image'), 'trip', 'activity-img');

                    // Delete included activity image
                    if( !empty($includedActivity->activity_image) )
                    {
                        $image_path = public_path('/uploads/trip/'.$includedActivity->activity_image);

                        if(File::exists($image_path))
                        {
                            File::delete($image_path);
                        }
                    }
                }

                $includedActivity->update($data);

                // Update Included Hotel
                $existingHotelIds = TripIncludedActivityHotel::where(['trip_id' => $id, 'activity_id' => $row['activity_id']])->pluck('id')->toArray();
                $updatingHotelIds = array();
                
                foreach($row['activity_hotels'] as $row_hotel)
                {
                    if( isset($row_hotel['hotel_id']) && is_numeric($row_hotel['hotel_id']) )
                    {
                        $updatingHotelIds[] = $row_hotel['hotel_id'];

                        // Update
                        $includedActivityHotel = TripIncludedActivityHotel::findOrFail($row_hotel['hotel_id']);

                        $data = array(
                            'hotel_name'            => $row_hotel['hotel_name'],
                            'hotel_type'            => $row_hotel['hotel_type'],
                            'hotel_cost'            => $row_hotel['hotel_cost'],
                            'hotel_solo_cost'       => $row_hotel['hotel_solo_cost'],
                            'hotel_our_cost'        => $row_hotel['hotel_our_cost'],
                            'hotel_our_solo_cost'   => $row_hotel['hotel_our_solo_cost'],
                            'hotel_due_date'        => $row_hotel['hotel_due_date'],
                            'hotel_reserve_type'    => $row_hotel['hotel_reserve_type'],
                            'hotel_reserve_amount'  => $row_hotel['hotel_reserve_amount'],
                        );

                        $includedActivityHotel->update($data);
                    }
                    else
                    {
                        // Create
                        TripIncludedActivityHotel::create(array(
                            'trip_id'               => $id,
                            'activity_id'           => $row['activity_id'],
                            'hotel_name'            => $row_hotel['hotel_name'],
                            'hotel_type'            => $row_hotel['hotel_type'],
                            'hotel_cost'            => $row_hotel['hotel_cost'],
                            'hotel_solo_cost'       => $row_hotel['hotel_solo_cost'],
                            'hotel_our_cost'        => $row_hotel['hotel_our_cost'],
                            'hotel_our_solo_cost'   => $row_hotel['hotel_our_solo_cost'],
                            'hotel_due_date'        => $row_hotel['hotel_due_date'],
                            'hotel_reserve_type'    => $row_hotel['hotel_reserve_type'],
                            'hotel_reserve_amount'  => $row_hotel['hotel_reserve_amount'],
                        ));
                    }
                }

                // Delete hotel by ids
                $deleteRowByIds = array_diff($existingHotelIds, $updatingHotelIds);
                
                if( !empty($deleteRowByIds) )
                {
                    TripIncludedActivityHotel::destroy($deleteRowByIds);
                }

                // Update Included Airline
                $existingAirlineIds = TripIncludedActivityAirline::where(['trip_id' => $id, 'activity_id' => $row['activity_id']])->pluck('id')->toArray();
                $updatingAirlineIds = array();

                foreach($row['activity_airlines'] as $row_airline)
                {
                    if( isset($row_airline['airline_id']) && is_numeric($row_airline['airline_id']) )
                    {
                        $updatingAirlineIds[] = $row_airline['airline_id'];

                        // Update
                        $includedActivityAirline = TripIncludedActivityAirline::findOrFail($row_airline['airline_id']);

                        $data = array(
                            'airline_name'              => $row_airline['airline_name'],
                            'airline_departure_date'    => $row_airline['airline_departure_date'],
                            'airline_departure_time'    => $row_airline['airline_departure_time'],
                            'airline_departure_location' => $row_airline['airline_departure_location'],
                            'airline_layovers'          => $row_airline['airline_layovers'],
                            'airline_baggage_allowance' => $row_airline['airline_baggage_allowance'],
                            'airline_our_cost'          => $row_airline['airline_our_cost'],
                            'airline_cost'              => $row_airline['airline_cost'],
                            'airline_due_date'          => $row_airline['airline_due_date'],
                            'airline_reserve_type'      => $row_airline['airline_reserve_type'],
                            'airline_reserve_amount'    => $row_airline['airline_reserve_amount'],
                        );

                        //echo '<pre>'; print_r($data); exit;

                        $includedActivityAirline->update($data);
                    }
                    else
                    {
                        // Create
                        TripIncludedActivityAirline::create(array(
                            'trip_id'                   => $id,
                            'activity_id'               => $row['activity_id'],
                            'airline_name'              => $row_airline['airline_name'],
                            'airline_departure_date'    => $row_airline['airline_departure_date'],
                            'airline_departure_time'    => $row_airline['airline_departure_time'],
                            'airline_departure_location' => $row_airline['airline_departure_location'],
                            'airline_layovers'          => $row_airline['airline_layovers'],
                            'airline_baggage_allowance' => $row_airline['airline_baggage_allowance'],
                            'airline_our_cost'          => $row_airline['airline_our_cost'],
                            'airline_cost'              => $row_airline['airline_cost'],
                            'airline_due_date'          => $row_airline['airline_due_date'],
                            'airline_reserve_type'      => $row_airline['airline_reserve_type'],
                            'airline_reserve_amount'    => $row_airline['airline_reserve_amount'],
                        ));
                    }
                }

                // Delete airline by ids
                $deleteRowByIds = array_diff($existingAirlineIds, $updatingAirlineIds);
                
                if( !empty($deleteRowByIds) )
                {
                    TripIncludedActivityAirline::destroy($deleteRowByIds);
                }
            }
            else
            {
                // Add Included Activity
                $fileName = '';
                if( $request->hasFile('included_activity.'.$index.'.activity_image') )
                {
                    $fileName = $this->imageUpload($request->file('included_activity.'.$index.'.activity_image'), 'trip', 'activity-img');
                }

                $activity_id = TripIncludedActivity::create(array(
                    'trip_id'               => $id,
                    'activity_name'         => $row['activity_name'],
                    'activity_detail'       => $row['activity_detail'],
                    'activity_cost'         => $row['activity_cost'],
                    'activity_our_cost'     => $row['activity_our_cost'],
                    'activity_due_date'     => $row['activity_due_date'],
                    'activity_reserve_type' => $row['activity_reserve_type'],
                    'activity_reserve_amount' => $row['activity_reserve_amount'],
                    'activity_image'        => $fileName
                ))->id;

                // Add Included Hotel
                foreach($row['activity_hotels'] as $row_hotel)
                {
                    TripIncludedActivityHotel::create(array(
                        'trip_id'               => $id,
                        'activity_id'           => $activity_id,
                        'hotel_name'            => $row_hotel['hotel_name'],
                        'hotel_type'            => $row_hotel['hotel_type'],
                        'hotel_cost'            => $row_hotel['hotel_cost'],
                        'hotel_solo_cost'       => $row_hotel['hotel_solo_cost'],
                        'hotel_our_cost'        => $row_hotel['hotel_our_cost'],
                        'hotel_our_solo_cost'   => $row_hotel['hotel_our_solo_cost'],
                        'hotel_due_date'        => $row_hotel['hotel_due_date'],
                        'hotel_reserve_type'    => $row_hotel['hotel_reserve_type'],
                        'hotel_reserve_amount'  => $row_hotel['hotel_reserve_amount'],
                    ));
                }

                // Add Included Airline
                foreach($row['activity_airlines'] as $row_airline)
                {
                    TripIncludedActivityAirline::create(array(
                        'trip_id'                   => $id,
                        'activity_id'               => $activity_id,
                        'airline_name'              => $row_airline['airline_name'],
                        'airline_departure_date'    => $row_airline['airline_departure_date'],
                        'airline_departure_time'    => $row_airline['airline_departure_time'],
                        'airline_departure_location' => $row_airline['airline_departure_location'],
                        'airline_layovers'          => $row_airline['airline_layovers'],
                        'airline_baggage_allowance' => $row_airline['airline_baggage_allowance'],
                        'airline_our_cost'          => $row_airline['airline_our_cost'],
                        'airline_cost'              => $row_airline['airline_cost'],
                        'airline_due_date'          => $row_airline['airline_due_date'],
                        'airline_reserve_type'      => $row_airline['airline_reserve_type'],
                        'airline_reserve_amount'    => $row_airline['airline_reserve_amount'],
                    ));
                }
            }
        }

        // Delete Activity, ActivityHotel, ActivityAirline by ids
        $deleteRowByIds = array_diff($existingActivityIds, $updatingActivityIds);
        
        if( !empty($deleteRowByIds) )
        {
            // Delete included activity
            foreach($deleteRowByIds as $id)
            {
                $tripIncludedActivity = TripIncludedActivity::find($id);

                // Delete included activity image
                if( !empty($tripIncludedActivity->activity_image) )
                {
                    $image_path = public_path('/uploads/trip/'.$tripIncludedActivity->activity_image);

                    if(File::exists($image_path))
                    {
                        File::delete($image_path);
                    }
                }

                $tripIncludedActivity->delete();
            }

            //TripIncludedActivity::destroy($deleteRowByIds);

            // Delete included activity hotel
            TripIncludedActivityHotel::whereIn('activity_id', $deleteRowByIds)->delete();

            // Delete included activity airline
            TripIncludedActivityAirline::whereIn('activity_id', $deleteRowByIds)->delete();
        }
    }

    /**
     * Update trip addon
     *
     * @param  int  $id
     * @param $request
     */
    function updateTripAddon($id, $request)
    {
        $existingAddonIds = TripAddon::where('trip_id', $id)->pluck('id')->toArray();
        $updatingAddonIds = array();

        // Get post addon
        $addon = $request->input('addon');
 
			
        foreach($addon as $index => $row)
        {
            if( isset($row['addon_id']) && is_numeric($row['addon_id']) )
            {
                $updatingAddonIds[] = $row['addon_id'];

                // Update Addon
                $tripAddon = TripAddon::findOrFail($row['addon_id']);

                $data = array(
                    'addons_name'         => $row['addons_name'],
                    'addons_detail'       => $row['addons_detail'],
                    'addons_cost'         => $row['addons_cost'],
                    'addons_our_cost'     => $row['addons_our_cost'],
                    'addons_due_date'     => $row['addons_due_date'],
                    'addons_reserve_type' => $row['addons_reserve_type'],
                    'addons_reserve_amount' => $row['addons_reserve_amount'],
					'addons_maximum_spots' =>$row['addons_maximum_spots'],
					'addons_minimum_spots'  =>$row['addons_minimum_spots'],
					'addons_maximum_wating_spots' =>$row['addons_maximum_wating_spots'],
                );
	//	echo '<pre>';print_r($data);die;
                if( $request->hasFile('addon.'.$index.'.addons_image') )
                {
                    $data['addons_image'] = $this->imageUpload($request->file('addon.'.$index.'.addons_image'), 'trip', 'addons-img');

                    // Delete addons image
                    if( !empty($tripAddon->addons_image) )
                    {
                        $image_path = public_path('/uploads/trip/'.$tripAddon->addons_image);

                        if(File::exists($image_path))
                        {
                            File::delete($image_path);
                        }
                    }
                }

                $tripAddon->update($data);

                // Update Addon Hotel
                $existingHotelIds = TripAddonHotel::where(['trip_id' => $id, 'addon_id' => $row['addon_id']])->pluck('id')->toArray();
                $updatingHotelIds = array();

                foreach($row['addons_hotels'] as $row_hotel)
                {
                    if( isset($row_hotel['hotel_id']) && is_numeric($row_hotel['hotel_id']) )
                    {
                        $updatingHotelIds[] = $row_hotel['hotel_id'];

                        // Update
                        $addonHotel = TripAddonHotel::findOrFail($row_hotel['hotel_id']);

                        $data = array(
                            'hotel_name'            => $row_hotel['hotel_name'],
                            'hotel_type'            => $row_hotel['hotel_type'],
                            'hotel_cost'            => $row_hotel['hotel_cost'],
                            'hotel_solo_cost'       => $row_hotel['hotel_solo_cost'],
                            'hotel_our_cost'        => $row_hotel['hotel_our_cost'],
                            'hotel_our_solo_cost'   => $row_hotel['hotel_our_solo_cost'],
                            'hotel_due_date'        => $row_hotel['hotel_due_date'],
                            'hotel_reserve_type'    => $row_hotel['hotel_reserve_type'],
                            'hotel_reserve_amount'  => $row_hotel['hotel_reserve_amount'],
                        );

                        $addonHotel->update($data);
                    }
                    else
                    {
                        // Create
                        TripAddonHotel::create(array(
                            'trip_id'               => $id,
                            'addon_id'              => $row['addon_id'],
                            'hotel_name'            => $row_hotel['hotel_name'],
                            'hotel_type'            => $row_hotel['hotel_type'],
                            'hotel_cost'            => $row_hotel['hotel_cost'],
                            'hotel_solo_cost'       => $row_hotel['hotel_solo_cost'],
                            'hotel_our_cost'        => $row_hotel['hotel_our_cost'],
                            'hotel_our_solo_cost'   => $row_hotel['hotel_our_solo_cost'],
                            'hotel_due_date'        => $row_hotel['hotel_due_date'],
                            'hotel_reserve_type'    => $row_hotel['hotel_reserve_type'],
                            'hotel_reserve_amount'  => $row_hotel['hotel_reserve_amount'],
                        ));
                    }
                }

                // Delete hotel by ids
                $deleteRowByIds = array_diff($existingHotelIds, $updatingHotelIds);
                
                if( !empty($deleteRowByIds) )
                {
                    TripAddonHotel::destroy($deleteRowByIds);
                }

                // Update Addon Airline
                $existingAirlineIds = TripAddonAirline::where(['trip_id' => $id, 'addon_id' => $row['addon_id']])->pluck('id')->toArray();
                $updatingAirlineIds = array();

                foreach($row['addons_airlines'] as $row_airline)
                {
                    if( isset($row_airline['airline_id']) && is_numeric($row_airline['airline_id']) )
                    {
                        $updatingAirlineIds[] = $row_airline['airline_id'];

                        // Update
                        $addonAirline = TripAddonAirline::findOrFail($row_airline['airline_id']);

                        $data = array(
                            'airline_name'              => $row_airline['airline_name'],
                            'airline_departure_date'    => $row_airline['airline_departure_date'],
                            'airline_departure_time'    => $row_airline['airline_departure_time'],
                            'airline_departure_location' => $row_airline['airline_departure_location'],
                            'airline_layovers'          => $row_airline['airline_layovers'],
                            'airline_baggage_allowance' => $row_airline['airline_baggage_allowance'],
                            'airline_our_cost'          => $row_airline['airline_our_cost'],
                            'airline_cost'              => $row_airline['airline_cost'],
                            'airline_due_date'          => $row_airline['airline_due_date'],
                            'airline_reserve_type'      => $row_airline['airline_reserve_type'],
                            'airline_reserve_amount'    => $row_airline['airline_reserve_amount'],
                        );

                        $addonAirline->update($data);
                    }
                    else
                    {
                        // Create
                        TripAddonAirline::create(array(
                            'trip_id'                   => $id,
                            'addon_id'                  => $row['addon_id'],
                            'airline_name'              => $row_airline['airline_name'],
                            'airline_departure_date'    => $row_airline['airline_departure_date'],
                            'airline_departure_time'    => $row_airline['airline_departure_time'],
                            'airline_departure_location' => $row_airline['airline_departure_location'],
                            'airline_layovers'          => $row_airline['airline_layovers'],
                            'airline_baggage_allowance' => $row_airline['airline_baggage_allowance'],
                            'airline_our_cost'          => $row_airline['airline_our_cost'],
                            'airline_cost'              => $row_airline['airline_cost'],
                            'airline_due_date'          => $row_airline['airline_due_date'],
                            'airline_reserve_type'      => $row_airline['airline_reserve_type'],
                            'airline_reserve_amount'    => $row_airline['airline_reserve_amount'],
                        ));
                    }
                }

                // Delete airline by ids
                $deleteRowByIds = array_diff($existingAirlineIds, $updatingAirlineIds);
                
                if( !empty($deleteRowByIds) )
                {
                    TripAddonAirline::destroy($deleteRowByIds);
                }
            }
            else
            {
                // Add Addon
                $fileName = '';
                if( $request->hasFile('addon.'.$index.'.addons_image') )
                {
                    $fileName = $this->imageUpload($request->file('addon.'.$index.'.addons_image'), 'trip', 'addons-img');
                }
					
                $addon_id = TripAddon::create(array(
                    'trip_id'               => $id,
                    'addons_name'           => $row['addons_name'],
                    'addons_detail'         => $row['addons_detail'],
                    'addons_cost'           => $row['addons_cost'],
                    'addons_our_cost'       => $row['addons_our_cost'],
                    'addons_due_date'       => $row['addons_due_date'],
                    'addons_reserve_type'   => $row['addons_reserve_type'],
                    'addons_reserve_amount' => $row['addons_reserve_amount'],
					'addons_maximum_spots' =>$row['addons_maximum_spots'],
					'addons_minimum_spots'  =>$row['addons_minimum_spots'],
					'addons_maximum_wating_spots' =>$row['addons_maximum_wating_spots'],
                    'addons_image'          => $fileName
                ))->id;

                // Add Addon Hotel
                foreach($row['addons_hotels'] as $row_hotel)
                {
                    TripAddonHotel::create(array(
                        'trip_id'               => $id,
                        'addon_id'              => $addon_id,
                        'hotel_name'            => $row_hotel['hotel_name'],
                        'hotel_type'            => $row_hotel['hotel_type'],
                        'hotel_cost'            => $row_hotel['hotel_cost'],
                        'hotel_solo_cost'       => $row_hotel['hotel_solo_cost'],
                        'hotel_our_cost'        => $row_hotel['hotel_our_cost'],
                        'hotel_our_solo_cost'   => $row_hotel['hotel_our_solo_cost'],
                        'hotel_due_date'        => $row_hotel['hotel_due_date'],
                        'hotel_reserve_type'    => $row_hotel['hotel_reserve_type'],
                        'hotel_reserve_amount'  => $row_hotel['hotel_reserve_amount'],
                    ));
                }

                // Add Addon Airline
                foreach($row['addons_airlines'] as $row_airline)
                {
                    TripAddonAirline::create(array(
                        'trip_id'                   => $id,
                        'addon_id'                  => $addon_id,
                        'airline_name'              => $row_airline['airline_name'],
                        'airline_departure_date'    => $row_airline['airline_departure_date'],
                        'airline_departure_time'    => $row_airline['airline_departure_time'],
                        'airline_departure_location' => $row_airline['airline_departure_location'],
                        'airline_layovers'          => $row_airline['airline_layovers'],
                        'airline_baggage_allowance' => $row_airline['airline_baggage_allowance'],
                        'airline_our_cost'          => $row_airline['airline_our_cost'],
                        'airline_cost'              => $row_airline['airline_cost'],
                        'airline_due_date'          => $row_airline['airline_due_date'],
                        'airline_reserve_type'      => $row_airline['airline_reserve_type'],
                        'airline_reserve_amount'    => $row_airline['airline_reserve_amount'],
                    ));
                }
            }
        }

        // Delete Addon, AddonHotel, AddonAirline by ids
        $deleteRowByIds = array_diff($existingAddonIds, $updatingAddonIds);
        
        if( !empty($deleteRowByIds) )
        {
            // Delete addon
            foreach($deleteRowByIds as $id)
            {
                $tripAddon = TripAddon::find($id);

                // Delete addon image
                if( !empty($tripAddon->addons_image) )
                {
                    $image_path = public_path('/uploads/trip/'.$tripAddon->addons_image);

                    if(File::exists($image_path))
                    {
                        File::delete($image_path);
                    }
                }

                $tripAddon->delete();
            }

            //TripAddon::destroy($deleteRowByIds);

            // Delete addon hotel
            TripAddonHotel::whereIn('addon_id', $deleteRowByIds)->delete();

            // Delete addon airline
            TripAddonAirline::whereIn('addon_id', $deleteRowByIds)->delete();
        }
    }

    /**
     * Remove the trip and its associated data
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteTrip(Request $request,$id)
    {
        // Check if trip exist
        $trip = Trip::find($id);

        if(!$trip)
        {
            $request->session()->flash('error', 'Trip not found!');

            return redirect('admin/listtrip');
        }

        // Delete the trip image and then trip
        if( !empty($trip->banner_image) )
        {
            $image_path = public_path('/uploads/trip/'.$trip->banner_image);

            if(File::exists($image_path))
            {
                File::delete($image_path);
            }
        }

        Trip::destroy($id);

        // Delete trip airline
        TripAirline::where('trip_id', $id)->delete();

        // Get trip included activity and delete
        $includedActivity = TripIncludedActivity::where('trip_id', $id)->get();
        if( $includedActivity->count() )
        {
            foreach($includedActivity as $row)
            {
                // Delete included activity image and row
                if( !empty($row->activity_image) )
                {
                    $image_path = public_path('/uploads/trip/'.$row->activity_image);

                    if(File::exists($image_path))
                    {
                        File::delete($image_path);
                    }
                }

                TripIncludedActivity::destroy($row->id);

                // Delete included activity hotel
                TripIncludedActivityHotel::where(['trip_id' => $id, 'activity_id' => $row->id])->delete();

                // Delete included activity airline
                TripIncludedActivityAirline::where(['trip_id' => $id, 'activity_id' => $row->id])->delete();
            }
        }

        // Get trip addons and delete
        $addons = TripAddon::where('trip_id', $id)->get();
        if( $addons->count() )
        {
            foreach($addons as $row)
            {
                // Delete addon image and row
                if( !empty($row->addons_image) )
                {
                    $image_path = public_path('/uploads/trip/'.$row->addons_image);

                    if(File::exists($image_path))
                    {
                        File::delete($image_path);
                    }
                }

                TripAddon::destroy($row->id);

                // Delete addon hotel
                TripAddonHotel::where(['trip_id' => $id])->delete();
				TripAddonAirline::where(['trip_id' => $id])->delete();

                // Delete addon airline
                TripIncludedActivityAirline::where(['trip_id' => $id])->delete();
            }
        }

        // Delete trip hotel
        TripHotel::where('trip_id', $id)->delete();

        // Delete trip todo list
        TripTodo::where('trip_id', $id)->delete();

        $request->session()->flash('success', 'Trip delete successfully!');

        return redirect('admin/listtrip');
    }


    /**
     * Upload file and return the name of the uploaded file
     *
     * @param object $file
     * @param object $directory
     * @param object $startWith
     * @return string $fileName
     */
    protected function imageUpload($file, $directory=null, $startWith)
    { 
        // SET UPLOAD PATH
        if($directory != NULL && $directory != '')
        {
            $destinationPath = base_path() . '/public/uploads/'.$directory.'/';
        }
        else
        {
            $destinationPath = base_path() . '/public/uploads/';
        }

        // GET THE FILE EXTENSION
        $extension = $file->getClientOriginalExtension();

        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $fileName =  $startWith.md5(time()) . '.' . $extension;

        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $file->move($destinationPath, $fileName);

        return $fileName;
    }

   
   /**
     * Function to return trip list view
     * @param void
     * @return url
     */
    public function listTrip() {
        //for Trips 
        $trips = Trip::where('status', '1')
               ->orderBy('id', 'desc')
               ->get();
        $userId = Auth::id();
        //For Basic Info    
        $userData = User::where('id', '=', $userId)->first();
        return view('admin/triplist', ['trips' => $trips, 'data' => $userData]);
    }
    
    
    /**
     * Function to return trip view
     * @param int id
     * @return url
     */
    public function tripView($id) {
        $tripData = Trip::where('id', '=', $id)->first();
        return view('admin/viewtrip', ['tripdata' => $tripData]);
    }
    
    /**
     * Function to return trip spot view
     * @param void
     * @return url
     */
    public function tripSpot() {
        $trips = Trip::select('trips.name', 'trips.maximum_spots', DB::raw('count(trip_traveler.user_id) as booked'))
            ->leftJoin('trip_traveler', 'trip_traveler.trip_id', '=', 'trips.id')
            ->where('trips.status', '=', '1')
            ->groupBy('trips.id')
            ->get();
        
        return view('admin/tripspots', ['trips' => $trips]);
    }

    /**
     * Function to get trip addons and travellers belongs to that addon
     * @param void
     * @return url
     */
    function tripAddonTravelers()
    {
        $tripPluck = Trip::where(['status' => '1'])->pluck('name', 'id')->toArray();
        return view('admin/tripAddonTravelers', ['tripPluck' => $tripPluck]);
    }

    /**
     * Ajax function to get trip addons
     * @param int  $trip_id
     * @return Response
     */
    function getTripAddons($trip_id = null)
    {
        $tripAddon = array();

        if( !is_null($trip_id) )
        {
            $tripAddon = TripAddon::where(['trip_id' => $trip_id])
                ->get(['id', 'addons_name'])->toArray();
        }

        return response()->json(['tripAddon' => $tripAddon]);
    }
	
	   /**
     * Ajax function to get trip addonstraveler
     * @param int  $trip_id
     * @return Response
     */
	function getTripTraveler($trip_id,$add_on_id)
	{

		$tripAddontraveler = array();
		if( !is_null($trip_id) )
        {
			
            $tripAddontraveler = DB::select('SELECT * FROM `trip_traveler`as triptr join trip_addon_traveler as addon on triptr.`id`= addon.traveler_id where addon.addon_id='.$add_on_id.' and triptr.`created_at` >= CURDATE()');
			
        }
		return response()->json(['tripAddontraveler' => $tripAddontraveler]);
		
	}
	
    /**
     * Function to return upload video view
     * @param void
     * @return url
     */
    public function uploadVideo() {

        return view('admin/uploadvideo');
    }

//    public function deleteVideo(Request $request) {
//        Trip::destroy($id);
//        return back();
//    }
//	
	
    /* Function to update traveler information
     * @param int Request
     * @return url
     */
	
	public function adminTravelerProfile($id,Request $request)
	{
		if(isset($_POST['submit']))
		{
			$data['first_name']=!empty($request->input('first_name'))?$request->input('first_name'):'';
			$data['last_name']=!empty($request->input('last_name'))?$request->input('last_name'):'';
			$data['gender']=!empty($request->input('gender'))?$request->input('gender'):'';
			$data['dob']=!empty($request->input('dob'))?$request->input('dob'):'';
			$data['email']=!empty($request->input('email'))?$request->input('email'):'';
			$data['is_passport']=!empty($request->input('is_passport'))?$request->input('is_passport'):'';
			$data['passport_exp_date']=!empty($request->input('passport_exp_date'))?$request->input('passport_exp_date'):'';
			$passportPic = $request->file('passport_pic');
			
			//echo $passportPic;die;
			 if (isset($passportPic) && count($passportPic) > 0) {
                  $destinationPath = public_path() . '/passport_img/';					
				 if ($passportPic->isValid()) { 
                        $fileExt = $passportPic->getClientOriginalExtension();
                        $fileType = $passportPic->getMimeType();
                        $fileSize = $passportPic->getSize();
                        if (( $fileType == 'image/jpeg' || $fileType == 'image/png' ) && $fileSize <= 3000000) {     // 3 MB = 3000000 Bytes
                            // Rename the file
                            $fileNewName = str_random(10) . '.' . $fileExt;
                            if ($passportPic->move($destinationPath, $fileNewName)) {
                                $data['passport_pic']=$fileNewName;                               
                            } else {
                                $response['errCode'] = 2;
                                $response['errMsg'] = 'Some issue in uploading the file';
                            }
                        } else {
                            $response['errCode'] = 3;
                            $response['errMsg'] = 'Only image file with size less than 3MB is allowed';
                        }
                    }
                }else{
					$data['passport_pic']=$request->input('oldimage');
				}
			TripTraveler::where(['id' => $id])->update($data);
			return redirect('admin/view-traveler/'.$id);					
		}
		
		//personal infomation//
			if(isset($_POST['personalinfor']))
			{
				$personaldata['food_allergies']=!empty($request->input('food_allergies'))?$request->input('food_allergies'):'';
				$personaldata['shirt_size']=!empty($request->input('shirt_size'))?$request->input('shirt_size'):'';
				$personaldata['is_helth_mental']=!empty($request->input('shirt_size'))?$request->input('is_helth_mental'):'';
				$personaldata['helth_mental_conditions']=!empty($request->input('helth_mental_conditions'))?$request->input('helth_mental_conditions'):'';
				$personaldata['is_mental_conditions']=!empty($request->input('is_mental_conditions'))?$request->input('is_mental_conditions'):'';
				$personaldata['mental_conditions']=!empty($request->input('mental_conditions'))?$request->input('mental_conditions'):'';
				$personaldata['emergency_contact_name']=!empty($request->input('emergency_contact_name'))?$request->input('emergency_contact_name'):'';
				$personaldata['emergency_contact_phone']=!empty($request->input('emergency_contact_phone'))?$request->input('emergency_contact_phone'):'';
				$personaldata['personality_previous_travel']=!empty($request->input('personality_previous_travel'))?$request->input('personality_previous_travel'):'';
				$personaldata['personality_originally_from']=!empty($request->input('personality_originally_from'))?$request->input('personality_originally_from'):'';
				$personaldata['personality_school']=!empty($request->input('personality_school'))?$request->input('personality_school'):'';
				$personaldata['personality_about']=!empty($request->input('personality_about'))?$request->input('personality_about'):'';
				$profiletPic = !empty($request->file('profile_pic'))?$request->file('profile_pic'):'';
				
			$checkdataexist= DB::table('trip_traveler_profile')->where('traveler_id', $id)->first();
					 $destinationPath = public_path() . '/profile_img/';					
					 if (!empty($profiletPic) && $profiletPic->isValid()) { 
							$fileExt = $profiletPic->getClientOriginalExtension();
							$fileType = $profiletPic->getMimeType();
							$fileSize = $profiletPic->getSize();
							if (( $fileType == 'image/jpeg' || $fileType == 'image/png' ) && $fileSize <= 3000000) {     // 3 MB = 3000000 Bytes
								// Rename the file
								$fileNewName = str_random(10) . '.' . $fileExt;
								
								if ($profiletPic->move($destinationPath, $fileNewName)) {
									
									$personaldata['profile_pic']=$fileNewName;									
								} else {
									$response['errCode'] = 2;
									$response['errMsg'] = 'Some issue in uploading the file';
								}
							} else {
								$response['errCode'] = 3;
								$response['errMsg'] = 'Only image file with size less than 3MB is allowed';
							}
						}else{
							$personaldata['profile_pic']=$request->input('oldimage');
						}									
				if (count($checkdataexist)>0) {
					//echo 'sdfdf';die;
					DB::table('trip_traveler_profile')->where('traveler_id', $id)
								->update($personaldata);
				} else {
					$personaldata['traveler_id']=$id;
					DB::table('trip_traveler_profile')->insert($personaldata);
				}	
							
				return redirect('admin/view-traveler/'.$id);					
				
			}		
		//end here//			
		$travelerprofile=DB::table('trip_traveler')->where('id', $id)->first(); 
		$data['traveler_profiledata'] = DB::table('trip_traveler_profile')->where('traveler_id', $id)->first();		
		return view('admin/traveler_profile',['travelerprofile' => $travelerprofile,'data'=>$data]);
		
	}
	
	/* Function to display monthlyTripProjection information
        * @return url
        */
	
	
	public function monthlyTripProjection()
	{
		
		$monthlytrip= DB::select('SELECT * FROM `user_trip` as utip join trips as tr on utip.`trip_id`=tr.id where utip.status="1" GROUP by utip.trip_id');
		//echo '<pre>';print_r($monthlytrip);die;
		return view('admin/monthlytripprojection',['monthlytrip'=>$monthlytrip]);
	}
	
    /* Function to set monthlypaymentdate
     * @return url
     */
	public function setMonthlyPaymentDate($date,$trip_id)
	{
		$data['monthly_payment_date']=$date;
		DB::table('user_trip')->where('trip_id', $trip_id)
								->update($data);
		$travelerbytrip= DB::select('select * from trip_traveler where trip_id='.$trip_id.'');
		
		$monthlytrip= DB::select('SELECT * FROM `user_trip` as utip join trips as tr on utip.`trip_id`=tr.id where utip.status="1" and tr.id='.$trip_id.' GROUP by utip.trip_id');
		

		if(count($travelerbytrip)>0){
			foreach($travelerbytrip as $travelerprofile){
			//echo '<pre>';print_r($travelerprofile->email);die;				
				Mail::send('admin.emails.payment_date', ['monthlytrip' => $monthlytrip], function($message) use($travelerprofile){
					$message->to($travelerprofile->email, $travelerprofile->first_name)->subject('Welcome!');
				});
			}
		}								
		echo 'data update';die;							
		
	}
      
	  
	 /* Function to set registerUser
     * @return url
     */
	  public function registerUser()
	  {
		  //echo 'sfd';die;
		 $user = DB::table('users')
					->where('status', '=', '1')					
					->get(); 
				
		 return view('admin/register_user',['userdetail'=>$user]);
	  }
	  
	  public function userDetail($userId)
	  {
		  $tripalldetail=array();
		 
		   $userTrips['trip_detail'] =   DB::table('checkout')
												->join('trips', 'checkout.trip_id', '=', 'trips.id')
												->select('trips.*', 'checkout.*')
												->where('checkout.user_id', '=', $userId)
												->where('trips.status', '=', '1')																							
												->get();
											
			foreach($userTrips['trip_detail'] as $key=>$vlue)
			{
				
				$userTrips['selected_add_on'][$key]= DB::table('trip_addon_booking')
														->leftjoin('trip_addon','trip_addon_booking.add_on_id','=','trip_addon.id')	
														->where('trip_addon_booking.trip_id', '=', $vlue->trip_id)
														->where('trip_addon_booking.user_id', '=', $userId)
														->get();
											
				$userTrips['paidamount'][$key]=DB::table('trip_reserve_payment')
													->select(DB::raw("SUM(reserve_paid_amount) as total_paid"))
													->where('trip_id', '=', $vlue->trip_id)
													->where('user_id', '=', $userId)
													
													->get();	

				// $userTrips['emidata'][$key]= DB::table('user_emi')
												// ->where('trip_id',$vlue->trip_id)
												// ->where('user_id',$userId)
												// ->get();										
			}

	for ($i = 0; $i < count($userTrips['trip_detail']); $i++) {
			
              $tripalldetail[$i]['trip_detail'] = $userTrips['trip_detail'][$i];
					

					foreach ($userTrips['selected_add_on'][$i] as $activityhotelkey2 => $activityhotelvalue2) {

						$tripalldetail[$i]['selected_add_on'][$activityhotelkey2] = $activityhotelvalue2;
					}
					 foreach ($userTrips['paidamount'][$i] as $activityhotelkey3 => $activityhotelvalue3) {
								
								
							$tripalldetail[$i]['paidamount'][$activityhotelkey3] = $activityhotelvalue3;
						}
					// foreach ($userTrips['emidata'][$i] as $activityhotelkey4 => $activityhotelvalue4) {

							// $tripalldetail[$i]['emidata'][$activityhotelkey4] = $activityhotelvalue4;
						// }
                
            }

				
			//echo '<pre>';print_r($tripalldetail);die;	
			return view('admin/user_detail',['tripalldetail'=>$tripalldetail]);
				
	  }
	  
	  /* Function to set viewprofile
     * @return url
     */
	  public function viewProfile(Request $request)
	  {
		  $userId = Auth::id();
        //For Basic Info
		
		 if (isset($_POST['submit'])) {
            $data['first_name'] = !empty($request->input('first_name')) ? $request->input('first_name') : '';
            $data['last_name'] = !empty($request->input('last_name')) ? $request->input('last_name') : '';
            $data['gender'] = !empty($request->input('gender')) ? $request->input('gender') : '';
            $data['dob'] = !empty($request->input('dob')) ? $request->input('dob') : '';
            $data['email'] = !empty($request->input('email')) ? $request->input('email') : '';
            $data['is_passport'] = !empty($request->input('is_passport')) ? $request->input('is_passport') : '';
            $data['passport_exp_date'] = !empty($request->input('passport_exp_date')) ? $request->input('passport_exp_date') : '';
            $passportPic = $request->file('passport_pic');

            //echo $passportPic;die;
            if (isset($passportPic) && count($passportPic) > 0) {
                $destinationPath = public_path() . '/passport_img/';
                if ($passportPic->isValid()) {
                    $fileExt = $passportPic->getClientOriginalExtension();
                    $fileType = $passportPic->getMimeType();
                    $fileSize = $passportPic->getSize();
                    if (( $fileType == 'image/jpeg' || $fileType == 'image/png' ) && $fileSize <= 3000000) {     // 3 MB = 3000000 Bytes
                        // Rename the file
                        $fileNewName = str_random(10) . '.' . $fileExt;
                        if ($passportPic->move($destinationPath, $fileNewName)) {
                            $data['passport_pic'] = $fileNewName;
                        } else {
                            $response['errCode'] = 2;
                            $response['errMsg'] = 'Some issue in uploading the file';
                        }
                    } else {
                        $response['errCode'] = 3;
                        $response['errMsg'] = 'Only image file with size less than 3MB is allowed';
                    }
                }
            } else {
                $data['passport_pic'] = $request->input('oldimage');
            }
            User::where(['id' => $userId])->update($data);
            return redirect('admin/view_profile');
        }

        //personal infomation//
        if (isset($_POST['personalinfor'])) {
            $personaldata['food_allergies'] = !empty($request->input('food_allergies')) ? $request->input('food_allergies') : '';
            $personaldata['shirt_size'] = !empty($request->input('shirt_size')) ? $request->input('shirt_size') : '';
            $personaldata['is_helth_mental'] = !empty($request->input('shirt_size')) ? $request->input('is_helth_mental') : '';
            $personaldata['helth_mental_conditions'] = !empty($request->input('helth_mental_conditions')) ? $request->input('helth_mental_conditions') : '';
            $personaldata['is_mental_conditions'] = !empty($request->input('is_mental_conditions')) ? $request->input('is_mental_conditions') : '';
            $personaldata['mental_conditions'] = !empty($request->input('mental_conditions')) ? $request->input('mental_conditions') : '';
            $personaldata['emergency_contact_name'] = !empty($request->input('emergency_contact_name')) ? $request->input('emergency_contact_name') : '';
            $personaldata['emergency_contact_phone'] = !empty($request->input('emergency_contact_phone')) ? $request->input('emergency_contact_phone') : '';
            $personaldata['personality_previous_travel'] = !empty($request->input('personality_previous_travel')) ? $request->input('personality_previous_travel') : '';
            $personaldata['personality_originally_from'] = !empty($request->input('personality_originally_from')) ? $request->input('personality_originally_from') : '';
            $personaldata['personality_school'] = !empty($request->input('personality_school')) ? $request->input('personality_school') : '';
            $personaldata['personality_about'] = !empty($request->input('personality_about')) ? $request->input('personality_about') : '';
            $profiletPic = !empty($request->file('profile_pic')) ? $request->file('profile_pic') : '';

            // $checkdataexist = DB::table('trip_traveler_profile')->where('traveler_id', $id)->first();
            // $destinationPath = public_path() . '/uploads/profile_images/';

            $checkdataexist = DB::table('user_profile')->where('user_id', $userId)->first();
            $destinationPath = public_path() . '/profile_img/';

            if (!empty($profiletPic) && $profiletPic->isValid()) {
                $fileExt = $profiletPic->getClientOriginalExtension();
                $fileType = $profiletPic->getMimeType();
                $fileSize = $profiletPic->getSize();
                if (( $fileType == 'image/jpeg' || $fileType == 'image/png' ) && $fileSize <= 3000000) {     // 3 MB = 3000000 Bytes
                    // Rename the file
                    $fileNewName = str_random(10) . '.' . $fileExt;

                    if ($profiletPic->move($destinationPath, $fileNewName)) {

                        $personaldata['profile_pic'] = $fileNewName;
                    } else {
                        $response['errCode'] = 2;
                        $response['errMsg'] = 'Some issue in uploading the file';
                    }
                } else {
                    $response['errCode'] = 3;
                    $response['errMsg'] = 'Only image file with size less than 3MB is allowed';
                }
            } else {
                $personaldata['profile_pic'] = $request->input('oldimage');
            }
            if (count($checkdataexist) > 0) {
                //echo 'sdfdf';die;
                DB::table('user_profile')->where('user_id', $userId)
								->update($personaldata);
            } else {
                $personaldata['user_id'] = $userId;
                DB::table('user_profile')->insert($personaldata);
            }
            return redirect('admin/view_profile/');
        }
		
		
        $userData = User::where('id', '=', $userId)->first();
        //For Country Info
        $countries = Country::all();
        $user_country = User::where('id', '=', $userId)->first();
        //For Profile Info
        $profileData = DB::table('user_profile')->where('user_id', $userId)->first();		
	    return view('admin/view_profile', ['data' => $userData, 'profile' => $profileData, 'countries' => $countries, 'user_country' => $user_country]);
		  
	  }
	  
	 /* Function to set downloadCsv
     * @return url
     */
	 
	  public function downloadCsv()
	  {
		  $headers = array(
				"Content-type" => "text/csv",
				"Content-Disposition" => "attachment; filename=file.csv",
				"Pragma" => "no-cache",
				"Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
				"Expires" => "0"
			);
			
			// fetch data here//
			
		$tripalldetail=array();
		$addonName=array();
		 $userTrips['trip_detail'] =   DB::table('checkout')
												->join('trips', 'checkout.trip_id', '=', 'trips.id')
												->select('trips.*', 'checkout.*')
												->where('trips.status', '=', '1')		
												->get();
												
			foreach($userTrips['trip_detail'] as $key=>$value)
				{
						$userTrips['user_detail'][$key]=DB::table('users')
															->where('id',$value->user_id)
															->get();
						
						$userTrips['selected_add_on'][$key]= DB::table('trip_addon_booking')
																->leftjoin('trip_addon','trip_addon_booking.add_on_id','=','trip_addon.id')	
																->where('trip_addon_booking.trip_id', '=', $value->trip_id)
																->where('trip_addon_booking.user_id', '=', $value->user_id)
																->get();
													
						$userTrips['paidamount'][$key]=DB::table('trip_reserve_payment')
															->select(DB::raw("SUM(reserve_paid_amount) as total_paid"))
															->where('trip_id', '=', $value->trip_id)
															->where('user_id', '=', $value->user_id)													
															->get();									
				}

			for ($i = 0; $i < count($userTrips['trip_detail']); $i++) {
			
				$tripalldetail[$i]['trip_detail'] = $userTrips['trip_detail'][$i];
					

					foreach ($userTrips['selected_add_on'][$i] as $activityhotelkey2 => $activityhotelvalue2) {

						$tripalldetail[$i]['selected_add_on'][$activityhotelkey2] = $activityhotelvalue2;
					}
					 foreach ($userTrips['paidamount'][$i] as $activityhotelkey3 => $activityhotelvalue3) {
								
								
							$tripalldetail[$i]['paidamount'][$activityhotelkey3] = $activityhotelvalue3;
						}
					foreach ($userTrips['user_detail'][$i] as $activityhotelkey4 => $activityhotelvalue4) {

							$tripalldetail[$i]['user_detail'][$activityhotelkey4] = $activityhotelvalue4;
						}
                
            }		
			
		// end here //
			
			//echo '<pre>';print_r($tripalldetail);die;			

		
			$columns = array("User Name", "User Email", "Trip Name", "Paid Amount", "Remaning Amount");

			$callback = function() use ($tripalldetail, $columns)
			{
				$file = fopen("php://output", "w");
				fputcsv($file, $columns);

				foreach($tripalldetail as $tripvalue) {
					$userNmae = !empty($tripvalue['user_detail'])?$tripvalue['user_detail'][0]->name:'';
					$userEmail = !empty($tripvalue['user_detail'])?$tripvalue['user_detail'][0]->email:'';
					$tripName=  !empty($tripvalue['trip_detail'])?$tripvalue['trip_detail']->name:'';
					$paidAmount=  !empty($tripvalue['paidamount'][0])?$tripvalue['paidamount'][0]->total_paid:'';
					$totalTripCost = !empty($tripvalue['trip_detail'])?$tripvalue['trip_detail']->trip_total_cost:'';
					$reamingAmount= $totalTripCost - $paidAmount;				
					
					 // if(!empty($tripvalue['selected_add_on']))
					// {
						
						// echo print_r($tripvalue['selected_add_on']);die;
						 // foreach($tripvalue['selected_add_on'] as $key=> $addvalue)
						// {
							 // array_push($addonName,$addvalue->addons_name);
						// }
						
					 // }				
					
					
					fputcsv($file, array($userNmae, $userEmail, $tripName, $paidAmount, $reamingAmount));
				}
				//print_r($addonName);die;
				fclose($file);
			};
			return Response::stream($callback, 200, $headers);
				  
	}
	
	
	
}
