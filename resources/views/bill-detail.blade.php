@extends('layout')
@section('content')
    <?php $content = Cart::content();
    use App\Models\Order;
    use App\Models\Product;
    
    ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Bill Detail</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Bill Detail</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if (session()->has('newCart')) --}}
                                {{-- @if ($newCart != null) --}}

                                @foreach ($bill_detail as $item)
                                    <tr>
                                        <?php $product = Product::where('id', '=', $item->product_id)->get(); ?>
                                        <td class="shoping__cart__item">
                                            <a href="{{ route('shop-details', ['id' => $product[0]->id]) }}"> <img
                                                    style="width: 100px" ; height="100px"
                                                    src="{{ asset('img/product/' . $product[0]->image) }}" alt=""></a>
                                            <a href="{{ route('shop-details', ['id' => $product[0]->id]) }}">
                                                <h5>{{ $product[0]->product_name }}</h5>
                                            </a>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{ number_format($product[0]->price) }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <label>{{ $item->qty }} </label>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            {{ number_format($product[0]->price * $item->qty) }}
                                        </td>

                                    </tr>
                                    {{-- <tr>
                                        <td></td>
                                    </tr> --}}
                                @endforeach

                            </tbody>


                        </table>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-8 text-center">
                    <h2 style="font-weight: bold">TOTAL: {{ number_format($bill[0]->total) . ' VNĐ' }}</h2>
                </div>
                <div class="col-lg-4">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('home') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__checkout">
                        <h5>Information</h5>
                        <ul>
                            <li>Name <span> {{ $bill[0]->name }} </span></li>
                            <li>Phone <span>{{ $bill[0]->phone }} </span></li>
                            <li>Email <span> {{ $bill[0]->email }}</span></li>
                            <li>Address <span> {{ $bill[0]->address }} </span></li>
                            <li>Status <span> <?php if ($bill[0]->status == 0) {
                                echo 'Chờ xác nhận';
                            } elseif ($bill[0]->status == 1) {
                                echo 'Đang giao hàng';
                            } elseif ($bill[0]->status == 2) {
                                echo 'Giao thành công';
                            } elseif ($bill[0]->status == 3) {
                                echo 'Đã nhận hàng';
                            }
                            ?> </span></li>
                            <li>Note <span>{{ $bill[0]->note }} </span></li>
                            <li>Create Date <span> {{ $bill[0]->create_date }}</span></li>
                            <li>Delivery Date <span> {{ $bill[0]->delivery_date }}</span></li>
                        </ul>

                        <div class="row">
                            @if ($bill[0]->status == 0)
                                <div class="col-lg-6">
                                    <a href="{{ route('showEditBill', ['bill_id' => $bill[0]->id]) }}"
                                        class="primary-btn">Sửa thông tin</a>
                                </div>
                                <div class="col-lg-6">
                                    <a data-toggle="modal" data-target="#exampleModal" href="" class="primary-btn">Hủy
                                        đơn hàng</a>
                                    <!-- Button trigger modal -->

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Already delete?</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                {{-- <div class="modal-body">
                                                    ...
                                                </div> --}}
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <a href="{{ route('deleteBill', ['bill_id' => $bill[0]->id]) }}"><button
                                                            type="button" class="btn btn-primary">Delete</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($bill[0]->status == 1)
                                <div class="col-lg-12">
                                    <label class="primary-btn" for="">Đang giao hàng</label>
                                </div>
                            @elseif($bill[0]->status == 2)
                                <div class="col-lg-12">
                                    <a href="{{ route('successBill', ['bill_id' => $bill[0]->id]) }}"
                                        class="primary-btn">Đã nhận hàng</a>
                                </div>
                            @elseif($bill[0]->status == 3)
                                <div class="col-lg-12">
                                    <label class="primary-btn" for="">Giao hàng thành công</label>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
