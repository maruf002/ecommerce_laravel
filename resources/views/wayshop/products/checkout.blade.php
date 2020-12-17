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
     <div class="row">
         <div class="col-lg-6 col-sm-12">
             <div class="contact-form-right">
                 <h2>Bill To</h2>
                 <form action="{{url('/user-register')}}" method="POST" id="contactForm registerForm"> {{csrf_field()}}
                     <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Billing Name" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                                <div class="help-block with-errors"></div>
                            </div>
 
                        </div>
                        <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control" placeholder="Billing Address" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                             <div class="help-block with-errors"></div>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control" placeholder="Billing City" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                             <div class="help-block with-errors"></div>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control" placeholder="Billing State" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                             <div class="help-block with-errors"></div>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control" placeholder="Billing Country" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                             <div class="help-block with-errors"></div>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control" placeholder="Billing Pincode" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                             <div class="help-block with-errors"></div>
                         </div>
 
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="text" class="form-control" placeholder="Billing Mobile" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
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
                               <input type="text" class="form-control" placeholder="Shipping Name" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                               <div class="help-block with-errors"></div>
                           </div>

                       </div>
                       <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Shipping Address" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Shipping City" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Shipping State" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Shipping Country" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Billing Pincode" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Billing Mobile" id="billing_name" name="billing_name" required data-error="Please Enter Your Email">
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
