<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class AdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            
            $adminCount = Admin::where(['username'=>$data['username'], 'password'=>md5($data['password']),'status'=>1])->count();

            if($adminCount>0){
                Session::put('adminSession',$data['username']);
                return view('admin.dashboard');
            }else{
                // $admin = new Admin;
                // $admin->username = $data['username'];
                // $admin->password = md5($data['password']);
                // $admin->username = $data['username'];
                // $admin->status  = 1;
                // $admin->save();
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
            }
        }

        return view('admin.admin_login');
    }
}
