<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Selling;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\Type_product;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $latest_product_first = Product::orderBy('create_date', 'desc')->limit(3)->get();
        $latest_product_last = Product::orderBy('create_date', 'desc')->offset(4)->limit(3)->get();
        $sell_first = Selling::orderBy('quanty', 'desc')->limit(3)->get();
        $sell_last = Selling::orderBy('quanty', 'desc')->offset(4)->limit(3)->get();
        $review_first = Review::orderBy('created_at', 'desc')->limit(3)->get();
        $review_last = Review::orderBy('created_at', 'desc')->offset(4)->limit(3)->get();

        $all_typeProduct = Type_product::all();

        return view('/' . $id, compact('all_typeProduct', 'latest_product_first', 'latest_product_last', 'sell_first', 'sell_last', 'review_first', 'review_last'));
    }
    public function home()
    {

        $latest_product_first = Product::orderBy('create_date', 'desc')->limit(3)->get();
        $latest_product_last = Product::orderBy('create_date', 'desc')->offset(4)->limit(3)->get();
        $sell_first = Selling::orderBy('quanty', 'desc')->limit(3)->get();
        $sell_last = Selling::orderBy('quanty', 'desc')->offset(4)->limit(3)->get();
        $review_first = Review::orderBy('created_at', 'desc')->limit(3)->get();
        $review_last = Review::orderBy('created_at', 'desc')->offset(4)->limit(3)->get();

        $all_typeProduct = Type_product::all();

        return view('index', compact('all_typeProduct', 'latest_product_first', 'latest_product_last', 'sell_first', 'sell_last', 'review_first', 'review_last'));
    }

    public function checkout()
    {
        $all_typeProduct = Type_product::all();

        return view('checkout', compact('all_typeProduct'));
    }

    public function showLogin()
    {
        return view('auth.login');
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
