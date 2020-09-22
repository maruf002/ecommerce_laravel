@extends('layouts.backend.app')


@section('title', 'Edit-Banner')


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
          <h1>edit Banner</h1>
          <small>Banner</small>
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
                      <a class="btn btn-add " href="{{ route('admin.banner.index') }}"> 
                      <i class="fa fa-eye"></i>   edit Banners </a>  
                   </div>
                </div>
                <div class="panel-body">
                   <form action="{{route('admin.banner.update',$banner->id)}}" method="Post" enctype="multipart/form-data">
                     @csrf
                     @method('put')
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control"  value="{{$banner->name}}"  placeholder="Enter Name" name="banner_name" id="banner_name" required>
                     </div>
                     <div class="form-group">
                        <label>Text Style</label>
                        <input type="text" class="form-control" value="{{$banner->text_style}}"  placeholder="Text Style" name="text_style" id="text_style" required>
                     </div>
                     <div class="form-group">
                           <label>Content</label>
                           <textarea class="form-control"  name="banner_content" id="banner_content">
                          {{  $banner->content}}
                           </textarea>
                       </div>
                       <div class="form-group">
                           <label>Link</label>
                           <input type="text" class="form-control" value="{{$banner->link}}" placeholder="Link" name="link" id="link" required>
                       </div>
                       <div class="form-group">
                               <label>Sort Order</label>
                               <input type="text" class="form-control" value="{{$banner->sort_order}}" placeholder="Sort Order" name="sort_order" id="sort_order" required>
                           </div>
                     <div class="form-group">
                        <label>Banner Image</label>
                        <input type="file" name="image">
                     </div>
                     <div class="reset-button">
                        <input type="submit" class="btn btn-success" value="Edit Banner">
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