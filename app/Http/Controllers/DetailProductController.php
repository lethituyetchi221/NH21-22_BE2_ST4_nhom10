<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type_product;
use App\Models\Review;
use App\Models\Bill_detail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class DetailProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        $checkBought=0;
        if (Auth::check()) {
            $order = Order::where('product_id', $product_id)->get();
            $bill= Bill_detail::where('user_id',Auth::user()->id)->whereIn('status',[2,3])->get();
            foreach($order as $item){
                foreach($bill as $itemTemp){
                    if($item->bill_detail_id==$itemTemp->id){
                        $checkBought+=1;
                    }
                }
            }
        }

        $all_typeProduct = Type_product::all();
        $detailProduct = Product::where('id', '=', $product_id)->get();
        $relatedProduct = Product::where('is_featured', '=', 1)->limit(4)->with('type_products')->get();
        $reviewProduct = Review::where('product_id', $product_id)->orderBy('created_at', 'desc')->get();
        return view('/shop-details', compact('detailProduct', 'relatedProduct', 'all_typeProduct', 'reviewProduct','checkBought'));
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
