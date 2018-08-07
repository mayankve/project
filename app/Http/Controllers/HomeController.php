<?php
namespace App\Http\Controllers;
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
use Illuminate\Http\Request;
use File;
use App\User;
use App\Trip;
use Validator;
use App\UserProfile;
use App\Country;
use App\TripTraveler;
use App\UserTrip;
use App\TripTravelerProfile;
class HomeController extends Controller {
    
    /**
     * Function to return home view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        // Get all the trips which are active and whose end date is not null and trip is not deleted
        $trips = Trip::where('end_date', '!=', NULL)->where('status', '=', '1')->paginate(6);

        return view('welcome', ['trips' => $trips]);
    }

    /**
     * Function to return User Dashboard Data
     * @param void
     * @return \Illuminate\Http\Response
     */
    
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

    /**
     * Function to return about us view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function about() {
        return view('about');
    }

    /**
     * Function to return contact us view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function contact() {
        return view('contact');
    }

    /**
     * Function to return front-end login view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function clientLogin() {
        return view('client_login');
    }

    /**
     * Function for User login
     * @param void
     * @return array
     */
    public function userLogin() {
        // Get the serialized form data
        $frmData = Input::get('frmData');
        // Parse the serialize form data to an array
        parse_str($frmData, $loginData);

        $remember = false;
        if (isset($loginData['remember'])) {
            $remember = true;
        }

        // Server Side Validation
        $response = array();

        $validation = Validator::make(
                        array(
                    'email' => $loginData['email'],
                    'password' => $loginData['password']
                        ), array(
                    'email' => array('required', 'email'),
                    'password' => array('required', 'min:6'),
                        ), array(
                    'email.required' => 'Please enter email',
                    'email.email' => 'Please enter valid email',
                    'password.required' => 'Please enter password',
                    'password.min' => 'Password must contain atleast 6 characters',
                        )
        );

        if ($validation->fails()) {  // Some data is not valid as per the defined rules
            $error = $validation->errors()->first();

            if (isset($error) && !empty($error)) {
                $response['errCode'] = 1;
                $response['errMsg'] = $error;
            }
        } else {
            if (Auth::attempt(['email' => $loginData['email'], 'password' => $loginData['password'], 'status' => '1'], $remember)) {
                // status: 1, means user is active
                // Check the role of the logged-in user and redirect the user accordingly
                $userId = Auth::id();
                $user = User::find($userId);
                // Rolewise redirection url
                $redirectionUrl = url('/dashboard');
                if ($user->hasRole(['admin'])) {
                    $redirectionUrl = url('admin/dashboard');
                }

                $response['errCode'] = 0;
                $response['errMsg'] = 'Successful login';
                $response['redirectionUrl'] = $redirectionUrl;
            } else {
                $response['errCode'] = 2;
                $response['errMsg'] = 'Invalid user credentials';
            }
        }
        return response()->json($response);
    }

    /**
     * Function to logout
     * @param void
     * @return url
     */
    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Function to load view of change password
     * @param void
     * @return url
     */
    public function changePassword() {
        return view('change_password');
    }

    /* Function to load view of change password
     * @param void
     * @return url
     */

    public function changeUserPassword() {
        // Get the serialized form data
        $frmData = Input::get('frmData');
        // Parse the serialize form data to an array
        parse_str($frmData, $passswordData);

        // Server Side Validation
        $response = array();

        $validation = Validator::make(
                        array(
                    'current_password' => $passswordData['current_password'],
                    'new_password' => $passswordData['new_password'],
                    'repeat_new_password' => $passswordData['repeat_new_password']
                        ), array(
                    'current_password' => array('required'),
                    'new_password' => array('required', 'min:6'),
                    'repeat_new_password' => array('required', 'min:6')
                        ), array(
                    'current_password.required' => 'Please enter current password',
                    'new_password.required' => 'Please enter new password',
                    'repeat_new_password.required' => 'Please enter repeat new password',
                    'new_password.min' => 'Password must contain atleast 6 characters',
                        )
        );
        if ($validation->fails()) {  // Some data is not valid as per the defined rules
            $error = $validation->errors()->first();

            if (isset($error) && !empty($error)) {
                $response['errCode'] = 1;
                $response['errMsg'] = $error;
            }
        } else {
            if (Hash::check($passswordData['current_password'], Auth::user()->password)) {
                if (strcmp($passswordData['current_password'], $passswordData['new_password']) == 0) {
                    //If new password is same as before
                    $response['errCode'] = 1;
                    $response['errMsg'] = 'New Password cannot be same as your current password. Please choose a different password.';
                } elseif (strcmp($passswordData['new_password'], $passswordData['repeat_new_password'])) {
                    //If new password and confirm password is not same
                    $response['errCode'] = 1;
                    $response['errMsg'] = 'Confirm password doesn\'t match with new password.';
                } else {
                    //Change Password
                    $user = Auth::user();
                    $user->password = Hash::make($passswordData['new_password']);
                    if ($user->save()) {
                        $response['errCode'] = 0;
                        $response['errMsg'] = 'Password updated successfully';

                        $user = User::find(Auth::id());
                        $response['redirectionUrl'] = url('/dashboard');
                        if ($user->hasRole(['admin'])) {
                            $response['redirectionUrl'] = url('admin/dashboard');
                        }
                    } else {
                        $response['errCode'] = 1;
                        $response['errMsg'] = 'Password could not be updated';
                    }
                }
            } else {
                //If password is not matched
                $response['errCode'] = 1;
                $response['errMsg'] = 'Your current password does not matches with the password you provided. Please try again.';
            }
        }

        return response()->json($response);
    }

    /**
     * Function to load User dashboard
     * @param void
     * @return array
     */

    public function userDashboard() {
        $data = $this->dashboardElements();
        //echo "<pre>"; print_r($data);die;
        return view('dashboard', ['data' => $data]);
       // return view('dashboard', ['data' => $userData, 'profile' => $profileData, 'countries' => $countries, 'user_country' => $user_country, 'trips' => $trips]);
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
                    $destinationPath = storage_path() . '/passport_img/';

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

        $profile_pic = $request->file('profile_pic') ? $request->file('profile_pic') : '';
        $is_helth_mental = $request->input('is_helth_mental') ? $request->input('is_helth_mental') : 0;
        $helth_mental_conditions = $request->input('helth_mental_conditions') ? $request->input('helth_mental_conditions') : '';
        $is_mental_conditions = $request->input('is_mental_conditions') ? $request->input('is_mental_conditions') : 0;
        $mental_conditions = $request->input('mental_conditions') ? $request->input('mental_conditions') : '';
        $food_allergies = $request->input('food_allergies') ? $request->input('food_allergies') : '';
        $shirt_size = $request->input('shirt_size') ? $request->input('shirt_size') : '';
        $emergency_contact_name = $request->input('emergency_contact_name') ? $request->input('emergency_contact_name') : '';
        $emergency_contact_phone = $request->input('emergency_contact_phone') ? $request->input('emergency_contact_phone') : '';
        $personality_previous_travel = $request->input('personality_previous_travel') ? $request->input('personality_previous_travel') : '';
        $personality_originally_from = $request->input('personality_originally_from') ? $request->input('personality_originally_from') : '';
        $personality_school = $request->input('personality_school') ? $request->input('personality_school') : '';
        $personality_about = $request->input('personality_about') ? $request->input('personality_about') : '';
        // Server Side Validation

        $response = array();
        $destinationPath = storage_path() . '/profile_img/';						
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
     * Function to return trip list view
     * @param void
     * @return url
     */
    public function listTrip() {
        //for Trips
        $trips = Trip::all();
        $userId = Auth::id();
        if(isset($userId)){
             $userData = User::where('id', '=', $userId)->first();
             return view('triplist', ['trips' => $trips, 'data' => $userData]);
        }
        else{
             return view('triplist', ['trips' => $trips]);
        }
    }

    /**
     * Function to return trip view
     * @param int id
     * @return url
     */
    public function tripView($id) {
        $tripData = Trip::where('id', '=', $id)->first();
        return view('viewtrip', ['tripdata' => $tripData]);
    }

    /**
     * Function to return book trip view
     * @param int id
     * @return url
     */
    public function bookTripView($id) {
        $tripData = Trip::where('id', '=', $id)->first();
        return view('booktrip', ['tripdata' => $tripData]);
    }

    /* Function to save trip booking
     * @param int Request
     * @return url
     */

public function bookTrip(Request $request) {
        $trip_traveler = new TripTraveler();
        $user_trip = new UserTrip();
        // Traveler validation
        foreach ($request->get('traveler') as $key => $val) {
            $rules["traveler.{$key}.first_name"] = 'required';
            $rules["traveler.{$key}.email"] = 'required|email';
//            $rules["traveler.{$key}.profile_image"] = 'required';
//            $rules["traveler.{$key}.city"] = 'required';
        }
        $this->validate($request, $rules);
        $trip_id = $request->get('trip_id');
        $user_id = Auth::id();
        $traveler_details = $request->get('traveler');
        $flag = 0;
        if (count($traveler_details) > 0) {
            foreach ($traveler_details as $index => $row) {
//                $fileName = '';
//                if ($request->hasFile('traveler.'.$index.'.profile_image')) {
//                    $fileName = $this->imageUpload($request->file('traveler.'.$index.'.profile_image'), 'traveler_img', 'profile-image');
//                }
                $trip_traveler_id = TripTraveler::create(array(
                            'user_id' => $user_id,
                            'trip_id' => $trip_id,
                            'email' => $row['email'],
                            'first_name' => $row['first_name'],
                            'last_name' => $row['last_name'] ? $row['last_name'] : '',
                            'gender' => $row['gender'],
//                            'profile_pic' => $fileName,
//                            'city' => $row['city'],
                            'created_at' => date('Y-m-d H:i:s')
                        ))->id;
                if (isset($trip_traveler_id)){
                        $user_trip_id = UserTrip::create(array(
                        'user_id' => $user_id,
                        'trip_id' => $trip_id,
                        'booking_date' => date('Y-m-d')
                    ))->id;
                }
            }
        }
        return redirect('/mytripdesign/' . $trip_id);
    }

    /**
     * Function to return Trip Design view
     * @param int id
     * @return url
     */
    public function myTripDesign($id) {
        $userId = Auth::id();
        //Trip Travelers details
        $tripTravelers = DB::table('trip_traveler')
                ->where('trip_id', '=', $id)
                ->where('user_id', '=', $userId)
                ->where('status', '=', '1')
                ->get();
        
        //Trip Flights details
        $tripAirlines = DB::table('trip_airline')
                ->leftjoin('airlines', 'trip_airline.airline_name', '=', 'airlines.id')
                ->select('trip_airline.*', 'airlines.*')
                ->where('trip_airline.trip_id', '=', $id)
//                ->where('trip_airline.airline_departure_date', '>=', date('Y-m-d'))
//                ->where('trip_airline.airline_departure_time', '<=', date('H:i:s'))
                ->where('trip_airline.status', '=', '1')
                ->get();
        
            // echo "<pre>";print_r($tripAirlines);die;
            //Trip Hotels details
//               $tripHotels = DB::table('trip_hotel_booking')
//                ->join('trip_hotel', 'trip_hotel_booking.hotel_id', '=', 'trip_hotel.id')
//                ->select('trip_hotel_booking.*', 'trip_hotel.*')
//                ->where('trip_hotel_booking.trip_id', '=', $id)
//                ->where('trip_hotel_booking.status', '=', '1')
//                ->where('trip_hotel_booking.user_id', '=', $userId)
//                ->get();
        
        
         //Trip Hotels details
        $tripHotels = DB::table('trip_hotel')
                ->select('trip_hotel.*')
                ->where('trip_hotel.trip_id', '=', $id)
                ->where('trip_hotel.status', '=', '1')
                ->get();

        //Trip Addon Details
		$tripaddonarray = array();
        $addon['tripAddons_check'] = DB::table('trip_addon')
                ->where('trip_id', '=', $id)
                ->where('status', '=', '1')
                ->orderBy('created_at')
                ->get();
			
		
		if(!empty($addon['tripAddons_check']))
		{
			foreach($addon['tripAddons_check'] as $addonkey=> $addonitem)
			{
				
				 $addon['tripAddonFlights'][$addonkey] = DB::table('trip_addon_airline')
											->join('airlines', 'trip_addon_airline.airline_name', '=', 'airlines.id')
											->where('trip_addon_airline.trip_id', '=', $id)
											->where('trip_addon_airline.addon_id', '=', $addonitem->id)
											->where('trip_addon_airline.status', '=', '1')
											->get();
			//echo '<pre>';print_r($addondetail['flight_data']);													
			   $addon['tripAddonHotels'][$addonkey] = DB::table('trip_addon_hotel')
                                                                        ->where('trip_id', '=', $id)
                                                                        ->where('addon_id', '=', $addonitem->id)
                                                                        ->where('status', '=', '1')
                                                                        ->get();	
				
			}
			
			//echo '<pre>';	print_r($addon);die;
			
			for($i=0;$i<count($addon['tripAddons_check']);$i++)
				{
					$tripaddonarray[$i]['tripAddons_check'] = $addon['tripAddons_check'][$i];
					
					foreach($addon['tripAddonFlights'][$i] as $key1=>$value1)
						{			
							
							$tripaddonarray[$i]['tripAddonFlights'][$key1] = $value1;
						}
						
						foreach($addon['tripAddonHotels'][$i] as $key2=>$value2)
						{			
							
							$tripaddonarray[$i]['tripAddonHotels'][$key2] = $value2;
						}
					
					//$tripaddonarray[$i]['tripAddonFlights'] = !empty($addon['tripAddonFlights'][$i][0])?$addon['tripAddonFlights'][$i][0]:'';
					//$tripaddonarray[$i]['tripAddonHotels'] = !empty($addon['tripAddonHotels'][$i][0])?$addon['tripAddonHotels'][$i][0]:'';
				}
			
		}
	
        //Trip Included Activities Data
		
		$tripactivityarray = array();
		
        $activity['tripIncludedActivities_check'] = DB::table('trip_included_activity')
                ->where('trip_id', '=', $id)
                ->where('activity_due_date', '>', date('y-m-d'))
                ->where('status', '=', '1')
                ->get();
		if(!empty($activity['tripIncludedActivities_check']))
		{			
				foreach($activity['tripIncludedActivities_check'] as $activitykey=>$activityvalue)
				{
					$activity['includedActivityFlights'][$activitykey] = DB::table('trip_included_activity_airline')
											->where('airline_departure_date', '>', date('Y-m-d'))
											->where('trip_id', '=', $id)
											->where('activity_id', '=', $activityvalue->id)
											->where('status', '=', '1')
											->get();
					  $activity['includedActivityHotles'][$activitykey] = DB::table('trip_included_activity_hotel')
														->where('trip_id', '=', $id)
														->where('hotel_due_date', '>', date('Y-m-d'))
														->where('activity_id', '=', $activityvalue->id)
														->where('status', '=', '1')
														->get();						
					
				}
				//echo  "<pre>"; print_r($activity['tripIncludedActivities_check']);die; 
				
			for($i=0;$i<count($activity['tripIncludedActivities_check']);$i++)
				{
					$tripactivityarray[$i]['tripIncludedActivities_check'] = $activity['tripIncludedActivities_check'][$i];
					foreach($activity['includedActivityFlights'][$i] as $activityflightkey1=>$activityfilghtvalue1)
						{			
							
							$tripactivityarray[$i]['includedActivityFlights'][$activityflightkey1] = $activityfilghtvalue1;
						}
						
						foreach($activity['includedActivityHotles'][$i] as $activityhotelkey2=>$activityhotelvalue2)
						{			
							//echo $activityhotelkey2;die;
							$tripactivityarray[$i]['includedActivityHotles'][$activityhotelkey2] = $activityhotelvalue2;
						}
					//$tripactivityarray[$i]['includedActivityFlights'] = !empty($activity['includedActivityFlights'][$i][0])?$activity['includedActivityFlights'][$i][0]:'';
					//$tripactivityarray[$i]['includedActivityHotles'] = !empty($activity['includedActivityHotles'][$i])?$activity['includedActivityHotles'][$i]:'';
				}	
				
		}
        //echo  "<pre>"; print_r($tripactivityarray);die; 
       
        //To Do Packing Details
        $tripTodo = DB::table('trip_todo')
                //->join('trip_todo', 'user_trip_todo.todo_id', '=', 'trip_todo.id')
                ->where('trip_todo.trip_id', '=', $id)
               // ->where('trip_todo.user_id', '=', $userId)
                ->where('trip_todo.status', '=', '1')
                ->get();
        
        //Data to send for design my trip view
        $dashboardData = $this->dashboardElements();
      
        $data = array(
            'tripAirlines' => $tripAirlines,
            'tripHotels' => $tripHotels,
            'tripTravelers' => $tripTravelers,
            'tripAddons' => $tripaddonarray,
            'tripIncludedActivities' => $tripactivityarray,
            'tripTodo' => $tripTodo
        );
	//echo '<pre>';print_r($tripTravelers);die;	
        return view('tripdesign', ['tripdata' => $data,'data' => $dashboardData,'trip_id' => $id]);
    }
    
    
 

    /**
     * Upload file and return the name of the uploaded file
     *
     * @param object $file
     * @param object $directory
     * @param object $startWith
     * @return string $fileName
     */
    protected function imageUpload($file, $directory = null, $startWith) {
        // SET UPLOAD PATH
        if ($directory != NULL && $directory != '') {
            $destinationPath = base_path() . '/public/uploads/' . $directory . '/';
        } else {
            $destinationPath = base_path() . '/public/uploads/';
        }

        // GET THE FILE EXTENSION
        $extension = $file->getClientOriginalExtension();

        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $fileName = $startWith . md5(time()) . '.' . $extension;

        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $file->move($destinationPath, $fileName);

        return $fileName;
    }
	

     /* Function to update traveler information
     * @param int Request
     * @return url
     */
	public function travelerProfile($id,Request $request)
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
                   $destinationPath = storage_path() . '/passport_img/';						
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
			return redirect('view-traveler/'.$id);					
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
					$destinationPath = storage_path() . '/uploads/profile_images/';						

                                $checkdataexist= DB::table('trip_traveler_profile')->where('traveler_id', $id)->first();
					$destinationPath = storage_path() . '/uploads/passport_images/';						

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
				return redirect('view-traveler/'.$id);				
			}	
			
		// End here//		
                $travelerprofile=DB::table('trip_traveler')->where('id', $id)->first(); 
			$data = $this->dashboardElements();
		
		$data['traveler_profiledata'] = DB::table('trip_traveler_profile')->where('traveler_id', $id)->first();		
		return view('traveler_profile',['travelerprofile' => $travelerprofile,'data'=>$data]);
	}


}
