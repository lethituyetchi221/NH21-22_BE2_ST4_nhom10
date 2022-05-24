@extends('layout')
@section('content')
    <?php $content = Cart::content(); ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div> --}}
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{ route('addBill') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Name<span>*</span></p>
                                        <input type="text" required name="name" style="color: black">
                                    </div>
                                </div>

                            </div>

                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" required
                                    name="address" style="color: black">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" required name="phone" style="color: black">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span></span></p>
                                        <input type="text" name="email" style="color: black">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Order notes<span></span></p>
                                <input type="text" placeholder="Notes about your order, e.g. special notes for delivery."
                                    name="note" style="color: black">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    <?php $Subtotal = 0; ?>
                                    <?php foreach($content as $item): ?>
                                    <li>{{ $item->qty . ' ' . $item->name }}
                                        <span>{{ number_format($item->price * $item->qty) }}</span>
                                    </li>
                                    <?php $Subtotal += $item->price * $item->qty; ?>
                                    <?php endforeach ?>
                                    {{-- <li>Vegetable’s Package <span>$75.99</span></li>
                                    <li>Fresh Vegetable <span>$151.99</span></li>
                                    <li>Organic Bananas <span>$53.99</span></li> --}}
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal
                                    <span>{{ number_format($Subtotal), ' VND' }}</span>
                                </div>
                                <div class="checkout__order__total">Total
                                    <span>{{ number_format($Subtotal), ' VND' }}</span></div>

                                <p>Thanh toán khi nhận hàng.</p>

                                <button  type="submit" class="site-btn" name="submit">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
