@extends('layouts.backend.app')

@section('title', 'Coupon')

    @push('css')

    @endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-gift"></i>
            </div>
            <div class="header-title">
                <h1>Coupons</h1>
                <small>Coupons</small>
            </div>
        </section>
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

       <div id="message_success" style="display:none;" class="alert alert-sm alert-success">Status Enabled</div>
    <div id="message_error" style="display:none;" class="alert alert-sm alert-danger">Status Disabled</div> 
  
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4> Coupons</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="btn-group">
                                <div class="buttonexport" id="buttonlist">
                                    <a class="btn btn-add" href="{{ route('admin.Coupon') }}"> <i
                                            class="fa fa-gift"></i> Add Coupon
                                    </a>
                                </div>

                            </div>
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="info">
                                            <th>Coupon ID</th>
                                            <th>Coupon Code</th>
                                            <th>Amount</th>
                                            <th>Amount Type</th>
                                            <th>Expiry Date</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupon as $key => $cop)
                                            <tr>
                                                <td>{{ $cop->id }}</td>
                                                <td>{{ $cop->coupon_code }}</td>
                                                <td>{{ $cop->amount }}</td>
                                                <td>{{ $cop->amount_type }}</td>
                                                <td>{{ $cop->expiry_date }}</td>
                                                <td>{{ $cop->created_at }}</td>
                                     
                                               
                                               
                                                <td>
                                                    <input type="checkbox" class=" btn btn-success" id="couponStatus"
                                                        data-id="{{ $cop->id }}" data-toggle="toggle" data-on="Enable"
                                                        data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                                      {{$cop->status ==1 ?'checked' : ''}}>
                                        <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled
                                        </div>

                                        </td>
                                        <td>
                                            <a href="{{ route('admin.editCoupon', $cop->id) }}" class="btn btn-add btn-sm"
                                                title="Edit Coupon"><i class="fa fa-pencil"></i></a>

                                            <button class="btn btn-danger waves-effect" type="button"
                                                onclick="deleteCoupon({{ $cop->id }})">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <form id="delete-form-{{ $cop->id }}"
                                                action="{{ route('admin.deleteCoupon', $cop->id) }}" method="get"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td> 


                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection



@push('js')
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <script type="text/javascript">
        function deleteCoupon(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

    </script>
@endpush
