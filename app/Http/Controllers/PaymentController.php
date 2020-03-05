<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Cart;
class PaymentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function payment(Request $request)
    {
    	 $data=array();
    	 $data['name']=$request->name;
    	 $data['email']=$request->email;
    	 $data['phone']=$request->phone;
    	 $data['address']=$request->address;
    	 $data['city']=$request->city;
    	 $data['payment']=$request->payment;

    	 if ($request->payment == 'stripe') {

    	 	  //stripe payment pages
    	 	 return view('pages.payment.stripe',compact('data'));
    	 
    	 }elseif($request->payment == 'paypal'){

    	 }elseif($request->payment == 'ideal'){

    	 }else{
    	 	echo"handcash";
    	 }
    }
}
