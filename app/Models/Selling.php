<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    use HasFactory;
    public function scopeSearch($query){
        if($key = request()->key){
           $query = $query->where('quanty','like','%'.$key.'%')->orWhere('product_id','like','%'.$key.'%');
        }
        return $query;
     }
}
