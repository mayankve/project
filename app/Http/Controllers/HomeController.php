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
use Session;
use File;
use App\User;
use App\Trip;
use Validator;
use App\UserProfile;
use App\Country;
use App\TripTraveler;
use App\UserTrip;
use App\TripTravelerProfile;
use App\UserCard;
use Helper;
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
                ->groupby('trips.id')
                ->get();
		//echo '<pre>';print_r($userTrips);die;
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
            'user_trips' => $userTrips,
            'user_data' => $userData,
            'countries' => $countries,
            'user_country' => $userCountry,
            'profile_data' => $profileData,
            'trips' => $trips
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
                $trip_to_book = session('trip_to_book');
                $user = User::find($userId);
                // Rolewise redirection url
                $redirectionUrl = url('/dashboard');  
                if ($user->hasRole(['admin'])) {
                    $redirectionUrl = url('admin/dashboard');
                }else if($trip_to_book != null) {
                   $redirectionUrl = url('book/'.$trip_to_book);
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
		
		
		
		
		 $tripalldetail=array();
		 
		  $userId = Auth::id();
		  $data = $this->dashboardElements();
		   $userTrips['trip_detail'] = DB::table('user_trip')
						->join('trips', 'user_trip.trip_id', '=', 'trips.id')
						->select('trips.*', 'user_trip.*')
						->where('user_trip.user_id', '=', $userId)
						->where('user_trip.status', '=', '1')
						->groupby('trips.id')
						->get();
			//echo '<pre>';print_r($userTrips['trip_detail']);die;			
		foreach($userTrips['trip_detail'] as $key=>$value)
		{			
			$userTrips['traveler_detail'][$key]=DB::table('trip_traveler')
											->where('trip_id', '=', $value->trip_id)
											->where('user_id', '=', $userId)
											->where('status', '=', '1')
											->where('is_confirm','=','1')
											->get();
			$userTrips['selected_add_on'][$key]=DB::table('trip_addon_booking')
											->where('trip_id', '=', $value->trip_id)
											->where('user_id', '=', $userId)
											->get();
			$userTrips['paidamount'][$key]=DB::table('trip_reserve_payment')
													->where('trip_id', '=', $value->trip_id)
													->where('user_id', '=', $userId)
													->get();								
		}

		for ($i = 0; $i < count($userTrips['trip_detail']); $i++) {
			
              $tripalldetail[$i]['trip_detail'] = $userTrips['trip_detail'][$i];
					foreach ($userTrips['traveler_detail'][$i] as $activityflightkey1 => $activityfilghtvalue1) {

						$tripalldetail[$i]['traveler_detail'][$activityflightkey1] = $activityfilghtvalue1;
					}

					foreach ($userTrips['selected_add_on'][$i] as $activityhotelkey2 => $activityhotelvalue2) {

						$tripalldetail[$i]['selected_add_on'][$activityhotelkey2] = $activityhotelvalue2;
					}
					 foreach ($userTrips['paidamount'][$i] as $activityhotelkey3 => $activityhotelvalue3) {

							$tripalldetail[$i]['paidamount'][$activityhotelkey3] = $activityhotelvalue3;
						}
                
            }
			
		//echo'<pre>';print_r($tripalldetail);die;
		//exit();
		return view('dashboard',['tripdata'=>$tripalldetail,'data'=>$data]);
		
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
        $trips = Trip::where('status', '1')
             ->orderBy('id', 'desc')
             ->get();
        $userId = Auth::id();
        //if (isset($userId)) {
            $userData = User::where('id', '=', $userId)->first();
            return view('triplist', ['trips' => $trips, 'data' => $userData]);
       // } else {
           // return view('triplist', ['trips' => $trips]);
        //}
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
		//echo '<pre>';print_r($tripData);die;
		$travlerdataconfirm =  TripTraveler::where('is_confirm', '1')
									->where('trip_id',$tripData->id)
									->get();
						
							
		$travlerdatapendig =  TripTraveler::where('is_confirm', '0')
									->where('trip_id',$tripData->id)
									->get();
		
		$remaningspots= $tripData->maximum_spots - count($travlerdataconfirm);
		$remaningwaiting=$tripData->maximum_wating_spots-count($travlerdatapendig);
        return view('booktrip', ['tripdata' => $tripData,'remaningwaiting'=>$remaningwaiting,'remaningspots'=>$remaningspots]);
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
			$message["traveler.{$key}.first_name.required"] = 'First name is required';
            $message["traveler.{$key}.email.required"] = 'Email is required';
        }
        $this->validate($request,$rules,$message);
        $trip_id = $request->get('trip_id');
		$tripData = Trip::where('id', '=', $trip_id)->first();
		
		
	
        $user_id = Auth::id();
        $traveler_details = $request->get('traveler');
		
		
        $resever_pay_amount = $request->get('payamount') * count($traveler_details) ;
		
		
        $flag = 1;
        if (count($traveler_details) > 0) {
            foreach ($traveler_details as $index => $row) {
					if(count($traveler_details)<=$tripData->maximum_spots)
					{
						$travlerdataconfirm =  TripTraveler::where('is_confirm', '1')
												->where('trip_id',$trip_id)
												->get();
						
							
						$travlerdatapendig =  TripTraveler::where('is_confirm', '0')
												->where('trip_id',$trip_id)
												->get();
									
						$maximumspots= $tripData->maximum_spots ;
						
						$remaningslot= $maximumspots - count($travlerdataconfirm);
						
						$remaningslotpending= $tripData->maximum_wating_spots - count($travlerdatapendig);
						
					//echo $remaningslot;die;
					//maximu=2 and pending=2
						if($remaningslot<=$maximumspots && $remaningslot > 0)
						{
							//echo $remaningslot;die;							
							$trip_traveler_id = TripTraveler::create(array(
										'user_id' => $user_id,
										'trip_id' => $trip_id,
										'email' => $row['email'],
										'first_name' => $row['first_name'],
										'last_name' => $row['last_name'] ? $row['last_name'] : '',
										'is_confirm'=>'1',
										'gender' => $row['gender'],
										'created_at' => date('Y-m-d H:i:s')
									))->id;
							if (isset($trip_traveler_id)) {
								$user_trip_id = UserTrip::create(array(
											'user_id' => $user_id,
											'trip_id' => $trip_id,
											'booking_date' => date('Y-m-d')
										))->id;
							}
						}elseif($remaningslotpending <= $tripData->maximum_wating_spots && $remaningslotpending > 0){
							//echo 'mukesh';die;
								$trip_traveler_id = TripTraveler::create(array(
											'user_id' => $user_id,
											'trip_id' => $trip_id,
											'email' => $row['email'],
											'first_name' => $row['first_name'],
											'last_name' => $row['last_name'] ? $row['last_name'] : '',
											'is_confirm'=>'0',
											'gender' => $row['gender'],
											'created_at' => date('Y-m-d H:i:s')
										))->id;
								if (isset($trip_traveler_id)) {
									$user_trip_id = UserTrip::create(array(
												'user_id' => $user_id,
												'trip_id' => $trip_id,
												'booking_date' => date('Y-m-d')
											))->id;
							}
						}else{
								return redirect('book/'.$trip_id)
									->with('error','you cannot add more traveler to this trip');
						}
					}else{					
						return redirect('book/'.$trip_id)
									->with('error','you cannot  add more traveler to this trip');
					}
            $flag++; }
			

            // payment info detail save//
            $paymentdata['user_id'] = $user_id;
            $paymentdata['trip_id'] = $trip_id;
            $paymentdata['reserve_paid_amount'] = $resever_pay_amount;
            $paymentdata['status'] = 1;
            $paymentdata['txn_id'] = 'HMX54887455212se';
            $paymentdata['create_date'] = date('y-m-d');
            $paymentdataid = DB::table('trip_reserve_payment')->insertGetId($paymentdata);
            //end here//
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
        $tripDetails = Trip::where('id', $id)->first();
        // echo "<pre>"; print_r($tripDetails);die;
        $tripTravelers = DB::table('trip_traveler')
                ->where('trip_id', '=', $id)
                ->where('user_id', '=', $userId)
                ->where('status', '=', '1')
				->where('is_confirm','=','1')
                ->get();
				
				
		$tripTravelerswaiting = DB::table('trip_traveler')
                ->where('trip_id', '=', $id)
                ->where('user_id', '=', $userId)
                ->where('status', '=', '1')
				->where('is_confirm','=','0')
                ->get();
 //echo "<pre>"; print_r($tripTravelerswaiting);die;
        //Trip Flights details
        $tripAirlines = DB::table('trip_airline')
                ->leftjoin('airlines', 'trip_airline.airline_name', '=', 'airlines.id')
                ->select('trip_airline.*', 'airlines.*')
                ->where('trip_airline.trip_id', '=', $id)
                ->where('trip_airline.status', '=', '1')
                ->get();


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

        if (!empty($addon['tripAddons_check'])) {
            foreach ($addon['tripAddons_check'] as $addonkey => $addonitem) {

                $addon['tripAddonFlights'][$addonkey] = DB::table('trip_addon_airline')
                        ->join('airlines', 'trip_addon_airline.airline_name', '=', 'airlines.id')
                        ->where('trip_addon_airline.trip_id', '=', $id)
                        ->where('trip_addon_airline.addon_id', '=', $addonitem->id)
                        ->where('trip_addon_airline.status', '=', '1')
                        ->get();

                $addon['tripAddonHotels'][$addonkey] = DB::table('trip_addon_hotel')
                        ->where('trip_id', '=', $id)
                        ->where('addon_id', '=', $addonitem->id)
                        ->where('status', '=', '1')
                        ->get();
            }

            for ($i = 0; $i < count($addon['tripAddons_check']); $i++) {
                $tripaddonarray[$i]['tripAddons_check'] = $addon['tripAddons_check'][$i];

                foreach ($addon['tripAddonFlights'][$i] as $key1 => $value1) {

                    $tripaddonarray[$i]['tripAddonFlights'][$key1] = $value1;
                }

                foreach ($addon['tripAddonHotels'][$i] as $key2 => $value2) {

                    $tripaddonarray[$i]['tripAddonHotels'][$key2] = $value2;
                }
            }
        }

        //Trip Included Activities Data

        $tripactivityarray = array();

        $activity['tripIncludedActivities_check'] = DB::table('trip_included_activity')
                ->where('trip_id', '=', $id)
                ->where('activity_due_date', '>', date('y-m-d'))
                ->where('status', '=', '1')
                ->get();
				//echo '<pre>';print_r($tripactivityarray);die;

        if (!empty($activity['tripIncludedActivities_check'])) {
            foreach ($activity['tripIncludedActivities_check'] as $activitykey => $activityvalue) {
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


        for ($i = 0; $i < count($activity['tripIncludedActivities_check']); $i++) {
                $tripactivityarray[$i]['tripIncludedActivities_check'] = $activity['tripIncludedActivities_check'][$i];
                foreach ($activity['includedActivityFlights'][$i] as $activityflightkey1 => $activityfilghtvalue1) {

                    $tripactivityarray[$i]['includedActivityFlights'][$activityflightkey1] = $activityfilghtvalue1;
                }

                foreach ($activity['includedActivityHotles'][$i] as $activityhotelkey2 => $activityhotelvalue2) {

                    $tripactivityarray[$i]['includedActivityHotles'][$activityhotelkey2] = $activityhotelvalue2;
                }
                
            }
        }

		//echo '<pre>';print_r($tripactivityarray);die;
		
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
            'tripTodo' => $tripTodo,
			'tripTravelerswaiting'=>$tripTravelerswaiting
        );
        //For Trip Customization

        // Last Booking data
        $BookedTripDetails = DB::table('checkout')
                ->where('trip_id', '=', $id)
                ->where('user_id', '=', $userId)
                ->where('status', '=', '1')
                ->orderBy('id','desc')
                ->first();

        $addonarray=array();
        $bookedData = array();
		$activitycustom=array();
        //$addonarrydata=array();
        if(isset($BookedTripDetails->id)){
         //Booked Addons
         $bookedAddons['add_on'] = DB::table('trip_addon_booking')
                        ->where('checkout_id','=',$BookedTripDetails->id)
                        ->where('trip_id', '=', $id)
                        ->where('user_id', '=', $userId)
                        ->get();



          foreach($bookedAddons['add_on'] AS $addonkey=> $bookedAddon){               //Booked Addon Travelers

			      $bookedAddons['travelers'][$addonkey] = DB::table('trip_addon_traveler')
                              ->where('addon_id','=', $bookedAddon->add_on_id)
                              ->where('trip_id', '=', $id)
							  ->where('is_confirm', '=','1')
                              ->where('user_id', '=', $userId)
                              ->get();
							  
				 $bookedAddons['travelers_waiting'][$addonkey] = DB::table('trip_addon_traveler')
									  ->where('addon_id','=', $bookedAddon->add_on_id)
									   ->where('trip_id', '=', $id)
									  ->where('is_confirm', '=','0')
									  ->where('user_id', '=', $userId)
									  ->get();			  
						  
            }
		//echo '<pre>';print_r($bookedAddons);die;
         // set here key value//
            foreach($bookedAddons['add_on'] as $key=>$value)
            {
				$addonarray['addon_data'][$value->add_on_id]=array(
									'add_on_id'=>$value->add_on_id,
									'flight_id'=>$value->flight_id,
									'flight_name'=>$value->flight_name,
									'flight_number'=>$value->flight_number,
									'flight_departure_date'=>$value->flight_departure_date,
									'flight_departure_time'=>$value->flight_departure_time
				);
				
                $addonarray['addon_id'][]=$value->add_on_id;
                $addonarray['flight_id'][]=$value->flight_id;
                $addonarray['hote_id'][]=$value->hotel_id;
				if(!empty($bookedAddons['travelers'])){
					foreach($bookedAddons['travelers'][$key] as $travelerkey=>$travelervalue)
					{
						 $addonarray['traveler'][$value->add_on_id][] = $travelervalue->traveler_id;
					}
				}
				if(!empty($bookedAddons['travelers_waiting'])){
					foreach($bookedAddons['travelers_waiting'][$key] as $travelerkeywaiting=>$travelervaluewaiting)
					{
						 $addonarray['travelers_waiting'][] = $travelervaluewaiting->addon_id;
					}
				}
				
            }
			// end here..//
	//echo '<pre>';print_r($addonarray);die;

            //Booked Included Activities
            $bookedAcitivities = DB::table('trip_included_activity_booking')
                ->where('checkout_id','=',$BookedTripDetails->id)
                ->where('trip_id', '=', $id)
                ->where('user_id', '=', $userId)
                ->get();


			foreach($bookedAcitivities as $activitykeyforCustom => $activityCustomValue)
			{
				$activitycustom['activity_data'][$activityCustomValue->activity_id]=array(
									'activity_id'=>$activityCustomValue->activity_id,
									'activity_flight_id'=>$activityCustomValue->activity_flight_id,
									'flight_name'=>$activityCustomValue->flight_name,
									'flight_number'=>$activityCustomValue->flight_number,
									'flight_departure_date'=>$activityCustomValue->flight_departure_date,
									'flight_departure_time'=>$activityCustomValue->flight_departure_time
				);

				$activitycustom['activity_id'][$activitykeyforCustom]=$activityCustomValue->id;
				$activitycustom['flight_id'][$activitykeyforCustom]=$activityCustomValue->activity_flight_id;
				$activitycustom['hotel_id'][$activitykeyforCustom]=$activityCustomValue->activity_hotel_id;
			}

            $bookedData = array(
                'bookedTrip' => $BookedTripDetails,
                'bookedAddons' => $addonarray,
				 'bookedActivities' =>$activitycustom,
				'activitydata'=>$bookedAcitivities
            );
        }else{
			$bookedData='';
		}
	//echo "<pre>";print_r($bookedData);die;
        return view('tripdesign', ['tripdata' => $data, 'data' => $dashboardData, 'trip_id' => $id, 'tripDetails' => $tripDetails,'bookedData'=> $bookedData]);
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

    public function travelerProfile($id, Request $request) {

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
            TripTraveler::where(['id' => $id])->update($data);
            return redirect('view-traveler/' . $id);
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
            // $destinationPath = storage_path() . '/uploads/profile_images/';

           $checkdataexist = DB::table('trip_traveler_profile')->where('traveler_id', $id)->first();
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
                DB::table('trip_traveler_profile')->where('traveler_id', $id)
                        ->update($personaldata);
            } else {
                $personaldata['traveler_id'] = $id;
                DB::table('trip_traveler_profile')->insert($personaldata);
            }
            return redirect('view-traveler/' . $id);
        }

        // End here//
        $travelerprofile = DB::table('trip_traveler')->where('id', $id)->first();
        $data = $this->dashboardElements();

        $data['traveler_profiledata'] = DB::table('trip_traveler_profile')->where('traveler_id', $id)->first();
        return view('traveler_profile', ['travelerprofile' => $travelerprofile, 'data' => $data]);
    }
    /* 	Function to load registration view
     * @return url
     */
         public function createUser() {
                 $countries = Country::all();
                        $data = array(
            'countries' => $countries
                        );
                  return view('registration',['data'=>$data]);
         }
         
    /* Function to register the user 
     * @param int Request
     * @return url
     */
        public function registerUser(Request $request) {
         // Validations
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'dob'  => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ];
            $this->validate($request, $rules);
            // Create User
            $user = new User();
            $user->name = $request->input('first_name');
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->dob  = $request->input('dob');
            $user->email  = $request->input('email');
            $user->password  =  Hash::make($request->input('password'));
            $user->gender  = $request->input('gender');
            $user->is_passport = $request->input('is_passport');
            $user->passport_exp_date  = $request->input('passport_exp_date'); 
            $user->issuing_country  = $request->input('issuing_country');
            $user->country_of_birth  = $request->input('country_of_birth');
            $id = $user->save();
            if ($user->save()) {
                 // $request->session()->flash('success', 'Registration is done successfully');
                return redirect('/login');
            } 
            else {
               $request->session()->flash('error', 'Error!');
            }
            return redirect('/registration');
        }
		
	/* Function to refund policy the user 
     * @param int Request
     * @return url
     */
	 
	 public function refundPolicy($id)
	 {
		  $userId = Auth::id();
        //Trip Travelers details
        $tripDetails = Trip::where('id', $id)->first();
		
		return view('refund_policy',['tripdata'=>$tripDetails]);
		 
	 }
	 
	 	
	/* Function to view profile the user 
     * @param int Request
     * @return url
     */
	 
	 public function viewProfile(Request $request)
	 {
		$userId = Auth::id();
		 
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
            return redirect('view_profile');
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
            return redirect('view_profile/');
        }
		 
		 $userprofile = DB::table('users')->where('id', $userId)->first();
        $profiledata = DB::table('user_profile')->where('user_id', $userId)->first();
		//echo "<pre>"; print_r($data['traveler_profiledata']);die;
        $data = $this->dashboardElements();
     // echo "<pre>"; print_r($data);die;
        return view('view_profile', ['data' => $data,'userprofile'=>$userprofile,'profiledata'=>$profiledata]);	
	 }
	 
	/* Function to cancel the Trip and show the refund amount 
     * @param int Request
     * @return url
     */
	 
	 public function cancelTrip($id)
	{
		 $trip = Trip::find($id);
		 $dataTrip['status']='0';
		 $trip->update($dataTrip);
		 DB::table('user_trip')->where('trip_id',$id)->update($dataTrip);
		 return redirect('dashboard');
	}	
	
	
	/* Function to view book trip detail the user 
     * @param int Request
     * @return url
     */
	 
	 public function tripDetail($id)
	 {		 			
				
					
		 
		 $tripalldetail=array();
		 
		  $userId = Auth::id();
		  $data = $this->dashboardElements();
		   $userTrips['trip_detail'] =   DB::table('checkout')
												->join('trips', 'checkout.trip_id', '=', 'trips.id')
												->select('trips.*', 'checkout.*')
												->where('checkout.user_id', '=', $userId)
												->where('trips.status', '=', '1')
												->where('trips.id', '=', $id)												
												->first();
			$userTrips['emidata']=DB::table('user_emi')
										->where('trip_id',$id)
										->where('user_id',$userId)
										->first();
			
			if(!empty($userTrips['trip_detail']))
			{				
				$userTrips['hotel_data']= DB::table('trip_hotel')
										->select('trip_hotel.*')
										->where('trip_hotel.trip_id', '=', $id)
										 ->where('trip_hotel.id', '=', $userTrips['trip_detail']->trip_hotel_id)
										->where('trip_hotel.status', '=', '1')
										->first();
												
			if(!empty($userTrips['trip_detail']->trip_flight_id))
			{
				$userTrips['flight_data']=DB::table('trip_airline')
												->leftjoin('airlines', 'trip_airline.airline_name', '=', 'airlines.id')
												->select('trip_airline.*', 'airlines.*')
												->where('trip_airline.trip_id', '=', $id)
												->where('airlines.id', '=',$userTrips['trip_detail']->trip_flight_id)                
												->first();
				
			}else{
				$userTrips['flight_data']=array('flight_name'=>$userTrips['trip_detail']->flight_name,
												'flight_number'=>$userTrips['trip_detail']->flight_number,
												'flight_departure_date'=>$userTrips['trip_detail']->flight_departure_date,
												'flight_departure_time'=>$userTrips['trip_detail']->flight_departure_time
													
											);
			}				
												
													
			$userTrips['traveler_detail']=DB::table('trip_traveler')
											->where('trip_id', '=', $id)
											->where('user_id', '=', $userId)
											->where('status', '=', '1')
											->where('is_confirm','=','1')
											->get();
											
												
			$userTrips['selected_add_on']=DB::table('trip_addon_booking')
											->leftjoin('trip_addon','trip_addon_booking.add_on_id','=','trip_addon.id')	
											->where('trip_addon_booking.trip_id', '=', $id)
											->where('trip_addon_booking.user_id', '=', $userId)
											->get();
											
			$userTrips['selected_activity']=DB::table('trip_included_activity_booking')
											->leftjoin('trip_included_activity','trip_included_activity_booking.activity_id','=','trip_included_activity.id')	
											->where('trip_included_activity_booking.trip_id', '=', $id)
											->where('trip_included_activity_booking.user_id', '=', $userId)
											->get();								
											
			$userTrips['paidamount']=DB::table('trip_reserve_payment')
													->where('trip_id', '=', $id)
													->where('user_id', '=', $userId)
													->get();
	
			}else{
				$userTrips=array();
			}


				//echo '<pre>';print_r($userTrips);die;
		return view('trip_detail',['tripdata'=>$userTrips,'data'=>$data]); 

		
	 }
	 
	 public function payAhead(Request $request,$id)
	 {
			$userId = Auth::id();
			//echo $id;die;
				$paid_amount= $request->input('payahead');
				$paymentdata['user_id']=$userId;
				$paymentdata['trip_id']=$id;
				$paymentdata['reserve_paid_amount']=$paid_amount;
				$paymentdata['status']=1;
				$paymentdata['txn_id']='HMX54887455212se';
				$paymentdata['create_date']=date('y-m-d');
				$paymentdataid = DB::table('trip_reserve_payment')->insertGetId($paymentdata);	
				return redirect('trip_detail/'.$id);
		 
	 }
	 
	 
	 
	 
	 
	 
	 
		/*
		*User can see the card details here
		*/
		 public function cardDetails()
		 {
				$userId = Auth::id();
				//echo $userId;die;
				$dashboardData = $this->dashboardElements();
				$userCard = UserCard::where('user_id', '=', $userId)->first();
			 	return view('card_details',['data'=>$dashboardData,'cardData'=>$userCard]);	
		 }
		 
		/*
		*User insert or update the card details here
		*params Request
		*/
		 public function saveCardDetails(Request $request)
		 {
				$rules = [
				'card_holder_name'	 => 'required',
				'card_number'          => 'required',
				'expiry_month'      => 'required',
				'expiry_year'    => 'required',
				'cvv' =>'required'
				];
				$this->validate($request,$rules);
				$userId = Auth::id();
				
				//echo "<pre>";print_r($request->all());die;
				
				$cardDetails['user_id'] = $userId ;
				$cardDetails['card_holder_name'] =  $request->input('card_holder_name');
				$cardDetails['card_number'] = $request->input('card_number');
				$cardDetails['expiry_month'] = $request->input('expiry_month');
				$cardDetails['expiry_year'] = $request->input('expiry_year');
				$cardDetails['cvv'] = $request->input('cvv');
				
				$userCard = UserCard::where('user_id', '=', $userId)->first();
				 if(isset($userCard->id)){
					 // Update the Card 
					 $findRow = UserCard::findOrFail($userCard->id);
					 $findRow->update($cardDetails);
					 Session::flash('message', 'your card details have been updated!'); 
					 Session::flash('alert-class', 'alert-success'); 
				 }
				else{
					//insert Card Details
					UserCard::create($cardDetails);
					 Session::flash('message', 'your card details have been saved!'); 
					 Session::flash('alert-class', 'alert-success'); 
				}
			 	return redirect('/card-details');	
		 }
		
}
