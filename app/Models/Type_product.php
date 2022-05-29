<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Type_product extends Model
{
    use HasFactory;
    public function products() {
        return  $this->hasMany(Product::class,'id','type_id');
    }

    public function scopeSearch($query){
        if($key = request()->key){
           $query = $query->where('type_name','like','%'.$key.'%');
        }
        return $query;
     }
}
