<?php

namespace App\Http\Controllers;

use App\User;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{
    public function account(){
        return view('wayshop.users.account');
    }
    public function changepassword(Request $request){
      

       
          
        if($request->isMethod('post')){
            
            $this->validate($request,[
                'old_password' => 'required',
                'password'     => 'required|confirmed',
             ]);
          
            $hashedpassword = Auth::user()->password;
            if(Hash::check($request->old_password, $hashedpassword)){
                 if(!Hash::check($request->password, $hashedpassword)){
                    
                    $user = User::find(Auth::id());
                    $user->password = Hash::make($request->password);
                     $user->save();
                     Toastr::success('Password Successfully Changed','Success');
                     Auth::logout();
                    return redirect()->back();
    
                }else{
                    Toastr::error('New password can not be the same as old password.','Error');
                    return redirect()->back();
                }
            }else{
            Toastr::error('Current password not match.','Error');
                return redirect()->back();
             }
        }

        return view('wayshop.users.change_password');
    }
   
}
