<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class WishlistController extends Controller
{
    public function Addwishlist($id){
    	$userid=Auth::id();
    	$check = DB::table('wishlists')->where('user_id',$userid)->where('product_id',$id)->first();
    	$data = array(
    		'user_id'=>$userid,
    		'product_id'=>$id
    	);

        if (Auth::check()) {
        	if ($check) {
        		$notification=array(
                        'messege'=>'All ready your wishlists',
                        'alert-type'=>'error'
                         );
                       return Redirect()->back()->with($notification);
        	}else{
        		DB::table('wishlists')->insert($data);
        		$notification=array(
                        'messege'=>'Add to your wishlists',
                        'alert-type'=>'success'
                         );
        		 return Redirect()->back()->with($notification);
        	}

        }else{
        	 $notification=array(
                        'messege'=>'At first login your account',
                        'alert-type'=>'warning'
                         );
                       return Redirect()->back()->with($notification);
        }
        
      
    }
}
