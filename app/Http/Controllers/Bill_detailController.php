<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill_detail;
use App\Models\Order;
use App\Models\Selling;
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
    public function successBill($bill_id)
    {
        $bill_detail = Bill_detail::where('id', '=', $bill_id)->first();
        $bill_detail->status = 3;
        $bill_detail->save();

        return redirect()->route('showBillDetail', ['bill_id' => $bill_id]);
    }
    public function editBill($bill_id, Request $request)
    {
        $bill_detail = Bill_detail::where('id', '=', $bill_id)->first();

        $bill_detail->name  = $request->name;
        $bill_detail->phone  = $request->phone;
        $bill_detail->email  = $request->email;
        $bill_detail->address  = $request->address;
        $bill_detail->note  = $request->note;

        $bill_detail->save();

        return redirect()->route('showBillDetail', ['bill_id' => $bill_id]);
    }
    public function showEditBill($bill_id)
    {

        $bill_detail = Order::where('bill_detail_id', '=', $bill_id)->with('bill_details')->get();
        $bill = Bill_detail::where('id', '=', $bill_id)->get();
        return view('edit-bill', compact('bill_detail', 'bill'));
    }
    public function deleteBill($bill_id)
    {
        Bill_detail::where('id', '=', $bill_id)->delete();
        $order =  Order::where('bill_detail_id', '=', $bill_id)->get();
        foreach ($order as $item) {
            $sell = Selling::where('product_id', $item->product_id)->first();
            $sell->quanty -= $item->qty;
            $sell->save();
        }
        Order::where('bill_detail_id', '=', $bill_id)->delete();

        return redirect()->route('showProfile')->with('Success', 'Hủy đơn hàng thành công');
    }
    public function showBillDetail($bill_id)
    {
        $bill_detail = Order::where('bill_detail_id', '=', $bill_id)->with('bill_details')->get();
        $bill = Bill_detail::where('id', '=', $bill_id)->get();
        return view('bill-detail', compact('bill_detail', 'bill'));
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
        $bill_detail->status  = 0;
        $bill_detail->note  = $request->note;
        $bill_detail->create_date  = DATE(NOW());



        $bill_detail->save();

        foreach ($cart as $item) {
            if (count(Selling::where('product_id', $item->id)->get()) == 0) {
                $sell = new Selling();
                $sell->product_id = $item->id;
                $sell->quanty = $item->qty;
                $sell->save();
            } else {
                $sell = Selling::where('product_id', $item->id)->first();
                $sell->quanty += $item->qty;
                $sell->save();
            }
            $order = new Order();
            $order->product_id  = $item->id;
            $order->total  = $item->price * $item->qty;
            $order->qty  = $item->qty;
            $order->bill_detail_id = $bill_detail->id;
            $order->save();
            $bill_detail->total += $order->total;
            $bill_detail->save();
        }
        Cart::destroy();
        return redirect()->route('showBillDetail', ['bill_id' => $bill_detail->id])->with('Success', 'Đặt hàng thành công');
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
