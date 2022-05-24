<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Bill_detail;
use App\Models\Order;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
use Cart;
use App\Models\Type_product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function addCartPost($id, Request $request){
        $productByID = Product::where('id','=', $id)->first();
        Cart::add([
            'id'=>$id,
            'name'=>$productByID->product_name,
            'qty'=>$request->qty,
            'price'=>$productByID->price,
            'weight'=>0,
            'options'=>[ 
                'image'=>$productByID->image,
                'create_date'=>$productByID->create_date,
                'status'=>0] 
        ]);
       // dd(Cart::content());
        return redirect()->route('showCart');
    }
    function addCartGet($id){
        $productByID = Product::where('id','=', $id)->first();
        Cart::add([
            'id'=>$id,
            'name'=>$productByID->product_name,
            'qty'=>1,
            'price'=>$productByID->price,
            'weight'=>0,
            'options'=>[ 
                'image'=>$productByID->image,
                'create_date'=>$productByID->create_date] 
        ]);
       // dd(Cart::content());
        return redirect()->route('showCart');
    }
    function deleteItem($rowID){
        Cart::remove($rowID);   
        return redirect()->route('showCart');
    }

   

    public function showCart()
    {
        $bill_by_userId = Bill_detail::where('user_id','=', Auth::user()->id)->orderBy('create_date', 'desc')->get();
        $cart_priceTotal = Cart::priceTotal();
        $all_typeProduct= Type_product::all();
        return view('shoping-cart', compact('cart_priceTotal','all_typeProduct','bill_by_userId'));
    }
    public function billSuccess()
    {
        $cart_priceTotal = Cart::priceTotal();
        $success = "<script>alertify.success('Đặt hàng thành công');</script>";
        return view('shoping-cart', compact('cart_priceTotal', 'success'));
    }
    

    public function index()
    {
        //
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
