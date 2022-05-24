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
}
