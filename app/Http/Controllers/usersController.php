<?php

namespace App\Http\Controllers;

use App\Cart;
use Session;
use App\User;
use App\Country;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;


class usersController extends Controller
{

    public function userLoginRegister()
    {
        return view('wayshop.users.login_register');
    }
    public function register(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            $userCount = User::where('email', $data['email'])->count();
            if ($userCount > 0) {
                return redirect()->back()->with('flash_message_error', 'Email is already exist');
            } else {
                //adding user in table
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();
                //confirmation email 
                $email = $data['email'];
                $messageData = ['email' => $data['email'], 'name' => $data['name'], 'code' => base64_encode($data['email'])];
                Mail::send('wayshop.email.confirm', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Account Activation For Wayshop');
                });

                return redirect()->back()->with('flash_message_error', 'Please Confirm Your Email To Activate Your Account !');

                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    Session::put('frontSession', $data['email']);
                    if (!empty(Session::get('session_id'))) {
                        $session_id = Session::get('session_id');
                        DB::table('cart')->where('session_id', $session_id)->update((['email' => $data['email']]));
                    }
                    return redirect('/cart');
                }
            }
        }
    }
    public function login(Request $request){
        if($request->isMethod('post')){
             $data = $request->all();
         //    echo "<pre>";print_r($data);die;
         if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
             $userStatus = User::where(['email'=>$data['email']])->first();
             if($userStatus->status == 0){
                 return redirect()->back()->with('flash_message_error','Your Account is not activated ! Please confirm your email to activate your account.');
             }

             Session::put('frontSession',$data['email']);
             if(!empty(Session::get('session_id'))){
                 $session_id = Session::get('session_id');
              
                //  DB::table('carts'->where('session_id',$session_id))->update(['user_email'=>$data['email']]);
                Cart::where('session_id',$session_id)->update(['user_email'=>$data['email']]);
             }
             return redirect('/cart');
         }else{
             return redirect()->back()->with('flash_message_error','Invalid username and password!');
         }
        }
    }
    public function confirmAccount($email)
    {
        $email = base64_decode($email);
        $userCount =  User::where('email', $email)->count();
        if($userCount>0){
            $userDetails = User::where(['email'=>$email])->first();
            if($userDetails->status ==1){
                return redirect('login-register')->with('flash_message_error','Your Account is already activated. You can simply login now.');
            }else{

                User::where(['email'=>$email])->update(['status'=>1]);
               //Send Welcome to Users
               $messageData = ['email'=>$email,'name'=>$userDetails->name];
               Mail::send('wayshop.email.welcome',$messageData,function($message) use($email){
                 $message->to($email)->subject('Welcome To Wayshop Website');
               });

               return redirect('login-register')->with('flash_message_success','Congrats! Your Account is now Activated');
        }
    }else{
        abort(404);
    }

}

    public function account()
    {
        return view('wayshop.users.account');
    }
   public function changepassword(Request $request)
    {

    if ($request->isMethod('post')) {

            $this->validate($request, [
                'old_password' => 'required',
                'password'     => 'required|confirmed',
            ]);

            $hashedpassword = Auth::user()->password;
            if (Hash::check($request->old_password, $hashedpassword)) {
                if (!Hash::check($request->password, $hashedpassword)) {

                    $user = User::find(Auth::id());
                    $user->password = Hash::make($request->password);
                    $user->save();
                    Toastr::success('Password Successfully Changed', 'Success');
                    Auth::logout();
                    return redirect()->back();
                } else {
                    Toastr::error('New password can not be the same as old password.', 'Error');
                    return redirect()->back();
                }
            } else {
                Toastr::error('Current password not match.', 'Error');
                return redirect()->back();
            }
        }

        return view('wayshop.users.change_password');
    }

    public function changeAddress(Request $request)
    {

        $user = User::find(Auth::id());
        if ($request->isMethod('post')) {
            $user->name = $request->name;
            $user->city = $request->city;
            $user->address = $request->address;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->pincode = $request->pincode;
            $user->mobile = $request->mobile;
            $user->save();
            Toastr::success('address Changed', 'Success');
            return redirect()->back();
        }
        $country = Country::get();
        return view('wayshop.users.change_address', compact('user', 'country'));
    }
}
