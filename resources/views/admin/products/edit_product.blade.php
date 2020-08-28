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
          <h1>Add Customer</h1>
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
                      <a class="btn btn-add " href="clist.html"> 
                      <i class="fa fa-list"></i>  Customer List </a>  
                   </div>
                </div>
                <div class="panel-body">
                   <form action="{{route('admin.product.update',$product->id)}}" method="Post" enctype="multipart/form-data">
                     @csrf
                     @method('put')
                      <div class="form-group">
                         <label>Product Name</label>
                      <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="{{$product->name}}"   >
                      </div>
                      <div class="form-group">
                         <label>Product Code</label>
                         <input type="text" class="form-control" placeholder="Enter Product code" name="product_code" value="{{$product->code}}"  >
                      </div>
                      <div class="form-group">
                         <label>Product Color</label>
                         <input type="text" class="form-control" placeholder="Enter Product color" name="product_color" value="{{$product->color}}" >
                      </div>
                      <div class="form-group">
                         <label>Product Description</label>
                         <textarea name="product_description" id="product_description"  class="form-control" >
                           {{$product->description}}
                         </textarea>
                      </div>
                     
                      <div class="form-group">
                        <label>Product Price</label>
                        <input type="text" class="form-control" placeholder="Enter Product code" name="product_price" value="{{$product->price}}" >
                     </div>
                      <div class="form-group">
                        <label>Picture Upload</label>
                       <input type="file" name="image">
                     </div>
                     <div class="reset-button">
                        <input type="submit" class="btn btn-success" value="Add Product" >
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