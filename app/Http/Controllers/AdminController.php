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
use App\UserProfile;
use App\Country;
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
    public function createTrip() {
        return view('admin/createTrip');
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
