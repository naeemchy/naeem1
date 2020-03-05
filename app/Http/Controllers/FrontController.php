<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FrontController extends Controller
{
    public function store_newslater(Request $request)
    {
      		$data=array();
        	$data['email'] = $request->email;
         	DB::table('newslater')->insert($data);

  			$notification=array(
                        'messege'=>'Thanks for subscribing!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
    }
}
