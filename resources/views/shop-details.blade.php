@extends('layout')
@section('content')
    <?php use App\Models\User;
    use App\Models\Review;
    use App\Models\Wishlist;
    use App\Models\Selling;
    
    ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Detail Product</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/index') }}">Home</a>
                            {{-- <a href="./index.html">Vegetables</a> --}}
                            <span>Detail Product</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                @if (isset($detailProduct))
                    @foreach ($detailProduct as $item)
                        <?php $product_id = $item->id; ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="product__details__pic">
                                <div class="product__details__pic__item">
                                    <img class="product__details__pic__item--large"
                                        src="{{ asset('img/product/' . $item->image) }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <form action="{{ route('addCartPost', ['id' => $item->id]) }}" method="post">
                                @csrf
                                <div class="product__details__text">
                                    <h3>{{ $item->product_name }}</h3>
                                    <div class="product__details__price">{{ number_format($item->price) . ' VND' }}</div>
                                    <p>{{ $item->description }}</p>
                                    <div class="product__details__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1" name="qty">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="primary-btn">add to cart</button>
                                    <a href="{{ route('addWishlist', ['id' => $item->id]) }}" class="heart-icon"><span
                                            class="icon_heart_alt"></span></a>
                                    <div style="margin-bottom: 0px">
                                        <?php $sell=Selling::where('product_id',$item->id)->first(); ?>
                                        Đã bán: <?php if($sell!=null){
                                            echo $sell->quanty;
                                        }else{
                                            echo '0';
                                        } ?>
                                    </div>
                                    <ul style="margin-top: 0px">
                                        <li><b>Availability</b> <span>In Stock</span></li>
                                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span>
                                        </li>
                                        <li><b>Weight</b> <span>0.5 kg</span></li>
                                        <li><b>Share on</b>
                                            <div class="share">
                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                <a href="#"><i class="fa fa-instagram"></i></a>
                                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    @endforeach
                @endif
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Comment</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Comment</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" active data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="true">Reviews <span>({{ count($reviewProduct) }})</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    {{-- <div class="container my-5 py-5 text-dark"> --}}
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-10 col-lg-8 col-xl-6">
                                            <div class="card">
                                                @if (Auth::check())
                                                    @if ($checkBought != 0)
                                                        @if (count(
                                                            Review::where('user_id', Auth::user()->id)->where('product_id', $product_id)->get(),
                                                        ) == 0)
                                                            <div class="card-body p-4">
                                                                <form
                                                                    action="{{ route('addComment', ['id' => $product_id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <div class="d-flex flex-start w-100">
                                                                        <img class="rounded-circle shadow-1-strong me-3"
                                                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(21).webp"
                                                                            alt="avatar" width="65" height="65" />
                                                                        <div class="w-100"
                                                                            style="margin-left: 20px">
                                                                            <h5 style="margin-bottom: 10px">Add a comment
                                                                            </h5>
                                                                            <div class="form-outline">
                                                                                <textarea name="comment" required class="form-control" id="textAreaExample" rows="4"
                                                                                    placeholder="What is your view?"></textarea>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-between mt-3 justify-content-end">
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Send</button>
                                                                                {{-- <button type="button" class="btn btn-danger">
                                                          Send <i class="fas fa-long-arrow-alt-right ms-1"></i>
                                                        </button> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        @else
                                                            <h2>Bạn đã đánh giá sản phẩm này rồi</h2>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                            {{-- <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div> --}}
                            <div class="tab-pane" active id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <div class="row  d-flex justify-content-center">
                                        <div class="col-md-8">
                                            <div class="headings d-flex justify-content-between align-items-center mb-3">
                                                {{-- <h5>Unread comments(6)</h5> --}}
                                            </div>
                                            @foreach ($reviewProduct as $item)
                                                <?php $user = User::where('id', $item->user_id)->first(); ?>
                                                <div class="card p-3 mt-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="user d-flex flex-row align-items-center"> <img
                                                                src="{{ asset('img/anhDep1.jpg') }}" width="50px"
                                                                height="50px" class="user-img rounded-circle mr-2">
                                                            {{-- <span><small
                                                                    class="font-weight-bold text-primary">{{ $user->name }}</small>
                                                                <small class="font-weight-bold">{{ $item->comment }}
                                                                </small></span> --}}
                                                            <span style="margin-right: 10px"
                                                                class="font-weight-bold text-primary">{{ $user->name }}
                                                            </span> <span style="font-size: 1.2rem"
                                                                class="font-weight-bold">{{ $item->comment }}
                                                            </span>
                                                        </div> <small>{{ $item->created_at }}</small>
                                                    </div>
                                                    <div
                                                        class="action d-flex justify-content-between mt-2 align-items-center">
                                                        <div class="reply px-4">
                                                            @if (Auth::check())
                                                                @if (Auth::user()->id == $item->user_id)
                                                                    <small style="margin-left: 22px">Remove</small>
                                                                    <span class="dots"></span>
                                                                    <small>Change</small>
                                                                @endif
                                                            @endif
                                                            {{-- <span class="dots"></span>
                                                            <small>Translate</small> --}}
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (isset($relatedProduct))
                    @foreach ($relatedProduct as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset('img/product/' . $item->image) }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="{{ route('addWishlist', ['id' => $item->id]) }}"><i
                                                    class="fa fa-heart" <?php if (
                                                        Auth::check() &&
                                                        count(
                                                            Wishlist::where('user_id', Auth::user()->id)
                                                                ->where('product_id', $item->id)
                                                                ->get(),
                                                        )
                                                    ) {
                                                        echo 'style="color: red"';
                                                    } ?>></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="{{ route('addCartGet', ['id' => $item->id]) }}"><i
                                                    class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a
                                            href="{{ route('shop-details', ['id' => $item->id]) }}">{{ $item->product_name }}</a>
                                    </h6>
                                    <h5>{{ number_format($item->price) . ' VND' }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
<!-- Related Product Section End -->@endsection
