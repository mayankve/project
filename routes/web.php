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

/* Front-end routes ends */


/* Admin routes */

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
	
	// Dashboard page	
	Route::get('/dashboard','AdminController@dashboard');

});

/* Admin routes ends */


/* ACL routes */
Route::get('/addUser', 'ACLController@addUser');
Route::get('/addRole', 'ACLController@addRole');
Route::get('/assignRole', 'ACLController@assignRole');
/* ACL routes ends */

