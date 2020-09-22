@extends('layouts.backend.app')

@section('title', 'banner')

    @push('css')

    @endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-product-hunt"></i>
            </div>
            <div class="header-title">
                <h1>Banners</h1>
                <small>Banners</small>
            </div>
        </section>
        <!-- Main content -->
        {{-- <div id="message_success" style="display:none;" class="alert alert-sm alert-success">Status Enabled</div>
    <div id="message_error" style="display:none;" class="alert alert-sm alert-danger">Status Disabled</div> --}}
  
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>View Banners</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="btn-group">
                                <div class="buttonexport" id="buttonlist">
                                    <a class="btn btn-add" href="{{ route('admin.banner.create') }}"> <i
                                            class="fa fa-plus"></i> Add Banners
                                    </a>
                                </div>

                            </div>
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="info">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Sort Order</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banner as $key => $ban)
                                            <tr>
                                                <td>{{ $ban->id }}</td>
                                                <td>{{ $ban->name }}</td>
                                                <td>{{ $ban->sort_order }}</td>
                                                <td>
                                                    <img src="{{ Storage::disk('public')->url('banner/' . $ban->image) }}"
                                                        alt="" style="width:100px;" >
                                                       
                                                </td>
                                               
                                                <td>
                                                    <input type="checkbox" class=" btn btn-success" id="bannerstatus"
                                                        data-id="{{ $ban->id }}" data-toggle="toggle" data-on="Enable"
                                                        data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                                      {{$ban->status ==1 ?'checked' : ''}}>
                                        <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled
                                        </div>

                                        </td>
                                        <td>
                                            <a href="{{ route('admin.banner.edit', $ban->id) }}" class="btn btn-add btn-sm"
                                                title="Edit banner"><i class="fa fa-pencil"></i></a>

                                            <button class="btn btn-danger waves-effect" type="button"
                                                onclick="deletebanner({{ $ban->id }})">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <form id="delete-form-{{ $ban->id }}"
                                                action="{{ route('admin.banner.destroy', $ban->id) }}" method="POST"
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
        function deletebanner(id) {
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
