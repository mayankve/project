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
Route::get('/login', 'HomeController@clientLogin');

// Front-end login
Route::post('/userlogin', 'HomeController@userLogin');

// Front-end logout
Route::get('/logout', 'HomeController@logout');

//User Dashboard
Route::get('/dashboard','HomeController@userDashboard');

// To update user basic information
Route::post('/updateuserbasicinfo', 'HomeController@updateUserBasicInfo');

// To update user basic information
Route::post('/updateuserprofileinfo', 'HomeController@updateUserProfileInfo');



/* Front-end routes ends */


/* Admin routes */

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
	
	// Dashboard page	
	Route::get('/dashboard','AdminController@dashboard');

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

