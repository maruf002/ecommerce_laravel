@extends('layouts.frontend.app')

@section('content')

<body>

  <!-- Start Cart  -->
  <div class="cart-box-main">
    @if(Session::has('flash_message_error'))
    <div class="alert alert-sm alert-danger alert-block" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
       <strong>{!! session('flash_message_error') !!}</strong>
    </div>
    @endif
    
    @if(Session::has('flash_message_success'))
    <div class="alert alert-sm alert-success alert-block" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
       </button>
       <strong>{!! session('flash_message_success') !!}</strong>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_amount = 0; ?>
                         @foreach($userCart as $key => $cart)
                             
                        
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="#">
                              
                        

                         <img class="img-fluid" src="{{ Storage::disk('public')->url('product/'.$cart->img) }}" alt="" />  
                         
                              
                              
                            </a>
                                </td>
                                <td class="name-pr">
                                   
                               {{$cart->product_name}}
                               <p>Code: {{ $cart->product_code }} | Size: {{ $cart->size }}</p>
                            </a>
                                </td>
                                <td class="price-pr">
                                   {{$cart->price}}

                                </td>
                                <td class="quantity-box">
                                  
                                    
                                    <a href="{{url('user/updateCart/'.$cart->id.'/1')}}" style="font-size:25px;"><strong>+</strong></a>
                                    <input type="number" size="4" value="{{ $cart->quantity }}" min="0" step="1" class="c-input-text qty text">
                                    @if($cart->quantity>0)
                                    <a href="{{ url('user/updateCart/'.$cart->id.'/-1') }}" style="font-size:25px;"><strong>-</strong></a> 
                                    
                                    @endif
                                </td>
                                <td class="total-pr">
                                  <p>Bdt. {{ $cart->price*$cart->quantity }}</p>
                                </td>
                                <td class="remove-pr">
                                    <a href="{{ route('user.deleteCart',$cart->id) }}">
                                      <i class="fas fa-times"></i>
                                   </a>
                                </td>
                            </tr>
                            <?php  $total_amount= $total_amount+($cart->price*$cart->quantity); ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
        <div class="row my-5">
            <form action="{{ route('user.applyCoupon') }}" method="POST">
                @csrf
            <div class="col-lg-6 col-sm-6">
               
                <div class="coupon-box">
                    <form  action="route('user.applyCoupon')" method="POST">
                        @csrf
                    <div class="input-group input-group-sm">
                        <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" name="coupon_code" type="text">
                        <div class="input-group-append">
                            <button class="btn btn-theme" type="submit">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                </div>
            
            </div>
      
            <div class="col-lg-6 col-sm-6">
                <div class="update-box">
                    <input value="Update Cart" type="submit">
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12">
                <div class="order-box">
                    <h3>Order summary</h3>
                    @if(!empty(Session::get('CouponAmount')))
                    <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold">BDT.<?php echo $total_amount; ?></div>
                    </div>
                    <div class="d-flex">
                        <h4>Coupon Discount</h4>
                        <div class="ml-auto font-weight-bold">BDT. <?php echo session::get('CouponAmount');?> </div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex">
                        <h4>Grand Total</h4>
                        <div class="ml-auto font-weight-bold">BDT. <?php echo $total_amount - session::get('CouponAmount');?> </div>
                    </div>
                   
                    <hr>
                    @else
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5"> BDT.<?php echo $total_amount; ?></div>
                    </div>
                     @endif 
                    <hr> </div>
            </div>
            <div class="col-12 d-flex shopping-box"><a href="{{ route('user.checkout') }}" class="ml-auto btn hvr-hover">Checkout</a> </div>
        </div>

    </div>
</div>
<!-- End Cart -->

</body>

@endsection
