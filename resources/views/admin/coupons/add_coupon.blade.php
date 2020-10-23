@extends('layouts.backend.app')


@section('title', 'Add-Product')


    @push('css')

    @endpush


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="header-title">
                <h1>Add Coupon</h1>
                <small>Add Coupon</small>
            </div>
        </section>

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
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Form controls -->
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonlist">
                                <a class="btn btn-add " href="clist.html">
                                    <i class="fa fa-eye"></i> View Coupons </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('admin.addCoupon') }}" method="Post" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="form-group">
                                    <label>Coupon Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Product Name"
                                        name="coupon_code" id="coupon_code">
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Product code"
                                        name="amount" id="amount">
                                </div>
                                <div class="form-group">
                                    <label>Amount Type</label>
                                    <select name="amount_type" id="amount_type"  class="form-control">
                                        <option value="Percentage">Percentage</option>
                                        <option value="Fixed">Fixed</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <input type="text" class="form-control" name="expiry_date" id="datepicker" required>
                                   
                                </div>
                            
                                <div class="reset-button">
                                    <input type="submit" class="btn btn-success" value="Add coupon">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection




@push('js')

@endpush