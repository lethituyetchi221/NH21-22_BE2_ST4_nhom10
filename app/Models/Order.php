<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bill_detail;


class Order extends Model
{
    use HasFactory;

    public   function bill_details(){
        //    return $this-> hasOne(Type_product::class, 'type_id');
         return $this->belongsTo(Bill_detail::class,'bill_detail_id','id');
       }
      //  public   function type_products(){
      //   //    return $this-> hasOne(Type_product::class, 'type_id');
      //    return $this->belongsTo(Type_product::class,'type_id','id');
      //  }

      public function scopeSearch($query){
        if($key = request()->key){
           $query = $query->where('product_id','like','%'.$key.'%')->orWhere('qty','like','%'.$key.'%')->orWhere('bill_detail_id','like','%'.$key.'%')->orWhere('total','like','%'.$key.'%');
        }
        return $query;
     }
}
