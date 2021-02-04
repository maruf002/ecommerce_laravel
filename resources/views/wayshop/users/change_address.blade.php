@extends('layouts.frontend.app')

@section('content')
<div class="col-lg-4 offset-lg-4 col-sm-12">
    <div class="contact-form-right">
        <h2>update account info <br><br></h2>
        <form action="{{route('changeAddress')}}" method="POST" id="contactForm registerForm"> {{csrf_field()}}
            <div class="row">
               <div class="col-md-12">
                   <div class="form-group">
                       <input type="text" class="form-control"  value="{{ $user->name }}" placeholder=" Name" id="billing_name" name="name">
                       <div class="help-block with-errors"></div>
                   </div>

               </div>
               <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control"  value="{{ $user->address }}" placeholder=" Address" id="billing_name" name="address">
                    <div class="help-block with-errors"></div>
                </div>

            </div>
               <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $user->city }}" placeholder=" City" id="billing_name" name="city">
                    <div class="help-block with-errors"></div>
                </div>

            </div>
         
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $user->state }}" placeholder="State" id="billing_name" name="state">
                    <div class="help-block with-errors"></div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="form-group">
                   <Select name="country" id="country" class="form-control">
                       <option value="1">Select Country</option>
                       @foreach($country as $key => $count)
                       <option value="{{ $count->country_name }} " {{ $count->country_name == $user->country ? 'selected' : ''}} >{{ $count->country_name }}</option>
                       @endforeach

                       
                   </Select>
                </div>

            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $user->pincode }}" placeholder="Pincode" id="billing_name" name="pincode">
                    <div class="help-block with-errors"></div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $user->mobile }}" placeholder="Mobile No." id="billing_name" name="mobile" >
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
        
    </div>

</div>
 
@endsection