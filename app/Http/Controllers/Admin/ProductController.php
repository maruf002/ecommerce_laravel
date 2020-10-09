<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductsAttributes;
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
        return view('admin.products.view_products', compact('products'));
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
        return view('admin.products.add_product', compact('categories_dropdown'));
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
            'name' => 'required|unique:products',
            'code' => 'required|unique:products',
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
            } else {
                $selected = "";
            }
            $categories_dropdown .= "<option value='" . $cat->id . "' " . $selected . ">" . $cat->name . "</option>";
            $sub_categories = Category::where('parent_id', $cat->id)->get();
            foreach ($sub_categories as $key => $sub) {
                if ($sub->id == $product->category_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value = '" . $sub->id . "' " . $selected . ">&nbsp;--&nbsp;" . $sub->name . "</option>";
            }
        }

        return view('admin.products.edit_product', compact('product', 'categories_dropdown'));
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
            if (storage::disk('public')->exists('product/' . $product->image)) {
                storage::disk('public')->delete('product/' . $product->image);
            }
            $productImage = Image::make($image)->resize(500, 500)->stream();
            storage::disk('public')->put('product/' . $imageName, $productImage);
        } else {
            $imageName = $product->image;
        }


        $product->user_id = Auth::id(); //auth::id()= present authinticated id
        $product->name   = $request->name;
        $product->category_id   = $request->category_id;
        $product->code   = $request->code;
        $product->color   = $request->product_color;
        $product->description   = $request->product_description;
        $product->price   = $request->product_price;
        $product->image   = $imageName;
        $product->save();
        Toastr::success('Product successfully added','success');
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
        if (storage::disk('public')->exists('product/' . $product->image)) {
            storage::disk('public')->delete('product/' . $product->image);
        }
        $product->delete();
        return redirect()->back();
    }
    //$id,$status we can use any variable name because it's auto detect first and second variable respectively
    public function updateStatus($id, $status)
    {
        $product = Product::find($id);
        $product->status = $status;
        $product->save();
    }

    public function attributes($id)
    {



        $product = Product::where('id', $id)->first();
       
        return view('admin.products.add_attributes', compact('product'));
    }

    public function addAttributes(Request $request, $id)
    {

        $this->validate($request, [
            'sku' => 'required',
            'size' => 'required',
            'price' => 'required',
            'stock' => 'required',

        ]);
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['sku'] as $key => $val) {
                if (!empty($val)) {
                    //Prevent duplicate SKU Record
                   $attrCountSKU = ProductsAttributes::where('sku', $val)->count();
                    if ($attrCountSKU > 0) {
                      
                         Toastr::warning('SKU is already exist please select another sku', 'warning');
                         return redirect()->back();
                    }
                    //Prevent duplicate Size Record
              
               $attrCountSizes= ProductsAttributes::where(['product_id'=>$id ,'size'=> $data['size'][$key]])->count();
     
                    if ($attrCountSizes > 0) {
                        Toastr::warning('Size is already exist please select another size', 'warning');
                        return redirect()->back();
                    }

                    $attribute = new ProductsAttributes;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                    Toastr::success('Product Attributes added','success');
                    return redirect()->back(); 
                }
            }
        }
    }

    public function editAttributes(Request $request, $id){
       $data= $request->all();
      foreach ($data['attr'] as $key => $val) {
      
        ProductsAttributes::where(['id'=>$data['attr'][$key]])->update(['sku'=>$data['sku'][$key],
        'size'=>$data['size'][$key],'price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
  
          
      }
      Toastr::success('successfully attributes updated','success');
      return redirect()->back();


    }

    public function deleteAttributes($id){
        ProductsAttributes::find($id)->delete();
         Toastr::success('successfully attributes deleted','success');
      return redirect()->back();
    }
}
