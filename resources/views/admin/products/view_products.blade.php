@extends('layouts.backend.app')

@section('title', 'dashboard')

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
                  <h1>View Products</h1>
                  <small>Products List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>View Products</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="{{route('admin.product.create')}}"> <i class="fa fa-plus"></i> Add Product
                                 </a>  
                              </div>
                             
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="table_id" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>Product ID</th>
                                       <th>Product Name</th>
                                       <th>Product code</th>
                                       <th>Product Color</th>
                                       <th>Image</th>
                                       <th>Price</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
                                   @foreach($products as $key => $pro)
                                      <tr>
                                      <td>{{$pro->id}}</td>
                                         <td>{{$pro->name}}</td>
                                         <td>{{$pro->code}}</td>
                                         <td>{{$pro->color}}</td>
                                      <td>
                                       <img src="{{Storage::disk('public')->url('product/'.$pro->image)}}" alt="" style="width:100px;">
                                       </td>
                                       <td><span>bdt.</span>{{$pro->price}}</td>
                                       <td>
                                          <input type="checkbox" class="ProductStatus btn btn-success" rel="{{$pro->id}}"
                               data-toggle="toggle" data-on="Enabled" data-of="Disabled" data-onstyle="success" data-offstyle="danger"
                               @if($pro['status']=="1") checked @endif>
                               <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>

                                       </td>
                                       <td>
                                          <a href="{{route('admin.product.edit',$pro->id)}}" class="btn btn-add btn-sm" title="Edit Product"><i class="fa fa-pencil"></i></a>
                                            
                                         <button class="btn btn-danger waves-effect" type="button" onclick="deleteproduct({{$pro->id}})" >
                                           <i class="material-icons">delete</i>
                                         </button> 
                                         <form id="delete-form-{{$pro->id}}" action="{{ route('admin.product.destroy',$pro->id) }}" method="POST" style="display: none;">
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
    function deleteproduct(id) {
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
                document.getElementById('delete-form-'+id).submit();
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