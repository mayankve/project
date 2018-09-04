<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;

class PaypalController extends Controller
{
   
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function PaymentSuccess()
    {
		
		
        return redirect('dashboard')
		->with('success','Detail are successfully update...');
    }
	
	public function paymentCancel()
    {
		echo 'your transction is cancelled now please try ';die;
		
		
        //return view('paywithpaypal');
    }
    
	
	
	
	
	
  }