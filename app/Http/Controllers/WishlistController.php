<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type_product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addWishlist($id)
    {
        if (count(Wishlist::where('product_id', '=', $id)->where('user_id', '=', Auth::user()->id)->get()) == 0) {
            $wishlist = new Wishlist();
            $wishlist->user_id  = Auth::user()->id;
            $wishlist->product_id   = $id;
            $wishlist->create_date  = DATE(NOW());
            $wishlist->save();

            return  redirect()->back()->with('Success', 'Thêm vào yêu thích thành công');
        } else {
        Wishlist::where('product_id',$id)->where('user_id',Auth::user()->id)->delete();
        return  redirect()->back()->with('Success', 'Xóa khỏi yêu thích thành công');

        }
    }

    public function showWishlist()
    {
       
        $all_typeProduct = Type_product::all();
        $all_wishlist = Wishlist::where('user_id', '=', Auth::user()->id)->paginate(9);
        return view('/wishlist', compact('all_wishlist', 'all_typeProduct'));
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
