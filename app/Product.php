<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
       return $this->belongsTo('App\Category');
    }
    public function attributes(){
        return $this->hasMany('App\ProductsAttributes');
     }
     public function altimages(){
      return $this->hasMany('App\Altimages');
   }
  public function carts(){
   return $this->belongsToMany('App\Cart');
  }
  
}
