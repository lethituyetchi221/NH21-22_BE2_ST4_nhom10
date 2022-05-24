<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;


class Bill_detail extends Model
{
    use HasFactory;
    public function orders() {
        return  $this->hasMany(Order::class,'id','bill_detail_id ');
    }
}
