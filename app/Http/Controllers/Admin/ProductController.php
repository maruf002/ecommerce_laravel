<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use PhpOption\Option;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.view_products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        $categories_dropdown = "<option value = '' selected disabled>Select </option>";
        foreach ($categories as $key => $cat) {
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
          $sub_categories = Category::where('parent_id', $cat->id)->get();

            foreach ($sub_categories as $key => $sub) {
                $categories_dropdown .= "<option value='" . $sub->id . "'> &nbsp;--&nbsp" . $sub->name . "</option>";
            }
        }
        return view('admin.products.add_product',compact('categories_dropdown'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_code' => 'required',
            'product_color' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'image'        => 'required'

        ]);

        $image = $request->file('image');
        $name  = $request->product_name;
        if (isset($image)) {
            //make unique name for image
            $currentDate = carbon::now()->toDatestring();
            $imageName   = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!storage::disk('public')->exists('product')) {
                storage::disk('public')->makeDirectory('product');
            }
            $productImage = Image::make($image)->resize(500, 500)->stream();
            storage::disk('public')->put('product/' . $imageName, $productImage);
        }

        $product = new Product();
        $product->user_id = Auth::id(); //auth::id()= present authinticated id
        $product->category_id = $request->category_id;
        $product->name   = $request->product_name;
        $product->code   = $request->product_code;
        $product->color   = $request->product_color;
        $product->description   = $request->product_description;
        $product->price   = $request->product_price;
        $product->image   = $imageName;

        //    if(isset($request->status)){
        //        $post->status = true;
        //    }else{
        //        $post->status = false;
        //    }

        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::where('parent_id', 0)->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        //Category dropdown code 
        foreach ($categories as $key => $cat) {
          if ($cat->id == $product->category_id) {
              $selected = "selected";
          }else{
              $selected = "";
          }
          $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
          $sub_categories = Category::where('parent_id',$cat->id)->get(); 
       foreach ($sub_categories as $key => $sub) {
        if ($sub->id == $product->category_id) {
            $selected = "selected";
        }else{
            $selected = "";
        }
        $categories_dropdown .= "<option value = '".$sub->id."' ".$selected.">&nbsp;--&nbsp;".$sub->name."</option>";
       }

        }
 
        return view('admin.products.edit_product',compact('product','categories_dropdown'));
    
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        $this->validate($request, [
            'product_name' => 'required',
            'product_code' => 'required',
            'product_color' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'image'        => 'image'

        ]);

        $image = $request->file('image');
        $name  = $request->product_name;
        if (isset($image)) {
            //make unique name for image
            $currentDate = carbon::now()->toDatestring();
            $imageName   = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!storage::disk('public')->exists('product')) {
                storage::disk('public')->makeDirectory('product');
            }
             //delete old post image
         if(storage::disk('public')->exists('product/'.$product->image)){
            storage::disk('public')->delete('product/'.$product->image);
        }
            $productImage = Image::make($image)->resize(500, 500)->stream();
            storage::disk('public')->put('product/' . $imageName, $productImage);
        }else{
            $imageName = $product->image;
        }

       
        $product->user_id = Auth::id(); //auth::id()= present authinticated id
        $product->name   = $request->product_name;
        $product->category_id   = $request->category_id;
        $product->code   = $request->product_code;
        $product->color   = $request->product_color;
        $product->description   = $request->product_description;
        $product->price   = $request->product_price;
        $product->image   = $imageName;

        //    if(isset($request->status)){
        //        $post->status = true;
        //    }else{
        //        $post->status = false;
        //    }

        $product->save();
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(storage::disk('public')->exists('product/'.$product->image)){
            storage::disk('public')->delete('product/'.$product->image);

        }
        $product->delete();
        return redirect()->back();
    }
}
