@extends('layouts.backend.app')


@section('title', 'Product attributes')


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
                <h1>Add Attributes</h1>
                <small>Customer list</small>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Form controls -->
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonlist">
                                <a class="btn btn-add " href="{{ route('admin.product.index') }}">
                                    <i class="fa fa-list"></i> view products </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('admin.addAttributes',$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Product Name</label> {{$product->name}}
                                 </div>
                                 <div class="form-group">
                                    <label>Product Code</label> {{$product->code}}
                                 </div>
                                 <div class="form-group">
                                    <label>Product Color</label> {{$product->color}}
                                 </div>
                                <div class="form-group">
                                    
                                    <div class="field_wrapper">
                                        <div style="display: flex">
                                            <input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control"style="width: 120px; margin-right:5px;">
                                            <input type="text" name="size[]" id="size" placeholder="SIZE" class="form-control" style="width: 120px; margin-right:5px;">
                                            <input type="text" name="price[]" id="price" placeholder="PRICE" class="form-control" style="width: 120px; margin-right:5px;">
                                            <input type="text" name="stock[]" id="stock" placeholder="STOCK" class="form-control"style="width: 120px; margin-right:5px;">
                                            <a href="javascript:void(0);" class="add_button" title="Add Field">Add</a>
                                          
                                        </div>
                                    </div>
                                </div>
                              
                             
                                <div class="reset-button">
                                    <input type="submit" class="btn btn-success" value="Add Attributes">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
        {{-- view attributes  --}}
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
                                    <a class="btn btn-add" href="{{ route('admin.product.create') }}"> <i
                                            class="fa fa-plus"></i> Add Product
                                    </a>
                                </div>

                            </div>
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="table-responsive">
                               
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <form action="{{ route('admin.editAttributes',$product->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                    <thead>
                                        <tr class="info">
                                            <th>Category ID</th>
                                            <th>SKU</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->attributes as $key => $pro)
                                            <tr>
                                                <td  style="display: none;"><input type="hidden"  name="attr[]" value="{{$pro->id}}">{{$pro->id}}</td>
                                                <td>{{$pro->id}}</td>
                                                <td><input type="text" name="sku[]" value="{{$pro->sku}}" style="text-align:center;"> </td>
                                                <td><input type="text" name="size[]" value="{{$pro->size}}" style="text-align:center;"> </td>
                                                <td><input type="text" name="price[]" value="{{$pro->price}}" style="text-align:center;"> </td>
                                                <td><input type="text" name="stock[]" value="{{$pro->stock}}" style="text-align:center;"> </td>
                                                
                                               
                                                
                                           <td>
                                               <input type="submit" value="update" class="btn btn-success" style="height:30px;padding-top:4px;">
                                           
                                              
                                       <a href="{{route('admin.deleteAttributes',$pro->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </a>
                                          
                                        </td>

                                       </tr>
                                        @endforeach
                                   
                                    </tbody>
                               
                                </table>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection




@push('js')

@endpush