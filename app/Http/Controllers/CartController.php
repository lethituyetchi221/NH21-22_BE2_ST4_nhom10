<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
use Cart;

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
                'create_date'=>$productByID->create_date] 
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

     //decrement quality
     function deQuality($rowID){
        $row = Cart::get($rowID);
        Cart::update($rowID,$row->qty -1);

       return redirect()->route('cart');
    }
    
    //increment quality
    function inQuality($rowID){
        $row = Cart::get($rowID);
        $product_id =   $row->id; 
        Cart::update($rowID,$row->qty +1);
     
   
        return redirect()->route('cart');
    }

    public function showCart($id)
    {
        $cart_priceTotal = Cart::priceTotal();

        return view('shoping-cart', compact('cart_priceTotal'));
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
