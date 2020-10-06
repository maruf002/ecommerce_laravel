<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function scopeStatus($query){
        return $query->where('status',1)->orderby('sort_order','asc');
    }
    
}

