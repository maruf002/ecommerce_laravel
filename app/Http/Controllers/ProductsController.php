<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductsAttributes;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
     public function productdetails($id){
        $productDetails=Product::where('id',$id)->first();
        $featureProducts=Product::where('featured_products',1)->get();
        return view('wayshop.product_details',compact('productDetails','featureProducts'));
      
    }
    public function getprice(Request $request ){
      
      $data = $request->all();
        //  echo "<pre>";print_r($data);die;
       $proArr = explode("-",$data['idSize']);
       
        $proAttr = ProductsAttributes::where(['id'=>$proArr[0],'size'=>$proArr[1]])->first();
      
        echo $proAttr->price;

    }

    
}
