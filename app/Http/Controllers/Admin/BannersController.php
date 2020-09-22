<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::latest()->get();
        return view('admin.banner.banner',compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.banner.add_banner');
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
            'banner_name'=>'required',
            'text_style'=>'required',
            'banner_content'=>'required',
            'link'=>'required',
            'sort_order'=>'required',
            'image' =>'required|mimes:jpeg,bmp,png,jpg'


        ]);
        $image= $request->image;
        $name=$request->name;
        if (isset($image)) {
            //make unique name for image
            $currentDate = carbon::now()->toDatestring();
            $imageName   = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!storage::disk('public')->exists('banner')) {
                storage::disk('public')->makeDirectory('banner');
            }
            // without resize the image 
            $bannerImage = Image::make($image)->stream();
            storage::disk('public')->put('banner/' . $imageName, $bannerImage);
        }
        $banner = new Banner();
        $banner->name = $request->banner_name;
        $banner->text_style = $request->text_style;
        $banner->content = $request->banner_content;
        $banner->sort_order = $request->sort_order;
        $banner->link = $request->link;
        $banner->image = $imageName; 
        $banner->save() ;
        Toastr::success('banner successfully added','Success');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $banner = Banner::find($id);
      return view('admin.banner.edit_banner',compact('banner'));

        
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
            'banner_name'=>'required',
            'text_style'=>'required',
            'banner_content'=>'required',
            'link'=>'required',
            'sort_order'=>'required',
            'image' =>'image'


        ]);
        $banner=Banner::find($id);
        $image= $request->image;
        $name=$request->name;
        if (isset($image)) {
            //make unique name for image
            $currentDate = carbon::now()->toDatestring();
            $imageName   = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!storage::disk('public')->exists('banner')) {
                storage::disk('public')->makeDirectory('banner');
            }
                //delete old  image
         if(storage::disk('public')->exists('product/'.$banner->image)){
            storage::disk('public')->delete('product/'.$banner->image);
        }
            // without resize the image 
            $bannerImage = Image::make($image)->stream();
            storage::disk('public')->put('banner/' . $imageName, $bannerImage);
        }else{
            $imageName = $banner->image;
        }
        $banner->name = $request->banner_name;
        $banner->text_style = $request->text_style;
        $banner->content = $request->banner_content;
        $banner->sort_order = $request->sort_order;
        $banner->link = $request->link;
        $banner->image = $imageName; 
        $banner->save() ;
        Toastr::success('banner successfully added','Success');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Banner::find($id);
        if(storage::disk('public')->exists('banner/'.$banner->image)){
            storage::disk('public')->delete('banner/'.$banner->image);
        }
        $banner->delete();
        Toastr::success('Banner successfully deleted','success');
        return redirect()->back();
    }

    //$id,$status we can use any variable name because it's auto detect first and second variable respectively
    public function updateStatus($id,$status){ 
        $banner=Banner::find($id);
        $banner->status = $status;
        $banner->save();
       
       
          
       }
}
