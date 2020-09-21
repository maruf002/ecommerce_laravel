@extends('layouts.backend.app')


@section('title', 'Edit-Category')


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
          <h1>edit Category</h1>
          <small>category list</small>
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
                      <i class="fa fa-list"></i>  Category List </a>  
                   </div>
                </div>
                <div class="panel-body">
                   <form action="{{route('admin.category.update',$category->id)}}" method="Post">
                     @csrf
                     @method('put')
                     <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" id="category_name" value="{{ $category->name }}" required>
                     </div>
                     <div class="form-group">
                        <label>Parent Category</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="0">Parent Category</option>
                            @foreach($levels  as $val)
                        <option value="{{$val->id}}" @if($val->id == $category->parent_id) ? selected : "selected" @endif >{{$val->name}}</option>
                            @endforeach
                        </select>
                     </div>
                     
                     <div class="form-group">
                        <label>Description</label>
                        <textarea name="category_description" id="category_description" class="form-control">
                           {{ $category->description}}
                        </textarea>
                     </div>
                     <div class="reset-button">
                        <input type="submit" class="btn btn-success" value="Update Category">
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