<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill_detail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // var_dump('123');die();
    }

    public function addOrder()
    {
        $cart = Cart::content();

        $bill_detail = new Bill_detail();
        $bill_detail->user_id  = Auth::user()->id;
        $bill_detail->save();

        foreach ($cart as $item) {
            $order = new Order();
            $order->product_id  = $item->id;
            $order->total  = $item->price * $item->qty;
            $order->quanty  = $item->qty;
            $order->product_id  = $item->id;
            $order->bill_detail_id = $bill_detail->id;
            $order->save();
        }
        return redirect()->route('addBill', compact('bill_detail','order'));

       
    }
    public function showOrder()
    {
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
