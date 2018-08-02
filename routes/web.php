<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Front-end routes */

// home page
Route::get('/','HomeController@index');

// about us page
Route::get('/about', 'HomeController@about');

// contact us page
Route::get('/contact', 'HomeController@contact');

// front-end login
Route::get('/login', 'HomeController@clientLogin')->name('login');

// Front-end login
Route::post('/userlogin', 'HomeController@userLogin');

// Front-end logout
Route::get('/logout', 'HomeController@logout');

// Front end Change Password
Route::get('/changepassword', 'HomeController@changePassword');
// Front end Change Password
Route::post('/changeuserpassword', 'HomeController@changeUserPassword');

//User Dashboard
Route::get('/dashboard','HomeController@userDashboard');

// To update user basic information
Route::post('/updateuserbasicinfo', 'HomeController@updateUserBasicInfo');

// To update user basic information
Route::post('/updateuserprofileinfo', 'HomeController@updateUserProfileInfo');

//List Trips for users
Route::get('listtrip','HomeController@listTrip');

//view Trips for users
Route::get('tripview/{id}','HomeController@tripView');

//Book Trip for users
Route::get('book/{id}','HomeController@bookTripView');

//Saving Trip for users
Route::post('booktrip','HomeController@bookTrip');

//Design Trip for users
Route::get('mytripdesign/{id}','HomeController@myTripDesign');

// set Cart for users
 Route::post('setcartvalue','CartController@index');
/* Front-end routes ends */

// Cart for users
 Route::match(['get','post'],'cart','CartController@addtocart');
/* Front-end routes ends */

// cart remove 
Route::match(['get','post'],'cartremove','CartController@removecart');

//checkout
Route::match(['get','post'],'checkout','CartController@processtocheckout');


//Airlines to be added to Cart
 Route::post('addFlightToCart','CartController@addFlightToCart');
  
// traveler profile in user dashboard
Route::match(['get','post'],'view-traveler/{id}','HomeController@travelerProfile');

 
/* User-end routes ends */

 
 
 
/* Admin routes */

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
	
	// Dashboard page
	Route::get('/dashboard','AdminController@userDashboard');

	// Create trip
	Route::get('/createtrip','AdminController@createTrip');
    Route::post('/store-trip','AdminController@storeTrip');

    // Edit trip
    Route::get('/edittrip/{id}','AdminController@editTrip');
    Route::patch('updatetrip/{id}', 'AdminController@updateTrip');

    // Delete trip
    Route::get('/deletetrip/{id}','AdminController@deleteTrip');
        
    //  List trip
	Route::get('/listtrip','AdminController@listTrip');
        
         // Trip Spots
	Route::get('/tripspot','AdminController@tripSpot');

    // Manage Trip
    Route::prefix('manage-trip')->group(function () {
        // Trip Addon Travelers
        Route::get('/addon-travelers','AdminController@tripAddonTravelers');

        Route::get('/get-trip-addons/{trip_id}','AdminController@getTripAddons');
		//get Trip travelers
		Route::get('get-trip-travellers-by/{trip_id}/{addon_id}','AdminController@getTripTraveler');
		
		Route::get('/monthly-trip-projection','AdminController@monthlyTripProjection');
		
		Route::get('/setmonthlypaymentdate/{date}/{trip_id}','AdminController@setMonthlyPaymentDate');
    });
        
         // Upload Video
	Route::get('/uploadvideo','AdminController@uploadVideo');
        

    //view Trips for admin
    Route::get('/tripview/{id}','HomeController@tripView');

    //Book Trip for users
    Route::get('/book/{id}','HomeController@bookTrip');
	
// traveler profile in admin dashboard	
Route::match(['get','post'],'view-traveler/{id}','AdminController@adminTravelerProfile');

// demo route
Route::match(['get','post'],'/check-validation-blade','AdminController@checkValidationBlade');

Route::match(['get','post'],'check-validation/','AdminController@checkValidation');





});



/* Admin routes ends */

/* Images routes */

// To fetch the profile images from storage and return it
Route::get('/profile_images/{filename}', function ($filename)
{
    $path = storage_path() . '/uploads/profile_images' . '/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});



// To fetch the profile images from storage and return it
Route::get('/passport_images/{filename}', function ($filename)
{
    $path = storage_path() . '/uploads/passport_images' . '/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});
/* Images routes ends */


/* ACL routes */
Route::get('/addUser', 'ACLController@addUser');
Route::get('/addRole', 'ACLController@addRole');
Route::get('/assignRole', 'ACLController@assignRole');
/* ACL routes ends */




