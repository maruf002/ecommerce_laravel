@extends('layouts.frontend.app')

@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="contact-form-right">
            <h2>Change Password</h2>
            <form action="{{route('changepassword')}}" method="POST" id="contactForm registerForm">
                @csrf
               
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Old Password" id="new_pwd" name="old_password" required data-error="Please Enter Your Password">
                            <div class="help-block with-errors"></div>
                        </div>
 
                    </div>
                   
                   <div class="col-md-12">
                       <div class="form-group">
                           <input type="password" class="form-control" placeholder="New Password" id="new_pwd" name="password" required data-error="Please Enter Your Password">
                           <div class="help-block with-errors"></div>
                       </div>

                   </div>
                   <div class="col-md-12">
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm New Password" id="new_pwd" name="password_confirmation" required data-error="Please Enter Your Password">
                        <div class="help-block with-errors"></div>
                    </div>

                </div>
                   <div class="col-md-12">
                       <div class="submit-button text-center">
                           <button class="btn hvr-hover" id="submit" type="submit">Save</button>
                           <div id="msgSubmit" class="h3 text-center hidden"></div>
                           <div class="clearfix"></div>
                       </div>

                   </div>
                </div>
            </form>
        </div>

    </div>
    <div class="col-md-3"></div>
</div>
</div>
 
@endsection