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
      $categories= Category::where('parent_id',0)->get();
      $products = Product::latest()->get();
       return view('wayshop.index',compact('banners','categories','products'));
   }

   public function categories(){
      $categories= Category::where('parent_id',0)->get();
     
       return view('wayshop.index',compact('banners','categories'));
   }

  
}
