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
                            <form action="{{ route('admin.addAltimg',$product->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <label>Images</label>
                                    <input type="file" name="image" id="image" >
                                </div>

                                <div class="reset-button" >
                                    <input type="submit" class="btn btn-success" value="Add image" >
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
                                            <th> ID</th>
                                            <th>Product ID</th>
                                            <th>Image</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($altimage as $key => $alt)
                                            <tr >
                                            <td style="text-align:center;">{{ $alt->id }}</td> 
                                            <td style="text-align:center;">{{ $alt->product_id }}</td> 
                                            <td align="center" >
                                               <img src="{{ Storage::disk('public')->url('alterimage/'.$alt->image) }}" alt="" style="width: 80px; " > 
                                            </td> 
                                                
                                                   
                                           <td>
                                                {{--  <input type="submit" value="update" class="btn btn-success" style="height:30px;padding-top:4px;">  --}}
                                           
                                              
                                       <a href="{{route('admin.deletealtimg',$alt->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </a>  
                                          
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