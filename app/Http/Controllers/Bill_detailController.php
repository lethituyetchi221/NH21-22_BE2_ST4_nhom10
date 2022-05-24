<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill_detail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Cart;

class Bill_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function addBill(Request $request)
    {
        $cart = Cart::content();

        $bill_detail = new Bill_detail();
        $bill_detail->user_id  = Auth::user()->id;
        $bill_detail->name  = $request->name;
        $bill_detail->phone  = $request->phone;
        $bill_detail->email  = $request->email;
        $bill_detail->address  = $request->address;
        // $bill_detail->total  = Cart::priceTotal();
        $bill_detail->note  = $request->note;
        $bill_detail->create_date  = DATE(NOW());



        $bill_detail->save();

        foreach ($cart as $item) {
            $order = new Order();
            $order->product_id  = $item->id;
            $order->total  = $item->price * $item->qty;
            $order->quanty  = $item->qty;
            $order->bill_detail_id = $bill_detail->id;
            $order->save();
            $bill_detail->total+=$order->total;
            $bill_detail->save();
        }
        Cart::destroy();
        return redirect()->route('showCart');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
