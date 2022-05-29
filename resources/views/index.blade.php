<?php
use App\Models\Product;
use App\Models\Review;
use App\Models\Wishlist;

?>
@extends('layout')
@section('content')
    <div class="container">
        <div class="hero__item set-bg" style="margin-bottom: 80px" data-setbg="img/product/collection_banner.jpg">
            <div class="hero__text">
                <span style="color: aliceblue">ROYAL SUSHI</span>
                {{-- <h2 style="color: #000011">100% Tươi <br />Ngon chuẩn nhật</h2> --}}
                {{-- <p>Free Pickup and Delivery Available</p> --}}
                <br><br><br><br><br><br><br><br><br>
                {{-- <br><br><br><br><br> --}}
                <a href="{{ route('shop-grid', ['id' => 1]) }}" class="primary-btn">SHOP NOW</a>
            </div>
        </div>
    </div>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($all_typeProduct as $item)
                        <?php $product = Product::where('type_id', $item->id)
                            ->orderBy('create_date', 'desc')
                            ->first(); ?>
                        <div class="col-lg-12">
                            <div class="categories__item set-bg" data-setbg="img/product/{{ $product->image }}">
                                <h5><a href="{{ route('shop-grid', ['id' => $item->id]) }}">{{ $item->type_name }}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            {{-- <li data-filter=".sashimi" >SaShimi</li>
                            <li data-filter=".sushi" >Sushi</li>
                            <li data-filter=".salads" >Salads</li>
                            <li data-filter=".monAnKem" >Món ăn kèm</li> --}}
                            @foreach ($all_typeProduct as $item)
                                <li data-filter=".{{ 'item' . $item->id }}">{{ $item->type_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($all_typeProduct as $item)
                    <?php $product = Product::where('type_id', $item->id)
                        ->where('is_featured', 1)
                        ->get(); ?>
                    @foreach ($product as $value)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix {{ 'item' . $item->id }} ">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="img/product/{{ $value->image }}">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="{{route('addWishlist',['id'=>$value->id])}}"><i class="fa fa-heart" <?php if (Auth::check() && count(Wishlist::where('user_id',Auth::user()->id)->where('product_id',$value->id)->get())) {
                                            echo 'style="color: red"';
                                        } ?>></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="{{ route('addCartGet', ['id' => $value->id]) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    {{-- <h6><a href="shop-details/{{$item->id}}">{{$item->product_name}}</a></h6> --}}
                                    <h6><a
                                            href="{{ route('shop-details', ['id' => $value->id]) }}">{{ $value->product_name }}</a>
                                    </h6>
                                    <h5>{{ number_format($value->price) . ' VND' }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row justify-content-center">
                {{-- <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img style="width: 100%; height: 100%;" src="{{asset('img/bannerLeft.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div> --}}
                <img style="height:550px;" src="{{asset('img/banerR.jpg')}}" alt="">
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($latest_product_first as $item)
                                    <a href="{{ route('shop-details', ['id' => $item->id]) }}"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('img/product/' . $item->image) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $item->product_name }}</h6>
                                            <span>{{ number_format($item->price) . ' VND' }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($latest_product_last as $item)
                                    <a href="{{ route('shop-details', ['id' => $item->id]) }}"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('img/product/' . $item->image) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $item->product_name }}</h6>
                                            <span>{{ number_format($item->price) . ' VND' }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Selling Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($sell_first as $item)
                                    <?php $product = Product::where('id', $item->product_id)->first(); ?>
                                    <a href="{{ route('shop-details', ['id' => $product->id]) }}"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('img/product/' . $product->image) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->product_name }}</h6>
                                            <span>{{ number_format($product->price) . ' VND' }}</span>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                            <div class="latest-prdouct__slider__item">

                                @foreach ($sell_last as $item)
                                    <?php $product = Product::where('id', $item->product_id)->first(); ?>
                                    <a href="{{ route('shop-details', ['id' => $product->id]) }}"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset('img/product/' . $product->image) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->product_name }}</h6>
                                            <span>{{ number_format($product->price) . ' VND' }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach($review_first as $item)
                                <?php $product=Product::where('id',$item->product_id)->first() ?>
                                <a href="{{ route('shop-details', ['id' => $product->id]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('img/product/' . $product->image) }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->product_name }}</h6>
                                        <span>{{ number_format($product->price) . ' VND' }}</span>
                                    </div>
                                </a>
                               @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach($review_last as $item)
                                <?php $product=Product::where('id',$item->product_id)->first() ?>
                                <a href="{{ route('shop-details', ['id' => $product->id]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('img/product/' . $product->image) }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->product_name }}</h6>
                                        <span>{{ number_format($product->price) . ' VND' }}</span>
                                    </div>
                                </a>
                               @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
