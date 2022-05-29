@extends('layout')
@section('content')
<?php $content = Cart::content();
use App\Models\Order;
use App\Models\Product;
use App\Models\Wishlist;
?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Wishlist</h2>
                        <div class="breadcrumb__option">
                            <a href="{{url('/index')}}">Home</a>
                            <span>Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
             
                <div class="col-lg-12 col-md-7">
                 
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{count($all_wishlist)}}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($all_wishlist as $item)
                        <?php $product = Product::where('id','=',$item->product_id)->first() ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{asset('img/product/'.$product->image)}}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="{{route('addWishlist',['id'=>$product->id])}}"><i class="fa fa-heart" <?php if (Auth::check() && count(Wishlist::where('user_id',Auth::user()->id)->where('product_id',$product->id)->get())) {
                                            echo 'style="color: red"';
                                        } ?>></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a onclick="AddCart()" href="{{route('addCartGet', ['id'=> $product->id])}}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{route('shop-details', ['id'=> $product->id])}}">{{$product->product_name}}</a></h6>
                                    <h5>{{number_format($product->price)." VND"}}</h5>
                                </div>
                            </div>
                        </div>
                 @endforeach
                    </div>
                    <div class="div">
                        {{$all_wishlist->appends(request()->all())->links()}}

                    </div>
                    {{-- <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    @endsection