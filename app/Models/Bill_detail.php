<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;


class Bill_detail extends Model
{
    use HasFactory;
    public function orders() {
        return  $this->hasMany(Order::class,'id','bill_detail_id');
    }
    // public function products() {
    //     return  $this->hasMany(Product::class,'id','type_id');
    // }

    public function scopeSearch($query){
        if($key = request()->key){
           $query = $query->where('name','like','%'.$key.'%')->orWhere('phone','like','%'.$key.'%')->orWhere('email','like','%'.$key.'%')->orWhere('address','like','%'.$key.'%')->orWhere('total','like','%'.$key.'%')->orWhere('status','like','%'.$key.'%')->orWhere('note','like','%'.$key.'%');
        }
        return $query;
     }
}
