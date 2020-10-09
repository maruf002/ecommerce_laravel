<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsAttributes extends Model
{
    public function products(){
        $this->belongsTo('App\Product');
    }
}
