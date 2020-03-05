<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon()
    {
        $coupon = DB::table('coupons')->get();
        return view('admin.coupon.coupon',compact('coupon'));
    }

     public function storecoupon(Request $request)
    {
      		$data=array();
        	$data['coupon'] = $request->coupon;
        	$data['discount'] = $request->discount;
         	DB::table('coupons')->insert($data);

  			$notification=array(
                        'messege'=>'Coupon Insert Done!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
    }
    public function Deletecoupon($id)
    {
        DB::table('coupons')->where('id',$id)->delete();
        $notification=array(
                        'messege'=>'Coupons Deleted Done!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
    }
    public function Editcoupon($id)
    {
        $coupons = DB::table('coupons')->where('id',$id)->first();
        return view('admin.coupon.edit_coupon',compact('coupons'));
    }
    public function Updatecoupon(Request $request,$id){
    		$data=array();
        	$data['coupon'] = $request->coupon;
        	$data['discount'] = $request->discount;
         	DB::table('coupons')->where('id',$id)->update($data);

  			$notification=array(
                        'messege'=>'Coupon Updated Done!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('admin.coupon')->with($notification);
    }

    public function newslater()
    {
        $newslater = DB::table('newslater')->get();
        return view('admin.coupon.newslater',compact('newslater'));
    }
    public function Deletesub($id)
    {
        DB::table('newslater')->where('id',$id)->delete();
        $notification=array(
                        'messege'=>'Subscriber Deleted Done!',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
    }
}
