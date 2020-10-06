<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
     public function productdetails($id){
        $productDetails=Product::where('id',$id)->first();
        return view('wayshop.product_details',compact('productDetails'));
      
    }
}
