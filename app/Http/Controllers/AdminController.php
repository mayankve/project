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

use Validator;

class AdminController extends Controller {

    /**
     * Function to load User dashboard
     * @param void
     * @return array
     */
    public function userDashboard() {
        $userId = Auth::id();
        //For Basic Info
        $userData = User::where('id', '=', $userId)->first();
        //For Country Info
        $countries = Country::all();
        $user_country = User::where('id', '=', $userId)->first();
        //For Profile Info
        $profileData = $user = DB::table('user_profile')->where('user_id', '$userId')->first();

        return view('admin/dashboard', ['data' => $userData, 'profile' => $profileData, 'countries' => $countries, 'user_country' => $user_country]);
    }

    /**
     * Function to update user basic information
     * @param void
     * @return url
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
            } else {         // Passport is not available
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

        return view('admin/createTrip', compact('airlines', 'airlinesPluck'));
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
            'base_cost'     => 'required',
            'maximum_spots'     => 'required',
            'adjustment_date'   => 'required',
            'land_only_date'    => 'required'
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
        }

        // To-do validation
        foreach($request->get('to_do') as $key => $val)
        {
            $rules["to_do.{$key}.todo_name"] = 'required';
        }

        //echo '<pre>'; print_r($rules); exit;

        $this->validate($request, $rules);
        /*$validator  = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/createtrip')
                        ->withErrors($validator)
                        ->withInput();
        }*/

        // Create trip
        $trip = $request->only(['name', 'date', 'end_date', 'about_trip', 'banner_video', 'base_cost', 'maximum_spots', 'adjustment_date', 'land_only_date', 'requirement_is_passport', 'requirement_passport_min_expiry', 'requirement_is_visa', 'requirement_visa_cost', 'requirement_visa_process', 'requirement_is_shots', 'requirement_shots_cost', 'requirement_shots_timeframe']);

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
                    'addons_image'        => $fileName
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
        }

        return redirect('admin/listtrip');
    }

    public function deleteTrip($id)
    {
        // Check if trip exist
        $trip = Trip::find($id);

        if(!$trip)
        {
            return redirect('admin/listtrip');
        }

        // Delete the trip image and trip
        if( !empty($trip->banner_image) )
        {
            $banner_image = public_path('/uploads/trip/'.$trip->banner_image);

            echo $banner_image;

            if(File::exists($banner_image))
            {
                //File::delete($banner_image)
            }
        }

        Trip::destroy($id);

        //
        
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
        $trips = Trip::all();
        return view('admin/triplist', ['trips' => $trips]);
    }

    /**
     * Function to return trip spot view
     * @param void
     * @return url
     */
    public function tripSpot() {
        $trips = Trip::all();
        
        return view('admin/tripspots', ['trips' => $trips]);
    }

    /**
     * Function to return upload video view
     * @param void
     * @return url
     */
    public function uploadVideo() {
        return view('admin/uploadvideo');
    }

    public function deleteVideo(Request $request) {
        Trip::destroy($id);
        return back();
        //DB::delete('delete from trips where id = ?', [$id]);
       //return view('admin/triplist');
    }

}
