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
 
 //To avoid the PHP version issue

 if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}



/* Front-end routes */

// home page
Route::get('/', 'HomeController@index');

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

//List Trips for guest
Route::get('listtrip', 'HomeController@listTrip');

//Trip View for guest
Route::get('tripview/{id}', 'HomeController@tripView');

//Register View for guest
Route::get('registration', 'HomeController@createUser');

//Register View for guest
Route::post('register-user', 'HomeController@registerUser');

//paypal Test Payment Process 
Route::get('payment', 'PaymentController@PaymentProcess');

//paypal Test Payment Process 
Route::get('payment-success', 'PaymentController@success');

//paypal Test Payment Process 
Route::get('payment-cancel', 'PaymentController@cancel');

/*************** User end routes start************************* */

Route::group(['middleware' => ['auth']], function() {
    //User Dashboard
    Route::get('/dashboard', 'HomeController@userDashboard');

// To update user basic information
    Route::post('/updateuserbasicinfo', 'HomeController@updateUserBasicInfo');

// To update user basic information
    Route::post('/updateuserprofileinfo', 'HomeController@updateUserProfileInfo');

//List Trips for users
//Route::get('listtrip', 'HomeController@listTrip');

//view Trips for users
 // Route::get('tripview/{id}','HomeController@tripView');
 
//Book Trip for users
    Route::get('book/{id}', 'HomeController@bookTripView');
	
	
	Route::get('/trip_refund_policy/{id}','HomeController@refundPolicy');

//Saving Trip for users
    Route::post('booktrip', 'HomeController@bookTrip');

//Design Trip for users
    Route::get('mytripdesign/{id}', 'HomeController@myTripDesign');

// set Cart for users
    Route::post('setcartvalue', 'CartController@index');
    /* Front-end routes ends */

// Cart for users
    Route::match(['get', 'post'], 'cart', 'CartController@addtocart');
    /* Front-end routes ends */

// cart remove 
    Route::match(['get', 'post'], 'cartremove', 'CartController@removecart');

//checkout
    Route::match(['get', 'post'], 'checkout', 'CartController@processtocheckout');

//Airlines to be added to Cart
    Route::post('addFlightToCart', 'CartController@addFlightToCart');

// traveler profile in user dashboard
    Route::match(['get', 'post'], 'view-traveler/{id}', 'HomeController@travelerProfile');
    
    // EMI  calculation blade
    Route::match(['get','post'],'emi-calculation', 'CartController@emiCalculator');
	
	Route::match(['get', 'post'], 'view_profile', 'HomeController@viewProfile');
	
	Route::match(['get', 'post'], 'cancel_trip/{id}', 'HomeController@cancelTrip');
	
	Route::match(['get', 'post'], 'trip_detail/{id}', 'HomeController@tripDetail');
	
	Route::match(['get', 'post'], 'pay_ahead/{id}', 'HomeController@payAhead');
	
//pay pal here //	 
	Route::get('paypal/cancel','PaypalController@paymentCancel'); 
	Route::get('paypal/success','PaypalController@PaymentSuccess');	
	Route::get('payment-status', 'PaypalController@paymentStatus');
// end here //
	

// test recurly
	Route::get('checkrecurly','PaypalController@checkRecurlypaypal');
	//end here//	

	//paypal Test Payment Process 
Route::get('payment', 'PaymentController@PaymentProcess');

//paypal Test Payment Process 
Route::get('payment-success', 'PaymentController@success');

//paypal Test Payment Process 
Route::get('payment-cancel', 'PaymentController@cancel');

// testing recurly 
	Route::get('test-recurly','PaymentController@testRecurly');
	Route::post('recurly-payment','PaymentController@paymentRecurly');
//end here//
		
//User Card Details View 
	Route::get('card-details', 'HomeController@cardDetails');
	
//User Card save url 
	Route::post('save-details', 'HomeController@saveCardDetails');
	
//set crone url emi email//

	Route::get('/emipendingmail','HomeController@emiPendingmail');
	
});





/* User-end routes ends */




/* Admin routes */

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    // Dashboard page
    Route::match(['get','post'],'/dashboard', 'AdminController@userDashboard');
	
	 Route::match(['get','post'],'/view_profile', 'AdminController@viewProfile');

    // Create trip
    Route::get('/createtrip', 'AdminController@createTrip');
    Route::post('/store-trip', 'AdminController@storeTrip');

    // Edit trip
    Route::get('/edittrip/{id}', 'AdminController@editTrip');
    Route::patch('updatetrip/{id}', 'AdminController@updateTrip');

    // Delete trip
    Route::get('/deletetrip/{id}', 'AdminController@deleteTrip');

    //  List trip
    Route::get('/listtrip', 'AdminController@listTrip');
    
    //view Trip for admin
     Route::get('tripview/{id}','AdminController@tripView');
     
    // Trip Spots
    Route::get('/tripspot', 'AdminController@tripSpot');

    // Manage Trip
    Route::prefix('manage-trip')->group(function () {
        // Trip Addon Travelers
        Route::get('/addon-travelers', 'AdminController@tripAddonTravelers');

        Route::get('/get-trip-addons/{trip_id}', 'AdminController@getTripAddons');
        //get Trip travelers
        Route::get('get-trip-travellers-by/{trip_id}/{addon_id}', 'AdminController@getTripTraveler');

        Route::get('/monthly-trip-projection', 'AdminController@monthlyTripProjection');

        Route::get('/setmonthlypaymentdate/{date}/{trip_id}', 'AdminController@setMonthlyPaymentDate');
    });

    // Upload Video
    Route::get('/uploadvideo', 'AdminController@uploadVideo');
    
    //Book Trip for users
    Route::get('/book/{id}', 'HomeController@bookTrip');
	

// traveler profile in admin dashboard	
    Route::match(['get', 'post'], 'view-traveler/{id}', 'AdminController@adminTravelerProfile');
	
	
	Route::match(['get', 'post'], 'users', 'AdminController@registerUser');
	
	Route::match(['get','post'],'user_detail/{id}','AdminController@userDetail');
	
	Route::get('downloadcsv','AdminController@downloadCsv');
	
	
});



/* Admin routes ends */

/* Images routes */

// To fetch the profile images from storage and return it
Route::get('/profile_img/{filename}', function ($filename) {
    $path = storage_path() . '/profile_img' . '/' . $filename;

    if (!File::exists($path))
        abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});



// To fetch the profile images from storage and return it
Route::get('/passport_img/{filename}', function ($filename) {
    $path = storage_path() . '/passport_img' . '/' . $filename;

    if (!File::exists($path))
        abort(404);
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




