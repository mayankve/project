<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\User;
use App\Trip;
use Validator;
use App\UserProfile;
use App\Country;

class HomeController extends Controller {

    /**
     * Function to return home view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Get all the trips which are active and whose end date is not null and trip is not deleted
        $trips = Trip::where('end_date', '!=', NULL)->where('is_deleted', '!=', '1')->paginate(6);

        return view('welcome', ['trips' => $trips]);
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
                    'password.min' => 'Password must contain atleat 6 characters',
                        )
        );

        if ($validation->fails()) {  // Some data is not valid as per the defined rules
            $error = $validation->errors()->first();

            if (isset($error) && !empty($error)) {
                $response['errCode'] = 1;
                $response['errMsg'] = $error;
            }
        } else {
            if (Auth::attempt(['email' => $loginData['email'], 'password' => $loginData['password'], 'is_deleted' => '0'], $remember)) { // is_deleted: 0, means user is active
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
     * Function to load User dashboard
     * @param void
     * @return array
     */
    public function userDashboard() {
        $userId = Auth::id();
        //For Basic Info
        $userData = User::where('id', '=', $userId)->first();
        //For Profile Info
        $countries = Country::all();
        $user_country = User::where('id', '=', $userId)->first();
        $profileData = UserProfile::where('user_id', '=', $userId)->first();
        return view('dashboard', ['data' => $userData, 'profile' => $profileData, 'countries' => $countries, 'user_country' => $user_country]);
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

        $profile_pic = $request->file('profile_pic');
        $is_helth_mental = $request->input('is_helth_mental');
        $helth_mental_conditions = $request->input('helth_mental_conditions');
        $is_mental_conditions = $request->input('is_mental_conditions');
        $mental_conditions = $request->input('mental_conditions');
        $food_allergies = $request->input('food_allergies');
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

}
