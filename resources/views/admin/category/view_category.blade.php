@extends('layouts.backend.app')

@section('title', 'Categories')

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
                <h1>View Category</h1>
                <small>Category List</small>
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
                                    <h4>View Category</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="btn-group">
                                <div class="buttonexport" id="buttonlist">
                                    <a class="btn btn-add" href="{{ route('admin.category.create') }}"> <i
                                            class="fa fa-plus"></i> Add Category
                                    </a>
                                </div>

                            </div>
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="info">
                                           <th>ID</th>
                                           <th>Category Name</th>
                                           <th>Parent ID</th>
                                           <th>Url</th>
                                           <th>Status</th>
                                           <th>Action</th>
                                        </tr>
                                     </thead>
                                    <tbody>
                                        @foreach ($category as $key => $cat)
                                            <tr>
                                                <td>{{ $cat->id }}</td>
                                                <td>{{ $cat->name }}</td>
                                                <td>{{ $cat->parent_id }}</td>
                                                <td>{{ $cat->slug }}</td>
                                                <td>
                                                    <input type="checkbox" class=" btn btn-success" id="catstatus"
                                                        data-id="{{ $cat->id }}" data-toggle="toggle" data-on="Enable"
                                                        data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                                      {{$cat->status ==1 ?'checked' : ''}}>
                                        <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled
                                        </div>

                                        </td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', $cat->id) }}" class="btn btn-add btn-sm"
                                                title="Edit Product"><i class="fa fa-pencil"></i></a>

                                            <button class="btn btn-danger waves-effect" type="button"
                                                onclick="deleteCategory({{ $cat->id }})">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <form id="delete-form-{{ $cat->id }}"
                                                action="{{ route('admin.category.destroy', $cat->id) }}" method="POST"
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
        function deleteCategory(id) {
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
