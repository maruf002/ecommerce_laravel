<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Coupon;
use App\Product;
use App\ProductsAttributes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


 use Session;

class ProductsController extends Controller
{
     public function productdetails($id){
        $productDetails=Product::where('id',$id)->first();
        $featureProducts=Product::where('featured_products',1)->get();
        return view('wayshop.product_details',compact('productDetails','featureProducts'));
      
    }
    public function getprice(Request $request ){
      
      $data = $request->all();
        //  echo "<pre>";print_r($data);die;
       $proArr = explode("-",$data['idSize']);
       
        $proAttr = ProductsAttributes::where(['id'=>$proArr[0],'size'=>$proArr[1]])->first();
      
        echo $proAttr->price;

    }

    public function addtoCart(Request $request){
      Session::forget('couponAmount');
       Session::forget('couponCode');
    

      $sizeArr=explode('-',$request->size);
       //Prevent duplicate Size Record
       $countProduct= cart::where(['product_id'=>$request->product_id,'product_color'=>$request->product_color,
       'price'=>$request->price,'size'=>$sizeArr[1],'session_id'=>Auth::id()])->count();
       if($countProduct>0){
       
        return redirect()->route('cart')->with('flash_message_error','Product already exists in cart');
       }else{
      $cart= new Cart();
      $cart->product_name=$request->product_name;
      $cart->product_id=$request->product_id;
      $cart->product_code=$request->product_code;
      $cart->product_color=$request->product_color;
      $cart->price=$request->price;
      $cart->size=$sizeArr[1];
      $cart->quantity=$request->quantity;
      $cart->session_id=Auth::id();
      $cart->user_email=Auth::user()->email;
      $cart->save();
     } 
      return redirect()->route('cart')->with('flash_message_success','Product added successfully');

    }

    public function cart(){
      
     $session_id=Auth::id();
      $userCart= Cart::where('session_id',$session_id)->get();
     
      foreach ($userCart as $key => $pro) {
       $productDetails = Product::where(['id'=>$pro->product_id])->first();
       $userCart[$key]->img= $productDetails->image;
      }

      return view('wayshop.products.cart',compact('userCart'));
    }

    public function deleteCart($id){
      Session::forget('couponAmount');
      Session::forget('couponCode');

       Cart::find($id)->delete();
   
       return redirect()->route('cart')->with('flash_message_success','Product has been deleted!');
     
    }

    public function updateCart($id,$quantity){
      Session::forget('CouponAmount');
      Session::forget('CouponCode');
    $cart= Cart::where('id',$id)->increment('quantity',$quantity);
   
    return redirect()->route('cart')->with('flash_message_success','Product Quantity has been updated Successfully');
   }

   public function applyCoupon(Request $request){
      // Session::forget('couponAmount');
      // Session::forget('couponCode');
   
     $data = $request->all();
    //  echo "<pre>";print_r($data);die;
   
     $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
     if($couponCount == 0){
       return redirect()->back()->with('flash_message_error','Coupon code does not exists');
     }else{
       
       $coupon=Coupon::where('coupon_code',$data['coupon_code'])->first();
       //Coupon code status
      if($coupon->status==0){
        return redirect()->back()->with('flash_message_error','Coupon code is not active');
      }

      //Check coupon expiry date
       $expirty_date=$coupon->expiry_date;
        $current_date=date('Y-m-d');
        if($expirty_date<$current_date){
          return redirect()->back()->with('flash_message_error','Coupon Code is Expired'); 
        }

            //Coupon is ready for discount
            $userCart = Cart::where('session_id',Auth::id())->get();
             $total_amount=0;
            foreach ($userCart as $key => $item) {
             $total_amount = $total_amount + ($item->price*$item->quantity);
            //  echo "<pre>";print_r($total_amount);
            }
           //Check if coupon amount is fixed or percentage
           if($coupon->amount_type=="Fixed") {
            $couponAmount = $coupon->amount;
            // echo "<pre>";print_r($couponAmount);
           }else{
          $couponAmount=$total_amount*($coupon->amount/100);
           
           }
                // Add Coupon code in session
                 Session::put('CouponAmount',$couponAmount);
                 Session::put('CouponCode',$data['coupon_code']);    
            return redirect()->back()->with('flash_message_success','Coupon Code is Successffully Applied.You are Availing Discount');
     }
   }

    
}
