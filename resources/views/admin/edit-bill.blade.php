@extends('admin.layout-admin')
@section('content_admin')
    <?php
    use Illuminate\Support\Facades\Session;
    use App\Models\Product;
    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">{{ $typeProduct->type_name }}</h1> --}}
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Products of {{ $typeProduct->type_name }}</h6> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <form action="{{route('editBill_admin',['id'=>$bill->id])}}" method="post" enctype="multipart/form-data" id="image-form">
                                @csrf
                            @if (isset($bill))
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Name</h3>
                                            </div>
                                            <div class="col-8">
                                                <input readonly value="{{ $bill->name }}" required type="text"
                                                    class="form-control" placeholder="Name" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="name">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Phone</h3>
                                            </div>
                                            <div class="col-8">
                                                <input readonly value="{{ $bill->phone }}" required type="tel"
                                                    class="form-control" placeholder="Phone" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="phone">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Email</h3>
                                            </div>
                                            <div class="col-8">
                                                <input readonly value="{{ $bill->price }}" type="email"
                                                    class="form-control" placeholder="Email" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="email">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Address</h3>
                                            </div>
                                            <div class="col-8">
                                                <textarea readonly id="summernote" required class="form-control" aria-label="With textarea"
                                                    name="address">{{ $bill->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Total</h3>
                                            </div>
                                            <div class="col-8">
                                                <input readonly value="{{ $bill->total }}" required type="number"
                                                    class="form-control" placeholder="Total" aria-label="Username"
                                                    aria-describedby="basic-addon1" name="total">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Status</h3>
                                            </div>
                                            <div class="col-8">
                                                <select id="inputStatus" class="form-control custom-select" name="status"
                                                    required>
                                                    <option value="0" <?php if ($bill->status == 0) {
                                                        echo 'selected';
                                                    } ?>>Chờ xác nhận</option>
                                                    <option value="1" <?php if ($bill->status == 1) {
                                                        echo 'selected';
                                                    } ?>>Đang giao hàng</option>
                                                    <option value="2" <?php if ($bill->status == 2) {
                                                        echo 'selected';
                                                    } ?>>Giao hàng thành công</option>
                                                    <option value="3" <?php if ($bill->status == 3) {
                                                        echo 'selected';
                                                    } ?>>Đã nhận hàng</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col-4">
                                                <h3 style="font-weight: bold">Note</h3>
                                            </div>
                                            <div class="col-8">
                                                <textarea readonly id="summernote" class="form-control" aria-label="With textarea"
                                                    name="note">{{ $bill->note }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="col">
                                                <h4>Product</h4>
                                            </div>
                                            <div class="col-3">
                                                <h4>Total</h4>
                                            </div>
                                            <div class="col-3">
                                                <h4>Quantity</h4>
                                            </div>
                                            {{-- <div class="col-1"><a href="" class="btn btn-info btn-circle btn-sm"
                                                    data-toggle="modal" data-target="#modalAddProtype">
                                                    <i class="fa fa-plus"></i>
                                                </a></div> --}}
                                        </div>
                                        @foreach ($order as $item)
                                            <?php $product = Product::where('id', '=', $item->product_id)->first(); ?>
                                            <div class="row" style="margin-bottom: 10px">
                                                <div class="col">
                                                    {{ $product->product_name }}
                                                    <br>
                                                    <img style="width: 70px; heigth:70px"
                                                        src="{{ asset('img/product/' . $product->image) }}" alt="">

                                                </div>
                                                <div class="col-3">{{ number_format($item->total) }}</div>
                                                <div class="col-3">{{ $item->qty }}</div>
                                                {{-- <div class="col-1">
                                                        <a href="{{route('showEditBill_admin',['id'=>$item->id])}}" class="btn btn-info btn-circle btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#deleteModal{{ $item->id }}" href="#"
                                                            class="btn btn-danger btn-circle btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Ready to delete?
                                                                        </h5>
                                                                        <button class="close" type="button" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <a class="btn btn-primary"
                                                                            href="{{route('deleteBill_admin',['id'=>$item->id])}}">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <input type="submit" class="btn btn-primary btn-lg active" role="button"
                                        aria-pressed="true" value="Save">
                                </div>
                            @endif
                            </form>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    </div>


    <!-- End of Main Content -->
@endsection
