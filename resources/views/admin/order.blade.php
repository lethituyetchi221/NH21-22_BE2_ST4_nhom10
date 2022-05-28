@extends('admin.layout-admin')
@section('content_admin')
    <?php
    use App\Models\Product;
    use App\Models\Bill_detail;
    
    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Orders</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Orders of Royal SuShi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10px">Id</th>
                                <th>Product</th>
                                <th>Total</th>
                                <th>Quantity</th>
                                <th>Bill Id</th>
                                <th>Status</th>
                                <th>Create Date</th>
                                {{-- <th class="text-center"> <a href="" class="btn btn-info btn-circle btn-sm"
                                        data-toggle="modal" data-target="#modalAddProtype">
                                        <i class="fa fa-plus"></i>
                                    </a></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_order as $item)
                                <?php
                                $product = Product::where('id', '=', $item->product_id)->first(); 
                                $bill = Bill_detail::where('id', '=', $item->bill_detail_id)->first(); 
                                ?>
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>

                                        <img style="width: 100px; heigth:100px"
                                            src="{{ asset('img/product/' . $product->image) }}" alt="">
                                        {{ $product->product_name }}
                                    </td>
                                    <td>{{ number_format($item->total) }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->bill_detail_id }}</td>
                                    <td> <?php
                                    if ($bill->status == 0) {
                                        echo 'Chờ xác nhận';
                                    } elseif ($bill->status == 1) {
                                        echo 'Đang giao hàng';
                                    } elseif ($bill->status == 2) {
                                        echo 'Giao hàng thành công';
                                    } elseif ($bill->status == 3) {
                                        echo 'Đã nhận hàng';
                                    }
                                    ?> </td>
                                    <td>{{ $item->created_at }}</td>

                                    {{-- <td class="text-center">
                                        <a href="{{ route('showEditBill_admin', ['id' => $item->id]) }}"
                                            class="btn btn-info btn-circle btn-sm">
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
                                                            href="{{ route('deleteBill_admin', ['id' => $item->id]) }}">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td> --}}

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    <div class="row" style=" float:right;">
                        <div class="div">
                            {{ $all_order->appends(request()->all())->links() }}

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
