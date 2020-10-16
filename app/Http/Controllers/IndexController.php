<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
   public function index(){
      $banners = Banner::Status()->get();
      $products = Product::latest()->get();
      $categories= Category::where('parent_id',0)->get();
       return view('wayshop.index',compact('banners','categories','products'));
   }

   public function categories($id){
      $categories= Category::where('parent_id',0)->get();
      $products = Product::where('category_id',$id)->get();
      $category_name=Category::where('id',$id)->first();
       return view('wayshop.category_products',compact('categories','products','category_name'));
   }

  
}
