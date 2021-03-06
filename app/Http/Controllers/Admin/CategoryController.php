<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->get();
        return view('admin.category.view_category',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Category::where('parent_id',0)->get();
        return view('admin.category.add_category', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'category_name'=>'required',
            'parent_id'=>'required',     
            'category_description'=>'required',     
          ]);
       
          $category = new Category();
          $category->name = $request->category_name;
          $category->parent_id = $request->parent_id;
          $category->slug = str_slug($request->category_name);
          $category->description = $request->category_description;
          $category->save();
          Toastr::success('Category added successfully','Success');
          return redirect()->route('admin.category.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category= Category::find($id);
        $levels = Category::where('parent_id',0)->get();
        return view('admin.category.edit_category',compact('category','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'category_name'=>'required',
            'parent_id'=>'required',     
            'category_description'=>'required',     
          ]);
          $category = Category::find($id);
          $category->name = $request->category_name;
          $category->parent_id = $request->parent_id;
          $category->slug = str_slug($request->category_name);
          $category->description = $request->category_description;
          $category->save();
          Toastr::success('Category updated successfully','Success');
          return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     return $category = category::find($id);
      $category->delete();
      return redirect()->back();
      toastr::success('category deleted','success');
    }

    public function updateStatus($id,$status){
      $category = Category::find($id);
      $category->status = $status;
      $category->save();
      
        
    }
}
