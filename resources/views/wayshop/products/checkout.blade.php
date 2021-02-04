@extends('layouts.frontend.app')

@section('content')

<body>

  <!-- Start Cart  -->
  <div class="contact-box-main">

    <div class="container">
        @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
    <strong>{{ session('flash_message_error') }}</strong>
    </div>
    @endif
    @if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </button>
    <strong>{{ session('flash_message_success') }}</strong>
    </div>
    @endif
    <form action="{{route('user.checkout')}}" method="POST" id="contactForm registerForm"> {{csrf_field()}}
     <div class="row">
         <div class="col-lg-6 col-sm-12">
             <div class="contact-form-right">
                 <h2>Bill To</h2>
              
                     <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control"  value="{{ $userDetails->name }}" placeholder="Billing Name" id="billing_name" name="billing_name" >
                                <div class="help-block with-errors"></div>
                            </div>
 
                        </div>
                        <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control" value="{{ $userDetails->address }}" placeholder="Billing Address" id="billing_address" name="billing_address">
                             <div class="help-block with-errors"></div>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control" value="{{ $userDetails->city }}" placeholder="Billing City" id="billing_city" name="billing_city">
                             <div class="help-block with-errors"></div>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control"  value="{{ $userDetails->state }}"placeholder="Billing State" id="billing_state" name="billing_state">
                             <div class="help-block with-errors"></div>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                           <select name="billing_country" id="billing_country" class="form-control">
                               <option value="1">Select Country</option>
                               @foreach($country as $key => $count)
                                 <option value="{{ $count->country_name }}" {{ $count->country_name == $userDetails->country ? 'selected' : '' }}>{{ $count->country_name }}</option> 
                               @endforeach
                           </select>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control" value="{{ $userDetails->pincode }}" placeholder="Billing Pincode" id="billing_pincode" name="billing_pincode" >
                             <div class="help-block with-errors"></div>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control" value="{{ $userDetails->mobile }}" placeholder="Billing Mobile" id="billing_mobile" name="billing_mobile" >
                             <div class="help-block with-errors"></div>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                        <div class="form-group" style="margin-left:30px;">
                            <input  type="checkbox" class="form-check-input" id="billtoship">
                            <label class="form-check-label" for="billtoship">Shipping Address Same As Billing Address</label>
                        </div>
                    </div> 
                     </div>
                 
             </div>

         </div>
        
         <div class="col-lg-6 col-sm-12">
            <div class="contact-form-right">
                <h2>Ship To</h2>
              
                    <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                               <input type="text" class="form-control" placeholder="Shipping Name" id="shipping_name" name="shipping_name" >
                               <div class="help-block with-errors"></div>
                           </div>

                       </div>
                       <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Shipping Address" id="shipping_address" name="shipping_address" >
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Shipping City" id="shipping_city" name="shipping_city" >
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Shipping State" id="shipping_state" name="shipping_state" >
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <select name="shipping_country" id="shipping_country" class="form-control">
                                <option value="1">Select Country</option>
                                @foreach($country as $key => $count)
                                    <option value="{{ $count->country_name }}" >{{ $count->country_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="shipping_pincode" id="shipping_pincode" name="shipping_pincode">
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="shipping mobile" id="shipping_mobile" name="shipping_mobile" >
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                       
                       <div class="col-md-12">
                           <div class="submit-button text-center">
                               <button class="btn hvr-hover" id="submit" type="submit">Checkout</button>
                               <div id="msgSubmit" class="h3 text-center hidden"></div>
                               <div class="clearfix"></div>
                           </div>

                       </div>
                    </div>
                
            </div>
         </div>
     </div>
    </form>
    </div>

</div>

<!-- End Cart -->

</body>

@endsection
