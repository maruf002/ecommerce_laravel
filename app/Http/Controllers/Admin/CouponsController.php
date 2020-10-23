<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function Coupon(){
        return view('admin.coupons.add_coupon');
    }

    public function addCoupon(Request $request){
       $this->validate($request,[
          'coupon_code'=>'required',
          'amount'=>'required',
          'amount_type'=>'required',
          'expiry_date'=>'required',
        
          
       ]);

       $coupon = new Coupon();
       $coupon->coupon_code=$request->coupon_code;
       $coupon->amount=$request->amount;
       $coupon->amount_type=$request->amount_type;
       $coupon->expiry_date=$request->expiry_date;
       $coupon->save();
    //    return redirect->route('/admin/view-coupons')->with('flash_message_success','Coupon has been Updated Successfully');
     
    }

    public function viewCoupon(){
     $coupon= Coupon::latest()->get();
        return view('admin.coupons.view_coupon',compact('coupon'));
    }
    public function couponStatus($id,$status){
        $coupon=Coupon::find($id);
        $coupon->status=$status;
        $coupon->save();


    }

    public function editCoupon($id){
    $coupon=Coupon::find($id);
    return view('admin.coupons.edit_coupon',compact('coupon'));
    }

    public function updateCoupon (Request $request , $id){
        $this->validate($request,[
            'coupon_code'=>'required',
            'amount'=>'required',
            'amount_type'=>'required',
            'expiry_date'=>'required',
          
            
         ]);
         $coupon = Coupon::find($id);
         $coupon->coupon_code=$request->coupon_code;
         $coupon->amount=$request->amount;
         $coupon->amount_type=$request->amount_type;
         $coupon->expiry_date=$request->expiry_date;
         $coupon->save();
         return redirect()->route('admin.viewCoupon')->with('flash_message_success','Coupon has been Updated Successfully');
    }

    public function deleteCoupon($id){
        Coupon::find($id)->delete();
        return redirect()->route('admin.viewCoupon')->with('flash_message_error','Coupon has been deleted Successfully');
        
    }
}
